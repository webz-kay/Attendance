<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(['email'=>'webz@gmail.com','wsys_no'=>'1212','name'=>'Andy Webz','password'=>bcrypt('password')]);
        \App\User::create(['email'=>'kamande@gmail.com','wsys_no'=>'1313','name'=>'Kamande Boss','password'=>bcrypt('password')]);
        \App\User::create(['email'=>'ron@gmail.com','wsys_no'=>'1414','name'=>'Ron Sim','password'=>bcrypt('password')]);
    }
}
