<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Course;
/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['Active', 'Expired', 'Cancelled', 'Pending']);
        $enrolled_at = now()->subDays(rand(1, 365));
        $access_type = fake()->randomElement(['Free', 'Paid' , 'Granted']);

        return [
            'created_by' => $access_type === 'Granted' ? 1 : null,
            'student_id' => Student::factory(),
            'course_id' => Course::factory(),
            'access_type' => $access_type,
            'enrolled_at' => $enrolled_at,
            'expired_at' => $status === 'Pending' || $status === 'Cancelled'
                ? null
                : fake()->dateTimeBetween($enrolled_at, '+1 month'),
            'status' => $status,
        ];
    }
}
