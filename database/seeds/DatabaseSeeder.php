<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Model::unguard();

        //disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(AccountTypesTableSeeder::class);

        //Supposed to only apply to a single connection and reset itself
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Model::reguard();
    }
}
