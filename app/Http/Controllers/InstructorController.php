<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::withCount('courses')
            ->latest()
            ->paginate(10);

        return view('instructors.index', compact('instructors'));
    }

    public function create()
    {
        return view('instructors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:instructors,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'specialty' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:2000'],
        ]);

        Instructor::create($validated);

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor added successfully.');
    }

    public function show(Instructor $instructor)
    {
        $instructor->load('courses');

        return view('instructors.show', compact('instructor'));
    }

    public function edit(Instructor $instructor)
    {
        return view('instructors.edit', compact('instructor'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('instructors', 'email')->ignore($instructor->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'specialty' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:2000'],
        ]);

        $instructor->update($validated);

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor updated successfully.');
    }

    public function destroy(Instructor $instructor)
    {
        try {
            $instructor->delete();
        } catch (QueryException $e) {
            return redirect()->route('instructors.index')
                ->with('error', 'This instructor has assigned courses. Reassign or remove those courses first.');
        }

        return redirect()->route('instructors.index')
            ->with('success', 'Instructor deleted successfully.');
    }
}
