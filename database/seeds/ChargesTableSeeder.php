<?php

use Illuminate\Database\Seeder;
use App\TransactionCharge;

class ChargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionCharge::create([

            'transaction_type' => 1,
            'transaction_category' => 1,
            'transaction_name'     => '>70000',
            'user_id'              => 3,
            'charge'               => 100
        ]);

        TransactionCharge::create([

            'transaction_type' => 1,
            'transaction_category' => 2,
            'transaction_name'     => '> 20000 AND <=70000',
            'user_id'              => 3,
            'charge'               => 50
        ]);

        TransactionCharge::create([

            'transaction_type' => 1,
            'transaction_category' => 3,
            'transaction_name'     => '> 3000 <= 20000',
            'user_id'              => 3,
            'charge'               => 30
        ]);

        TransactionCharge::create([

            'transaction_type' => 1,
            'transaction_category' => 4,
            'transaction_name'     => '> 100 AND <= 300',
            'user_id'              => 3,
            'charge'               => 15
        ]);

        TransactionCharge::create([

            'transaction_type' => 1,
            'transaction_category' => 5,
            'transaction_name'     => '> 0 AND <=100',
            'user_id'              => 3,
            'charge'               => 5
        ]);

        TransactionCharge::create([

            'transaction_type' => 2,
            'transaction_category' => 1,
            'transaction_name'     => '>70000',
            'user_id'              => 3,
            'charge'               => 100
        ]);

        TransactionCharge::create([

            'transaction_type' => 2,
            'transaction_category' => 2,
            'transaction_name'     => '> 20000 AND <=70000',
            'user_id'              => 3,
            'charge'               => 50
        ]);

        TransactionCharge::create([

            'transaction_type' => 2,
            'transaction_category' => 3,
            'transaction_name'     => '> 3000 <= 20000',
            'user_id'              => 3,
            'charge'               => 30
        ]);

        TransactionCharge::create([

            'transaction_type' => 2,
            'transaction_category' => 4,
            'transaction_name'     => '> 100 AND <= 300',
            'user_id'              => 3,
            'charge'               => 15
        ]);

        TransactionCharge::create([

            'transaction_type' => 2,
            'transaction_category' => 5,
            'transaction_name'     => '> 0 AND <=100',
            'user_id'              => 3,
            'charge'               => 5
        ]);
    }
}
