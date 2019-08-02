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
        User::create([
        	'name'=>'juan',
            'email'=>'juan@gmail.com',
            'password'=> bcrypt('12341234'),
            'admin'=> true
        ]);
    }
}
