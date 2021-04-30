<?php

use App\User;
use Illuminate\Database\Seeder;
// use Illuminate\Foundation\Auth\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            
        User::create([
            'name' => 'admin',
            'email'=>'gbhagra@gmail.com',
            'password' =>bcrypt('123ugetfree'),
            'admin' =>true
        ]);



    }
}
