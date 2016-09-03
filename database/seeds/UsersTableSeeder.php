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
            'phone_number' => '0712675071',
            'password' => bcrypt('123456'),
            'userCategory' => 1
        ]);


        DB::table('users')->insert([
            'name' =>  'admin2',
            'email' => 'admin2@benki.com',
            'phone_number' => '0712675072',
            'password' => bcrypt('123456'),
            'userCategory' => 2
        ]);

        DB::table('users')->insert([
            'name' =>  'admin3',
            'email' => 'admin3@benki.com',
            'phone_number' => '0712675073',
            'password' => bcrypt('123456'),
            'userCategory' => 3
        ]);
    }
}
