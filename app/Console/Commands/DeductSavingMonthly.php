<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transaction;
use App\AccountRate;

class DeductSavingMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deduct:savingMonthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $transactions = Transaction::where('duration', '=', 30)->get();
        $transactions = Transaction::where('duration', '=', 30)->where('transaction_status', '=', 1)->get();

        foreach($transactions as $transaction){

            $current_account = $transaction->current_account()->where('id', '=', $transaction->account_id)->first();

            $account_amount =  $current_account->account_amount;

            $amount = ($transaction->percentage/100)*$current_account->account_amount;

            $amount_add = ($transaction->percentage/100)*$current_account->account_amount;

            $transaction_amount = $transaction->transaction_amount;

            if($account_amount > 50000){

                if($transaction->rate_pay_count == 0){

                    $rate = AccountRate::where('id', '=', 1)->first()->category_one;

                    $rate = ($rate/100);

                    $amount_add = $amount_add +  ($transaction_amount*$rate);

                    $transaction->update([
                        'rate_pay_count' => 90
                    ]);
                }

                $amount_add = $amount_add + $transaction_amount;

                $transaction->update([
                    'rate_pay_count' => $transaction->rate_pay_count - 1
                ]);

            }elseif($account_amount > 20000 && $account_amount <= 50000 ){

                if($transaction->rate_pay_count == 0){

                    $rate = AccountRate::where('id', '=', 1)->first()->category_two;

                    $rate = ($rate/100);

                    $amount_add = $amount_add +  ($transaction_amount*$rate);

                    $transaction->update([
                        'rate_pay_count' => 90
                    ]);
                }
                $amount_add = $amount_add + $transaction_amount;

                $transaction->update([
                    'rate_pay_count' => $transaction->rate_pay_count - 1
                ]);

            }elseif($account_amount > 10000 && $account_amount <= 20000  ){

                if($transaction->rate_pay_count == 0){

                    $rate = AccountRate::where('id', '=', 1)->first()->category_three;

                    $rate = ($rate/100);

                    $amount_add = $amount_add +  ($transaction_amount*$rate);

                    $transaction->update([
                        'rate_pay_count' => 90
                    ]);
                }

                $amount_add = $amount_add + $transaction_amount;

                $transaction->update([
                    'rate_pay_count' => $transaction->rate_pay_count - 1
                ]);

            }elseif($account_amount >0 && $account_amount <= 10000){

                if($transaction->rate_pay_count == 0){

                    $rate = AccountRate::where('id', '=', 1)->first()->category_four;

                    $rate = ($rate/100);

                    $amount_add = $amount_add +  ($transaction_amount*$rate);

                    $transaction->update([
                        'rate_pay_count' => 90
                    ]);
                }
                $amount_add = $amount_add + $transaction_amount;

                $transaction->update([

                    'rate_pay_count' => $transaction->rate_pay_count - 1
                ]);
            }

            $withdraw_date = $transaction->withdraw_date;

            $today = (new \Carbon\Carbon())->addHours(3);

            if($withdraw_date == $today){

                $current_account->update([

                    'account_amount' => $account_amount + $transaction_amount+$amount_add
                ]);

                $transaction->update([
                    'transaction_amount' => $amount_add,
                    'transaction_status' => 0
                ]);

                $transaction->records()->create([
                    'amount' => $amount
                ]);

            }else{
                $current_account->update([
                    'account_amount' => $account_amount - $amount
                ]);

                $transaction->update([
                    'transaction_amount' => $amount_add
                ]);

                $transaction->records()->create([

                    'amount' => $amount
                ]);
            }
        }

//        foreach($transactions as $transaction){
//
//            $current_account = $transaction->current_account()->where('id', '=', $transaction->account_id)->first();
//
//            $account_amount =  $current_account->account_amount;
//
//            $amount = ($transaction->percentage/100)*$current_account->account_amount;
//
//            $amount_add = ($transaction->percentage/100)*$current_account->account_amount;
//
//
//            if($account_amount > 50000){
//
//                    $rate = AccountRate::where('id', '=', 1)->first()->category_one;
//
//                    $rate = ($rate/100);
//
//                    $amount_add = $amount_add*$rate*0.25;
//
//
//            }elseif($account_amount >= 20000 && $account_amount <= 50000 ){
//
//                $rate = AccountRate::where('id', '=', 1)->first()->category_two;
//
//                $rate = ($rate/100);
//
//                $amount_add = $amount_add*$rate*0.25;
//
//
//            }elseif($account_amount >= 10000 && $account_amount < 20000  ){
//
//                $rate = AccountRate::where('id', '=', 1)->first()->category_three;
//
//                $rate = ($rate/100);
//
//                $amount_add = $amount_add*$rate*0.25;
//
//
//            }elseif($account_amount >0 && $account_amount < 10000){
//
//                $rate = AccountRate::where('id', '=', 1)->first()->category_four;
//
//                $rate = ($rate/100);
//
//                $amount_add = $amount_add*$rate*0.25;
//
//            }
//
//            $transaction_amount = $transaction->transaction_amount;
//
//            $withdraw_date = $transaction->withdraw_date;
//
//            $today = (new \Carbon\Carbon())->addHours(3);
//
//
//
//            if($withdraw_date == $today){
//
//                $current_account->update([
//
//                    'account_amount' => $account_amount + $transaction_amount
//                ]);
//
//                $transaction->update([
//
//                    'transaction_amount' => 0
//
//                ]);
//
//            }else{
//
//                $current_account->update([
//
//                    'account_amount' => $account_amount - $amount
//                ]);
//
//                $transaction->update([
//
//                    'transaction_amount' => $transaction_amount + $amount_add
//
//                ]);
//
//            }
//        }
    }
}
