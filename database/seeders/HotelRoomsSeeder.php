<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class HotelRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotel_rooms')->insert([
            [
                'room_type_id' => 1,
                'floor' => 2,
                'square' => 35,
                'occupied' => true,
                'occupants' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_type_id' => 2,
                'floor' => 3,
                'square' => 42,
                'occupied' => true,
                'occupants' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_type_id' => 3,
                'floor' => 2,
                'square' => 29,
                'occupied' => false,
                'occupants' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
