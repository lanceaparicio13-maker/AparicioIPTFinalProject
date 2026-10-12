@extends('layouts.app')
@section('title', 'Course Details')
@section('page-heading', 'Course Details')

@section('content')
<div class="content-card p-4">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $course->name }}</h4>
            <span class="badge text-bg-{{ $course->status === 'Active' ? 'success' : 'secondary' }}">{{ $course->status }}</span>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    <p>{{ $course->description ?: 'No description provided.' }}</p>

    <div class="row g-3">
        <div class="col-md-6"><span class="text-secondary">Instructor</span><div>{{ $course->instructor->full_name }}</div></div>
        <div class="col-md-6"><span class="text-secondary">Instrument</span><div>{{ $course->instrument?->name ?? 'None assigned' }}</div></div>
        <div class="col-md-6"><span class="text-secondary">Course Fee</span><div class="fw-semibold">₱{{ number_format((float) $course->fee, 2) }}</div></div>
        <div class="col-md-6"><span class="text-secondary">Duration</span><div>{{ $course->duration_weeks }} weeks</div></div>
    </div>

    <hr>
    <h5 class="fw-bold mb-3">Enrolled Students</h5>
    <div class="table-responsive">
        <table class="table">
            <thead><tr><th>Student</th><th>Email</th><th>Enrollment Date</th><th>Status</th></tr></thead>
            <tbody>
            @forelse ($course->enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->student->full_name }}</td>
                    <td>{{ $enrollment->student->email }}</td>
                    <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                    <td>{{ $enrollment->status }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-secondary">No students enrolled in this course.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
