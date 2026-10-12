<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course'])
            ->latest()
            ->paginate(10);

        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::orderBy('last_name')->get();
        $courses = Course::where('status', 'Active')
            ->orderBy('name')
            ->get();

        return view('enrollments.create', compact(
            'students',
            'courses'
        ));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'student_id' => ['required', 'exists:students,id'],
        'course_id' => ['required', 'exists:courses,id'],
        'enrollment_date' => ['required', 'date', 'before_or_equal:today'],
        'status' => ['required', 'in:Enrolled,Completed,Dropped'],
        'notes' => ['nullable', 'string', 'max:2000'],
    ]);

    try {
        Enrollment::create($validated);
    } catch (QueryException $e) {
        if ($e->getCode() === '23000') {
            return back()
                ->withErrors([
                    'course_id' => 'This student is already enrolled in that course.',
                ])
                ->withInput();
        }

        throw $e;
    }

    return redirect()->route('enrollments.index')
        ->with('success', 'Enrollment created successfully.');
}


    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'course.instructor']);

        return view('enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::orderBy('last_name')->get();
        $courses = Course::orderBy('name')->get();

        return view('enrollments.edit', compact(
            'enrollment',
            'students',
            'courses'
        ));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'enrollment_date' => ['required', 'date', 'before_or_equal:today'],
            'status' => ['required', 'in:Enrolled,Completed,Dropped'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $duplicate = Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->where('id', '!=', $enrollment->id)
            ->exists();

        if ($duplicate) {
            return back()
                ->withErrors([
                    'course_id' => 'This student is already enrolled in that course.',
                ])
                ->withInput();
        }

        $enrollment->update($validated);

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment deleted successfully.');
    }
}
