@extends('layouts.app')
@section('title', 'Courses')
@section('page-heading', 'Course Management')

@section('content')
<div class="content-card p-3 p-lg-4">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-4">
        <div>
            <h5 class="fw-bold mb-1">Courses</h5>
            <p class="text-secondary small mb-0">Manage courses, instructors, and fees.</p>
        </div>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">+ Add Course</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>Course</th><th>Instructor</th><th>Instrument</th><th>Fee</th><th>Duration</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
            @forelse ($courses as $course)
                <tr>
                    <td class="fw-semibold">{{ $course->name }}</td>
                    <td>{{ $course->instructor->full_name }}</td>
                    <td>{{ $course->instrument?->name ?? '—' }}</td>
                    <td>₱{{ number_format((float) $course->fee, 2) }}</td>
                    <td>{{ $course->duration_weeks }} weeks</td>
                    <td><span class="badge text-bg-{{ $course->status === 'Active' ? 'success' : 'secondary' }}">{{ $course->status }}</span></td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('courses.show', $course) }}">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('courses.edit', $course) }}">Edit</a>
                            <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-secondary py-4">No courses created yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $courses->links('pagination::bootstrap-5') }}
</div>
@endsection
