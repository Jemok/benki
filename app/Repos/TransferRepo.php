<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/17/16
 * Time: 3:38 PM
 */

namespace App\Repos;
use App\AccountContribution;
use App\Current_account;
use App\CurrentRecord;
use App\Transaction;
use App\Transfer;
use App\Withdrawal_request;


class TransferRepo {

    /**
     * @param $request
     * @param $account_id
     */
    public function transact($request, $account_id){

        Transaction::create([
            //1 denotes a fixed account transaction
            'transaction_type' => 1,
            'transaction_amount' => $request->amount,
            'account_id'  => $account_id,
            'withdraw_date' => $request->withdraw_date
        ]);
    }

    /**
     * @param $request
     * @param $account_id
     */
    public function transactToSavings($request, $account_id){

        Transaction::create([

            'transaction_type' => 2,
            //'deduct_amount' => $request->amount,
            'account_id' => $account_id,
            'percentage' => $request->percentage,
            'duration' => $request->duration,
            'rate_pay_count' => 90,
            'withdraw_date' =>  $request->withdraw_date

        ]);
    }

    public function transactToFixedSavings($request, $account_id){

        Transaction::create([

            'transaction_type' => 3,
            'deduct_amount' => $request->amount,
            'account_id' => $account_id,
//            'percentage' => $request->percentage,
            'duration' => $request->duration,
            'rate_pay_count' => 90,
            'withdraw_date' =>  $request->withdraw_date

        ]);
    }

    /**
     * @return mixed
     */
    public function getFixed(){

        if(Transaction::where('account_id', '=', \Auth::user()->current_account()->first()->id)
            ->where('transaction_type', '=', 1)->where('transaction_status', '=', 1)->orderBy('id', 'desc')->exists()){

            return Transaction::where('account_id', '=', \Auth::user()->current_account()->first()->id)
                ->where('transaction_type', '=', 1)->where('transaction_status', '=', 1)->orderBy('id', 'desc')->first();
        }else{

            return null;
        }
    }

    /**
     * @return mixed
     */
    public function getSaving(){

        if(Transaction::where('account_id', '=', \Auth::user()->current_account()->first()->id)
                            ->where('transaction_type', '=', 3)->where('transaction_status', '=', 1)->first() == null){

            return false;
        }else{

            return Transaction::where('account_id', '=', \Auth::user()->current_account()->first()->id)
                                ->where('transaction_type', '=', 3)->where('transaction_status', '=', 1)->first();

        }
    }

    /**
     * @param $request
     * @param $transaction_id
     */
    public function updateSaving($request, $transaction_id){

        $transaction = Transaction::findOrFail($transaction_id);

        $transaction->update([

            'deduct_amount' => $request->amount,
            'percentage'         => $request->percentage,
            'duration'           => $request->duration,
            'withdraw_date' =>  $request->withdraw_date


        ]);
    }

    public function getReceived($user_id)
    {
        if(Transfer::where('receiver_id', $user_id)->exists()){

            return Transfer::where('receiver_id', $user_id)->paginate(10);
        }else{

            return null;
        }
    }

    public function getSent($user_id){

        if(Transfer::where('user_id', $user_id)->exists()){

            return Transfer::where('user_id', $user_id)->paginate(10);
        }else{

            return null;
        }
    }

    public function getWithdrawals($user_id){

        if(Withdrawal_request::where('user_id', $user_id)->exists()){

            return Withdrawal_request::where('user_id', $user_id)->paginate(10);

        }else{

            return null;
        }

    }

    public function getDeposits($user_id){

        if(AccountContribution::where('user_id', $user_id)->exists()){

            return AccountContribution::where('user_id', $user_id)->paginate(10);

        }else{

            return null;
        }
    }

    public function getCurrents($user_id){

        $current_id = Current_account::where('user_id', $user_id)->first()->id;

        if(CurrentRecord::where('current_account_id', $current_id)->exists()){

            return CurrentRecord::where('current_account_id', $current_id)->paginate(10);

        }else{

            return null;
        }
    }

    public function getCurrentAmount($user_id){

        return Current_account::where('user_id', $user_id)->first()->account_amount;
    }
} 