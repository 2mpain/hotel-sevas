<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Feedback;
use App\Models\HotelRoomStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        (new UserSeeder())->run();
        (new CustomerStatusesSeeder())->run();
        (new CustomerSeeder())->run();
        (new HotelRoomTypesSeeder())->run();
        (new HotelRoomStatusesSeeder())->run();
        (new HotelRoomsSeeder())->run();
        (new FeedbackSeeder())->run();

        Customer::factory()->count(200)->create();
        Feedback::factory()->count(300)->create();
    }
}
