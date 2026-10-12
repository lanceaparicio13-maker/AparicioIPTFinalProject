<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'course_id' => Course::factory(),
            'enrollment_date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'status' => fake()->randomElement([
                'Enrolled', 'Completed', 'Dropped'
            ]),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
