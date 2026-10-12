<?php

namespace Database\Factories;

use App\Models\Instructor;
use App\Models\Instrument;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Beginner Piano', 'Acoustic Guitar Basics',
                'Violin Fundamentals', 'Music Theory',
                'Drum Lessons', 'Vocal Training'
            ]) . ' ' . fake()->unique()->numerify('###'),
            'description' => fake()->sentence(),
            'instructor_id' => Instructor::factory(),
            'instrument_id' => Instrument::factory(),
            'fee' => fake()->randomElement([500, 750, 1000, 1500, 2000]),
            'duration_weeks' => fake()->randomElement([4, 8, 12, 16]),
            'status' => 'Active',
        ];
    }
}
