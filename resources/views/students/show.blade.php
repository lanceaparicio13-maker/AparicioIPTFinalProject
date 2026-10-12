@extends('layouts.app')

@section('title', 'Student Details')
@section('page-heading', 'Student Details')

@section('content')
<div class="content-card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h4 class="fw-bold mb-1">{{ $student->full_name }}</h4>
            <p class="text-secondary mb-0">Student ID: {{ $student->id }}</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('students.edit', $student) }}"
               class="btn btn-primary">Edit</a>

            <a href="{{ route('students.index') }}"
               class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="text-secondary small">Email Address</div>
            <div class="fw-semibold">{{ $student->email }}</div>
        </div>

        <div class="col-md-6">
            <div class="text-secondary small">Phone Number</div>
            <div>{{ $student->phone ?: 'Not provided' }}</div>
        </div>

        <div class="col-md-6">
            <div class="text-secondary small">Birth Date</div>
            <div>{{ $student->birth_date?->format('F d, Y') ?? 'Not provided' }}</div>
        </div>

        <div class="col-md-6">
            <div class="text-secondary small">Date Registered</div>
            <div>{{ $student->created_at->format('F d, Y') }}</div>
        </div>

        <div class="col-12">
            <div class="text-secondary small">Address</div>
            <div>{{ $student->address ?: 'Not provided' }}</div>
        </div>
    </div>

    <hr class="my-4">

    <h5 class="fw-bold mb-3">Enrollment History</h5>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Course</th>
                <th>Enrollment Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($student->enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->course->name }}</td>
                    <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                    <td>{{ $enrollment->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-secondary text-center py-3">
                        This student has no enrollments yet.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
