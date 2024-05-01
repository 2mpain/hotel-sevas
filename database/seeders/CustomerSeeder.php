<?php

namespace Database\Seeders;

use App\Enums\Customers\CustomersStatusEnum;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $query = Customer::query();
        $query->insert([
            [
                'first_name' => 'Станислав',
                'last_name' => 'Азимов',
                'middle_name' => 'Скайзович',
                'email' => 'stas123@yandex.ru',
                'phoneNumber' => '+79787854321',
                'status' => CustomersStatusEnum::STATUS_ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
                'arrival_date' => Carbon::createFromFormat('Y-m-d', '2024-04-24'),
                'departure_date' => Carbon::now()->addDays(4),
                'feedbacks_count' => 1,
            ],
            [
                'first_name' => 'Дэнчик',
                'last_name' => 'Тимофеев',
                'middle_name' => 'Рофланович',
                'email' => 'danik123@mail.ru',
                'phoneNumber' => '+79787855555',
                'status' => CustomersStatusEnum::STATUS_ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
                'arrival_date' => Carbon::createFromFormat('Y-m-d', '2024-04-14'),
                'departure_date' => Carbon::now()->addDays(5),
                'feedbacks_count' => 1,
            ],
            [
                'first_name' => 'Мария',
                'last_name' => 'Мариева',
                'middle_name' => 'Мариевна',
                'email' => 'avemaria@gmail.com',
                'phoneNumber' => '+79787843247',
                'status' => CustomersStatusEnum::STATUS_ACTIVE,
                'created_at' => now(),
                'updated_at' => now(),
                'arrival_date' => Carbon::createFromFormat('Y-m-d', '2024-04-13'),
                'departure_date' => Carbon::now()->addDays(6),
                'feedbacks_count' => 1,
            ],
        ]);
    }
}
