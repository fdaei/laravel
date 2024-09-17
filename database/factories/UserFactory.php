<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mobile' => $this->faker->unique()->phoneNumber(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'address' => $this->faker->address(),
            'password' => Hash::make('password'), // default password
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'created_by' => null,
            'updated_by' => null,
            'avatar' => $this->faker->imageUrl(640, 480, 'people', true, 'Faker'),
            'status' => 'active',
            'email' => $this->faker->unique()->safeEmail(),
            'national_code' => $this->faker->unique()->regexify('[0-9]{10}'),
            'birthdate' => $this->faker->date(),
            // Comment out or remove the remember_token line
            // 'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user's email address should be unverified.
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
