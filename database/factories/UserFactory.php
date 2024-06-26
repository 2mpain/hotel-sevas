<?php

namespace Database\Factories;

use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

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
            'username' => fake()->username(),
            'email' => fake()->unique()->safeEmail(),
            'phoneNumber' => '+7978' . fake()->unique()->numerify('#######'),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => fake()->randomElement(['admin', 'user']),
            'remember_token' => Str::random(10),
            'created_at' => $faker->dateTimeBetween(Carbon::now()->subWeeks(3), Carbon::now()),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
