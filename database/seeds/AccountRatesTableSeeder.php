<?php

use Illuminate\Database\Seeder;
use App\AccountRate;

class AccountRatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountRate::truncate();

        DB::table('account_rates')->insert([
            'fixed' =>  '10',
            'savings' => '10'

        ]);
    }
}
