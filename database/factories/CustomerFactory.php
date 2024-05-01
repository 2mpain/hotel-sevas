<?php

namespace Database\Factories;

use App\Enums\Customers\CustomersStatusEnum;
use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $faker = FakerFactory::create('ru_RU');

        $arrivalDate = $faker->randomElement(
            [
                Carbon::now()->subDays(rand(1, 7)),
                Carbon::now()->subWeek(),
                Carbon::now()->subDays(3),
                null,
            ]
        );

        $departureDate = $arrivalDate ? $arrivalDate->copy()->addDays(rand(1, 30)) : null;

        return [
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'middle_name' => $faker->middleName(),
            'email' => fake()->unique()->safeEmail(),
            'phoneNumber' => '+7978' . fake()->unique()->numerify('#######'),
            'status' => $this->generateStatus($departureDate),
            'arrival_date' => $arrivalDate,
            'departure_date' => $departureDate,
            'created_at' => $faker->dateTimeBetween(Carbon::now()->subWeeks(4), Carbon::now()),
        ];
    }

    /**
     * @param Carbon|null $departureDate
     * @return int
     */
    private function generateStatus(?Carbon $departureDate = null): int
    {
        if (!$departureDate) {
            return CustomersStatusEnum::STATUS_LEFT_A_REQUEST;
        }

        if ($departureDate->isAfter(Carbon::now())) {
            return CustomersStatusEnum::STATUS_ACTIVE;
        } else if ($departureDate->isBefore(Carbon::now())) {
            return CustomersStatusEnum::STATUS_INACTIVE;
        }
    }
}
