<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Factory as FakerFactory;

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

        $arrivalDate = Carbon::now()->subDays(rand(1, 30));
        $departureDate = $arrivalDate->addDays(rand(1, 30));

        return [
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'middle_name' => $faker->middleName(),
            'email' => fake()->unique()->safeEmail(),
            'phoneNumber' => '+7978' . fake()->unique()->numerify('#######'),
            'status' => fake()->randomElement(['left_a_request', 'active', 'inactive']),
            'arrival_date' => $arrivalDate,
            'departure_date' => $departureDate,
        ];
    }
}
