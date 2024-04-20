<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Feedback;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        (new UserSeeder())->run();
        (new CustomerSeeder())->run();
        (new HotelRoomTypesSeeder())->run();
        (new HotelRoomsSeeder())->run();
        (new FeedbackSeeder())->run();

        Customer::factory()->count(10)->create();
        Feedback::factory()->count(10)->create();
    }
}
