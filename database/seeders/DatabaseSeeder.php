<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\Instrument;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create instructors and instruments first.
        $instructors = Instructor::factory(5)->create();
        $instruments = Instrument::factory(8)->create();

        // Create students.
        $students = Student::factory(20)->create();

        // Create courses with existing instructors and instruments.
        $courseNames = [
            'Beginner Piano',
            'Acoustic Guitar Basics',
            'Violin Fundamentals',
            'Music Theory',
            'Drum Lessons',
            'Vocal Training',
            'Advanced Piano',
            'Ukulele for Beginners',
        ];

        $courses = collect();

        foreach ($courseNames as $index => $name) {
            $courses->push(Course::create([
                'name' => $name,
                'description' => 'Learn and develop practical music skills.',
                'instructor_id' => $instructors[$index % $instructors->count()]->id,
                'instrument_id' => $instruments[$index % $instruments->count()]->id,
                'fee' => [750, 1000, 1250, 1500][$index % 4],
                'duration_weeks' => [4, 8, 12, 16][$index % 4],
                'status' => 'Active',
            ]));
        }

        // Enroll students in courses without duplicate student-course pairs.
        foreach ($students as $studentIndex => $student) {
            $course = $courses[$studentIndex % $courses->count()];

            Enrollment::create([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'enrollment_date' => now()->subDays($studentIndex)->toDateString(),
                'status' => 'Enrolled',
                'notes' => null,
            ]);
        }

        // Add additional enrollments for different courses.
        foreach ($students->take(10) as $index => $student) {
            $course = $courses[($index + 1) % $courses->count()];

            Enrollment::create([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'enrollment_date' => now()->subDays($index + 10)->toDateString(),
                'status' => 'Enrolled',
                'notes' => null,
            ]);
        }
    }
}
