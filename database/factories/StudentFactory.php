<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'parent_phone' => fake()->unique()->phoneNumber(),
            'parent_email' => fake()->unique()->safeEmail(),
            'grade' => fake()->randomElement(['10', '11', '12']),
            'school_name' => fake()->company(),
            'password' => Hash::make('password'),
            'student_type' => fake()->randomElement(['Online', 'Onsite']),
            'status' => fake()->randomElement(['Active', 'Pending' ,'Blocked']),
        ];
    }
}
