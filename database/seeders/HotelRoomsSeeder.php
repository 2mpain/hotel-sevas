<?php

namespace Database\Seeders;

use App\Enums\HotelRooms\HotelRoomStatusEnum;
use App\Models\HotelRoom;
use Illuminate\Database\Seeder;

class HotelRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $query = HotelRoom::query();
        // $query->insert([
        //     [
        //         'room_type_id' => 1,
        //         'floor' => 2,
        //         'number' => 10,
        //         'status' => HotelRoomStatusEnum::STATUS_OCCUPIED,
        //         'occupants' => 2,
        //         'customer_id' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'room_type_id' => 2,
        //         'floor' => 3,
        //         'number' => 11,
        //         'status' => HotelRoomStatusEnum::STATUS_OCCUPIED,
        //         'occupants' => 3,
        //         'customer_id' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'room_type_id' => 3,
        //         'floor' => 2,
        //         'number' => 12,
        //         'status' => HotelRoomStatusEnum::STATUS_ON_CLEANING,
        //         'occupants' => 0,
        //         'customer_id' => 3,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

        HotelRoom::factory()->count(40)->create();
    }
}
