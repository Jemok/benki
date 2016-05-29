<?php

namespace App\Console\Commands;

use App\Transaction;
use Illuminate\Console\Command;
use App\AccountRate;

class DeductSaving extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deduct:saving';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deducts users savings from the current account to the savings account';

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
        $transactions = Transaction::where('duration', '=', 1)->get();

        foreach($transactions as $transaction){

            $current_account = $transaction->current_account()->where('id', '=', $transaction->account_id)->first();

            $account_amount =  $current_account->account_amount;

            $amount = ($transaction->percentage/100)*$current_account->account_amount;

            $amount_add = ($transaction->percentage/100)*$current_account->account_amount;


            if($account_amount > 50000){

                $rate = AccountRate::where('id', '=', 1)->first()->category_one;

                $rate = ($rate/100);

                $amount_add = $amount_add*$rate*0.25;


            }elseif($account_amount >= 20000 && $account_amount <= 50000 ){

                $rate = AccountRate::where('id', '=', 1)->first()->category_two;

                $rate = ($rate/100);

                $amount_add = $amount_add*$rate*0.25;


            }elseif($account_amount >= 10000 && $account_amount < 20000  ){

                $rate = AccountRate::where('id', '=', 1)->first()->category_three;

                $rate = ($rate/100);

                $amount_add = $amount_add*$rate*0.25;


            }elseif($account_amount >0 && $account_amount < 10000){

                $rate = AccountRate::where('id', '=', 1)->first()->category_four;

                $rate = ($rate/100);

                $amount_add = $amount_add*$rate*0.25;

            }


            $transaction_amount = $transaction->transaction_amount;

            $withdraw_date = $transaction->withdraw_date;

            $today = (new \Carbon\Carbon())->addHours(3);

            if($withdraw_date == $today){

                $current_account->update([

                    'account_amount' => $account_amount + $transaction_amount
                ]);

                $transaction->update([

                    'transaction_amount' => 0

                ]);

            }else{


                $current_account->update([

                    'account_amount' => $account_amount - $amount
                ]);

                $transaction->update([

                    'transaction_amount' => $transaction_amount + $amount_add

                ]);

            }

        }
    }
}
