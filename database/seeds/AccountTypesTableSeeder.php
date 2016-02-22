<?php

use Illuminate\Database\Seeder;
use App\AccountType;

class AccountTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::truncate();

        DB::table('account_types')->insert([
            'account_type_name' => 'Fixed',
            'account_type_description' => 'A fixed Account'
        ]);
    }
}
