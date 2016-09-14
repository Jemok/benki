<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/2/16
 * Time: 11:45 AM
 */

namespace App\Repos;
use App\Current_account;
use App\TransactionCharge;
use App\TransactionPayment;
use App\Transfer;
use App\User;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp;


class TransferUsersRepo {

    /**
     * The model used by this repo
     * @var
     */
    private $model;

    private $error_users = [];

    /**
     * This class constructor initializer
     * TransferUsersRepo constructor.
     * @param Transfer $transfer
     */
    public function __construct(Transfer $transfer){

        $this->model = $transfer;

    }

    /**
     * Create a new transfer instance
     * @param $transfer_amount
     * @param $receiver_id
     * @param $user_id
     */
    public function store($transfer_amount, $receiver_id ,$user_id){

        $receiver_id = explode(',', $receiver_id);

        foreach ($receiver_id as $receiver) {

            if (User::where('phone_number', '=', $receiver)

                ->orWhere('email', '=', $receiver)->exists() && (Auth::user()->email != $receiver && Auth::user()->phone_number != $receiver)
            ) {

                $user_receiver = User::where('phone_number', '=', $receiver)
                    ->orWhere('email', '=', $receiver)->first()->id;

                $transfer = $this->model->create([

                    'transfer_amount' => $transfer_amount,
                    'receiver_id' => $user_receiver,
                    'user_id' => $user_id
                ]);

                $current_account_user = Current_account::where('user_id', '=', $user_id)->first();

                $account_amount_user = $current_account_user->account_amount;

                $current_account_receiver = Current_account::where('user_id', '=', $user_receiver)->first();

                $account_amount_receiver = $current_account_receiver->account_amount;

                $current_account_user->update([

                    'account_amount' => $account_amount_user - $transfer_amount

                ]);

                $current_account_receiver->update([

                    'account_amount' => $account_amount_receiver + $transfer_amount
                ]);


                if($transfer_amount > 70000){

                    $transaction_charge = TransactionCharge::where('transaction_type', 1)->where('transaction_category', 1)->first();

                    $transaction_charge_id = $transaction_charge->id;

                    $owner_id = Auth::user()->id;

                    $transaction_id = $transfer->id;

                    $payment = $transaction_charge->charge;

                    $this->savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment);

                    $this->sendSms($transfer_amount, $user_receiver->phone_number);
                }elseif($transfer_amount > 20000 && $transfer_amount <= 70000){

                    $transaction_charge = TransactionCharge::where('transaction_type', 1)->where('transaction_category', 2)->first();

                    $transaction_charge_id = $transaction_charge->id;

                    $owner_id = Auth::user()->id;

                    $transaction_id = $transfer->id;

                    $payment = $transaction_charge->charge;

                    $this->savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment);
                    $this->sendSms($transfer_amount, $user_receiver->phone_number);

                }elseif($transfer_amount > 3000 && $transfer_amount <= 20000){
                    $transaction_charge = TransactionCharge::where('transaction_type', 1)->where('transaction_category', 3)->first();

                    $transaction_charge_id = $transaction_charge->id;

                    $owner_id = Auth::user()->id;

                    $transaction_id = $transfer->id;

                    $payment = $transaction_charge->charge;

                    $this->savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment);
                    $this->sendSms($transfer_amount, $user_receiver->phone_number);

                }elseif($transfer_amount > 100 && $transfer_amount <= 3000){
                    $transaction_charge = TransactionCharge::where('transaction_type', 1)->where('transaction_category', 4)->first();

                    $transaction_charge_id = $transaction_charge->id;

                    $owner_id = Auth::user()->id;

                    $transaction_id = $transfer->id;

                    $payment = $transaction_charge->charge;

                    $this->savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment);
                    $this->sendSms($transfer_amount, $user_receiver->phone_number);

                }elseif($transfer_amount > 0 && $transfer_amount <= 100){
                    $transaction_charge = TransactionCharge::where('transaction_type', 1)->where('transaction_category', 5)->first();

                    $transaction_charge_id = $transaction_charge->id;

                    $owner_id = Auth::user()->id;

                    $transaction_id = $transfer->id;

                    $payment = $transaction_charge->charge;

                    $this->savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment);
                    $this->sendSms($transfer_amount, $user_receiver->phone_number);
                }

            }else{

                $this->error_users[] =  $receiver;
            }
        }
        return $this->error_users;
    }

    private function savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment){

        $transactionPaymentRepository = new TransactionPaymentRepository(new TransactionPayment());

        $transactionPaymentRepository->store($transaction_charge_id, $owner_id, $transaction_id, $payment, 1);

    }

    public function sendSms($transfer_amount, $number){

        $message = "HandBank: Kshs " . $transfer_amount ." has been transferred to your HandBank account";

        $url = "http://techsult.co.ke/vas/remote/?user=zinake&pass=zinakep@ss&msisdn=". $number ."&message=$message";


        $client = new GuzzleHttp\Client();

        $res = $client->request('GET', $url);

    }
} 