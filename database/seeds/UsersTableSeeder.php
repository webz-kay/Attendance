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
        \App\User::create(['email'=>'webz1@gmail.com','name'=>'Andy One','password'=>bcrypt('password')]);
        \App\User::create(['email'=>'webz2@gmail.com','name'=>'Andy Two','password'=>bcrypt('password')]);
        \App\User::create(['email'=>'webz3@gmail.com','name'=>'Andy Three','password'=>bcrypt('password')]);
    }
}
