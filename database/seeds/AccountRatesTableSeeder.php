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
            'category_one' =>  '2',
            'category_two' => '3',
            'category_three' => '4',
            'category_four'  => '5'

        ]);
    }
}
