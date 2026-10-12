@extends('layouts.app')
@section('title', 'Enrollments')
@section('page-heading', 'Enrollment Management')

@section('content')
<div class="content-card p-3 p-lg-4">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-4">
        <div>
            <h5 class="fw-bold mb-1">Enrollments</h5>
            <p class="text-secondary small mb-0">Manage student course registrations.</p>
        </div>
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">+ New Enrollment</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>Student</th><th>Course</th><th>Instructor</th><th>Date</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
            @forelse ($enrollments as $enrollment)
                <tr>
                    <td class="fw-semibold">{{ $enrollment->student->full_name }}</td>
                    <td>{{ $enrollment->course->name }}</td>
                    <td>{{ $enrollment->course->instructor->full_name }}</td>
                    <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                    <td>
                        <span class="badge text-bg-{{ $enrollment->status === 'Enrolled' ? 'primary' : ($enrollment->status === 'Completed' ? 'success' : 'secondary') }}">
                            {{ $enrollment->status }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('enrollments.show', $enrollment) }}">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('enrollments.edit', $enrollment) }}">Edit</a>
                            <form method="POST" action="{{ route('enrollments.destroy', $enrollment) }}" onsubmit="return confirm('Delete this enrollment?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-secondary py-4">No enrollments yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $enrollments->links('pagination::bootstrap-5') }}
</div>
@endsection
