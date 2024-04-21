<?php

namespace Database\Factories;

use App\Models\Customer;
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
            'message' => fake()->unique()->text(),
            'feedback_photo' => $faker->imageUrl('640', '480', 'feedback'),
            'customer_id' => Customer::factory(),
        ];
    }
}
