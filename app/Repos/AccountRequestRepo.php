<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/25/16
 * Time: 10:29 AM
 */

namespace App\Repos;
use App\AccountRequest;
use App\TransactionCharge;
use App\TransactionPayment;
use App\User;
use App\Account_amount;
use App\Withdrawal_request;
use App\WithdrawRequestAnswer;
use Illuminate\Support\Facades\Auth;


class AccountRequestRepo {

    /**
     * @var \App\AccountRequest
     */
    private $model;

    /**
     * @param AccountRequest $accountRequest
     */
    public function __construct(AccountRequest $accountRequest){

        $this->model = $accountRequest;
    }

    /**
     * @param $account_id
     * @param $user_id
     */
    public function sendRequest($account_id, $user_id){

       $this->model->create([
            'account_id' =>  $account_id,
            'user_id'    => $user_id,
            'confirmation_status' => 0
        ]);

    }

    /**
     * @param $user_id
     * @param $account_id
     * @return int
     */
    public function getConfirmationStatus($user_id, $account_id){

        if($this->model
                    ->where('account_id', '=', $account_id)
                    ->where('user_id', '=', $user_id)
                    ->first() != null){
            return $this->model
                ->where('account_id', '=', $account_id)
                ->where('user_id', '=', $user_id)
                ->first()
                ->confirmation_status;
        }else{
            return 2;
        }
    }

    /**
     * Get all the requests that have been sent to an account
     */
    public function getRequestsForAccount($account_id){
        if($this->model
                ->where('account_id', '=', $account_id)
                ->where('confirmation_status', '=', 0)
                ->first() != null){

            $requests_id =$this->model
                ->where('account_id', '=', $account_id)
                ->where('confirmation_status', '=', 0)
                ->lists('user_id');

            return User::whereIn('id', $requests_id)->latest()->get();

        }else{
            return null;
        }
    }

    public function getForUser($user_id){

        return $this->model
                    ->where('user_id', $user_id)
                    ->where('confirmation_status', 0)
                    ->get();
    }

    public function withdraw($account_id, $user_id){

        $account = Account_amount::where('id', $account_id)->first();

        $account_request = Withdrawal_request::where('account_id', $account_id)
                                               ->where('user_id', $user_id)
                                               ->orderBy('created_at','desc')->first();

//        $request_answer = WithdrawRequestAnswer::where('user_id', $user_id)
//                                                 ->where('account_id', $account_id)
//                                                 ->orderBy('created_at','desc')->first();


        $account_amount = $account->amount;


//        WithdrawRequestAnswer::where('account_id', $account_id)
//                               ->update([
//
//                'status' => 1
//
//            ]);



        $request_amount = $account_request->request_amount;

//        $request_answer->create([
//
//            'user_id' => \Auth::user()->id,
//            'account_id' => 3,
//            'withdraw_request_id' => 1
//
//        ]);

        $account->update([
            'amount' =>  ($account_amount - $request_amount)
        ]);

        $withdraw_request = Withdrawal_request::where('account_id', $account_id)
                            ->where('user_id', '=', \Auth::user()->id)
                            ->where('withdraw_status', '=', 0)
                            ->orderBy('created_at','desc')
                            ->first();

        $withdraw_request->update([
                                'withdraw_status' => 1
        ]);

        $current_amount = \Auth::user()->current_account()->first()->account_amount;

        \Auth::user()->current_account()->update([
            'account_amount' => ($current_amount + $request_amount)
        ]);

        if($request_amount > 70000){

            $transaction_charge = TransactionCharge::where('transaction_type', 2)->where('transaction_category', 1)->first();

            $transaction_charge_id = $transaction_charge->id;

            $owner_id = $account->id;

            $transaction_id = $withdraw_request->id;

            $payment = $transaction_charge->charge;

            $this->savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment);
        }elseif($request_amount > 20000 && $request_amount <= 70000){

            $transaction_charge = TransactionCharge::where('transaction_type', 2)->where('transaction_category', 2)->first();

            $transaction_charge_id = $transaction_charge->id;

            $owner_id = Auth::user()->id;

            $transaction_id = $withdraw_request->id;

            $payment = $transaction_charge->charge;

            $this->savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment);
        }elseif($request_amount > 3000 && $request_amount <= 20000){
            $transaction_charge = TransactionCharge::where('transaction_type', 2)->where('transaction_category', 3)->first();

            $transaction_charge_id = $transaction_charge->id;

            $owner_id = Auth::user()->id;

            $transaction_id = $withdraw_request->id;

            $payment = $transaction_charge->charge;

            $this->savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment);
        }elseif($request_amount > 100 && $request_amount <= 3000){
            $transaction_charge = TransactionCharge::where('transaction_type', 2)->where('transaction_category', 4)->first();

            $transaction_charge_id = $transaction_charge->id;

            $owner_id = Auth::user()->id;

            $transaction_id = $withdraw_request->id;

            $payment = $transaction_charge->charge;

            $this->savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment);
        }elseif($request_amount > 0 && $request_amount <= 100){
            $transaction_charge = TransactionCharge::where('transaction_type', 2)->where('transaction_category', 5)->first();

            $transaction_charge_id = $transaction_charge->id;

            $owner_id = Auth::user()->id;

            $transaction_id = $withdraw_request->id;

            $payment = $transaction_charge->charge;

            $this->savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment);
        }


        return $account;
    }

    private function savePayment($transaction_charge_id, $owner_id, $transaction_id, $payment){

        $transactionPaymentRepository = new TransactionPaymentRepository(new TransactionPayment());

        $transactionPaymentRepository->store($transaction_charge_id, $owner_id, $transaction_id, $payment);

    }
}
