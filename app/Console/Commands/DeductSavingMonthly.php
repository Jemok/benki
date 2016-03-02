<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transaction;

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
        $transactions = Transaction::where('duration', '=', 30)->get();

        foreach($transactions as $transaction){

            $current_account = $transaction->current_account()->where('id', '=', $transaction->account_id)->first();

            $account_amount =  $current_account->account_amount;

            $amount = ($transaction->percentage/100)*$current_account->account_amount;

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

                    'transaction_amount' => $transaction_amount + $amount

                ]);

            }
        }
    }
}
