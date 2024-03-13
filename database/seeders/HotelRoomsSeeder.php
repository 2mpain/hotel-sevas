<?php

namespace Database\Seeders;

use App\Models\Customer;
use DB;
use Illuminate\Database\Seeder;
use Exception;

class HotelRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomsData = [
            [
                'room_type_id' => 1,
                'floor' => 2,
                'room_number' => 10,
                'square' => 35,
                'occupied' => true,
                'booker_name' => 'Станислав',
                'occupants' => 2,
                'customer_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_type_id' => 2,
                'floor' => 3,
                'room_number' => 11,
                'square' => 42,
                'booker_name' => 'Дэнчик',
                'occupied' => true,
                'occupants' => 3,
                'customer_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_type_id' => 3,
                'floor' => 2,
                'room_number' => 12,
                'booker_name' => 'Мария',
                'square' => 29,
                'occupied' => false,
                'occupants' => 0,
                'customer_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        try {
            DB::table('hotel_rooms')->insert($roomsData);
            foreach ($roomsData as $room) {
                $customer = Customer::where('first_name', $room['booker_name'])->first();
                if ($customer) {
                    $customer->room_number = $room['room_number'];
                    $customer->save();
                }
            }
            
        } catch (Exception $e) {
            \Log::info($e);
        }

    }
}
