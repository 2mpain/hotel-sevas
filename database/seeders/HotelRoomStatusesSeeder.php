<?php

namespace Database\Seeders;

use App\Enums\HotelRooms\HotelRoomStatusEnum;
use App\Models\HotelRoomStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelRoomStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (HotelRoomStatusEnum::toLabels() as $status => $label) {
            HotelRoomStatus::create([
                'name' => $label
            ]);
        }
    }
}
