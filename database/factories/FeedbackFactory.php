<?php

namespace Database\Factories;

use App\Models\Customer;
use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('ru_RU');

        return [
            'name' => $faker->firstName(),
            'email' => $faker->unique()->safeEmail(),
            'message' => fake()->unique()->text(),
            'created_at' => $faker->dateTimeBetween(Carbon::now()->subWeeks(4), Carbon::now()),
        ];
    }
}
