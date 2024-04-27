<?php

namespace Database\Factories;

use App\Enums\HotelRooms\HotelRoomStatusEnum;
use App\Models\Customer;
use App\Models\HotelRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelRoom>
 */
class HotelRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement([
            HotelRoomStatusEnum::STATUS_BOOKED,
            HotelRoomStatusEnum::STATUS_ON_CLEANING,
            HotelRoomStatusEnum::STATUS_OCCUPIED,
            HotelRoomStatusEnum::STATUS_UNOCCUPIED,
            HotelRoomStatusEnum::STATUS_FOR_REPAIR,
        ]);

        $occupants = $status === HotelRoomStatusEnum::STATUS_BOOKED ||
            $status === HotelRoomStatusEnum::STATUS_UNOCCUPIED ||
            $status === HotelRoomStatusEnum::STATUS_FOR_REPAIR ? 0 : $this->faker->numberBetween(1, 5);


        $customerId = null;
        if (
            $status === HotelRoomStatusEnum::STATUS_BOOKED ||
            $status === HotelRoomStatusEnum::STATUS_OCCUPIED ||
            $status === HotelRoomStatusEnum::STATUS_ON_CLEANING
        ) {
            $customerId = Customer::factory();
        }

        return [
            'floor' => $this->faker->numberBetween(1, 2),
            'number' => $this->faker->unique()->numberBetween(1, 40),
            'status_id' => $status,
            'occupants' => $occupants,
            'room_type_id' => $this->faker->numberBetween(1, 4),
            'customer_id' => $customerId,
        ];
    }
}
