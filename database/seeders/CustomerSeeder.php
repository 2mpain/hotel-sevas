<?php

namespace Database\Seeders;

use App\Models\HotelRoom;
use DB;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([

            [
                'first_name' => 'Станислав',
                'last_name' => 'Азимов',
                'middle_name' => 'Скайзович',
                'email' => 'stas123@yandex.ru',
                'phoneNumber' => '+79787854321',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
                'feedbacks_count' => 1,
            ],
            [
                'first_name' => 'Дэнчик',
                'last_name' => 'Тимофеев',
                'middle_name' => 'Рофланович',
                'email' => 'danik123@mail.ru',
                'phoneNumber' => '+79787855555',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
                'feedbacks_count' => 1,
            ],
            [
                'first_name' => 'Мария',
                'last_name' => 'Мариева',
                'middle_name' => 'Мариевна',
                'email' => 'avemaria@gmail.com',
                'phoneNumber' => '+79787843247',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
                'feedbacks_count' => 1,
            ],
        ]);

    }
}
