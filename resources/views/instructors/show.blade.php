@extends('layouts.app')
@section('title', 'Instructor Details')
@section('page-heading', 'Instructor Details')

@section('content')
<div class="content-card p-4">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-4">
        <div>
            <h4 class="fw-bold">{{ $instructor->full_name }}</h4>
            <p class="text-secondary mb-0">{{ $instructor->specialty }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('instructors.edit', $instructor) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('instructors.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6"><span class="text-secondary">Email</span><div>{{ $instructor->email }}</div></div>
        <div class="col-md-6"><span class="text-secondary">Phone</span><div>{{ $instructor->phone ?: 'Not provided' }}</div></div>
        <div class="col-12"><span class="text-secondary">Address</span><div>{{ $instructor->address ?: 'Not provided' }}</div></div>
    </div>

    <hr>
    <h5 class="fw-bold mb-3">Assigned Courses</h5>
    <div class="table-responsive">
        <table class="table">
            <thead><tr><th>Course</th><th>Fee</th><th>Status</th></tr></thead>
            <tbody>
            @forelse ($instructor->courses as $course)
                <tr>
                    <td><a href="{{ route('courses.show', $course) }}">{{ $course->name }}</a></td>
                    <td>₱{{ number_format((float) $course->fee, 2) }}</td>
                    <td>{{ $course->status }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-secondary">No courses assigned.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
