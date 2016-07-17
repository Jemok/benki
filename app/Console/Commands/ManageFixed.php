<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transaction;

class ManageFixed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deduct:ManageFixed';

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
        $today = (new \Carbon\Carbon())->addHours(3);

        $transactions  = Transaction::where('withdraw_date', '=', $today)->get();

        foreach($transactions as $transaction){

            $current_account = $transaction->current_account()->where('id', '=', $transaction->account_id)->first();

            $transaction_amount = $transaction->transaction_amount;

            $account_amount =  $current_account->account_amount;

            $current_account->update([

                'account_amount' => $account_amount + $transaction_amount
            ]);
        }
    }
}
