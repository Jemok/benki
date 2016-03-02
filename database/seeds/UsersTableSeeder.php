<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        DB::table('users')->insert([
            'name' =>  'admin',
            'email' => 'admin@benki.com',
            'password' => bcrypt('123456'),
            'userCategory' => 1
        ]);
    }
}
