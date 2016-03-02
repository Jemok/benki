<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/17/16
 * Time: 3:38 PM
 */

namespace App\Repos;
use App\Transaction;


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
            'withdraw_date' =>  $request->withdraw_date

        ]);
    }

    /**
     * @return mixed
     */
    public function getFixed(){

        return Transaction::where('account_id', '=', \Auth::user()->current_account()->first()->id)
                            ->where('transaction_type', '=', 1)->orderBy('id', 'desc')->first();

    }

    /**
     * @return mixed
     */
    public function getSaving(){

        if(Transaction::where('account_id', '=', \Auth::user()->current_account()->first()->id)
                            ->where('transaction_type', '=', 2)->first() == null){

            return false;
        }else{

            return Transaction::where('account_id', '=', \Auth::user()->current_account()->first()->id)
                                ->where('transaction_type', '=', 2)->first();

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
} 