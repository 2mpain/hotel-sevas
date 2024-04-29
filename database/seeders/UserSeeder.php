<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $query = User::query();
        $query->insert([
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

        User::factory()->count(50)->create();
    }
}
