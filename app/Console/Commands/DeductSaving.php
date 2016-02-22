<?php

namespace App\Console\Commands;

use App\Transaction;
use Illuminate\Console\Command;

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

            $current_account = $transaction->current_account()
                                            ->first();
            $current_account->update([

                'account_amount' => ($current_account->account_mount - (($transaction->percentage)/100)*$current_account->account_amount)

            ]);

            $transaction->update([

                'transaction_amount' =>  ($transaction->transaction_amount + (($transaction->percentage)/100)*$current_account->account_amount)

            ]);
        }
    }
}
