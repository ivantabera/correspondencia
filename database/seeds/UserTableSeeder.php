<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::created([
            'name' => 'Edgar',
            'email' => 'edgar@gmail.com',
            'password' => bcrypt('347062iI')
        ]);
    }
}
