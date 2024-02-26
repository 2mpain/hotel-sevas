<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'phoneNumber' => '+79787854321',
                'password' => Hash::make('123'),
                'role' => 'admin',
            ],

            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'phoneNumber' => '+79787812345',
                'password' => Hash::make('123'),
                'role' => 'user',
            ],

        ]);
    }
}
