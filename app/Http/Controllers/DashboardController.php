<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\Instrument;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $studentCount = Student::count();
        $instructorCount = Instructor::count();
        $instrumentCount = Instrument::count();
        $courseCount = Course::count();
        $enrollmentCount = Enrollment::count();

        $recentEnrollments = Enrollment::with([
            'student',
            'course',
        ])->latest()->take(5)->get();

        return view('dashboard', compact(
            'studentCount',
            'instructorCount',
            'instrumentCount',
            'courseCount',
            'enrollmentCount',
            'recentEnrollments'
        ));
    }
}
