<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Instrument;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['instructor', 'instrument'])
            ->withCount('enrollments')
            ->latest()
            ->paginate(10);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $instructors = Instructor::orderBy('last_name')->get();
        $instruments = Instrument::orderBy('name')->get();

        return view('courses.create', compact(
            'instructors',
            'instruments'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'instructor_id' => ['required', 'exists:instructors,id'],
            'instrument_id' => ['nullable', 'exists:instruments,id'],
            'fee' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'duration_weeks' => ['required', 'integer', 'min:1', 'max:520'],
            'status' => ['required', 'in:Active,Inactive'],
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')
            ->with('success', 'Course added successfully.');
    }

    public function show(Course $course)
    {
        $course->load([
            'instructor',
            'instrument',
            'enrollments.student',
        ]);

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $instructors = Instructor::orderBy('last_name')->get();
        $instruments = Instrument::orderBy('name')->get();

        return view('courses.edit', compact(
            'course',
            'instructors',
            'instruments'
        ));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'instructor_id' => ['required', 'exists:instructors,id'],
            'instrument_id' => ['nullable', 'exists:instruments,id'],
            'fee' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'duration_weeks' => ['required', 'integer', 'min:1', 'max:520'],
            'status' => ['required', 'in:Active,Inactive'],
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        if ($course->enrollments()->exists()) {
            return redirect()->route('courses.index')
                ->with('error', 'This course has enrollments. Remove those enrollments first.');
        }

        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
