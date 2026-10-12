@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard Overview')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1">Welcome to Melody Music School</h4>
    <p class="text-secondary mb-0">
        Here's an overview of your school's current records.
    </p>
</div>

<div class="row g-3 mb-4">
    @php
        $stats = [
            ['label' => 'Students', 'count' => $studentCount, 'color' => 'primary', 'route' => 'students.index'],
            ['label' => 'Instructors', 'count' => $instructorCount, 'color' => 'success', 'route' => 'instructors.index'],
            ['label' => 'Instruments', 'count' => $instrumentCount, 'color' => 'warning', 'route' => 'instruments.index'],
            ['label' => 'Courses', 'count' => $courseCount, 'color' => 'info', 'route' => 'courses.index'],
            ['label' => 'Enrollments', 'count' => $enrollmentCount, 'color' => 'danger', 'route' => 'enrollments.index'],
        ];
    @endphp

    @foreach ($stats as $stat)
        <div class="col-sm-6 col-xl-4">
            <div class="card stat-card h-100">
                <div class="card-body p-4">
                    <div class="text-secondary mb-2">
                        {{ $stat['label'] }}
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold mb-0">
                            {{ $stat['count'] }}
                        </h2>

                        <span class="badge text-bg-{{ $stat['color'] }}">
                            Total
                        </span>
                    </div>

                    <a href="{{ route($stat['route']) }}"
                       class="small text-decoration-none d-inline-block mt-3">
                        Manage {{ strtolower($stat['label']) }} &rarr;
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="content-card p-3 p-lg-4 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <div>
            <h5 class="fw-bold mb-1">Recent Enrollments</h5>
            <p class="text-secondary small mb-0">
                The five most recently created enrollment records.
            </p>
        </div>

        <a href="{{ route('enrollments.index') }}"
           class="btn btn-outline-primary btn-sm">
            View all
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
            <tr>
                <th>Student</th>
                <th>Course</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($recentEnrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->student->full_name }}</td>
                    <td>{{ $enrollment->course->name }}</td>
                    <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                    <td>
                        <span class="badge text-bg-secondary">
                            {{ $enrollment->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-secondary py-4">
                        No enrollments yet. Add students and courses, then
                        create your first enrollment.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="content-card p-4">
    <h5 class="fw-bold mb-3">Quick Actions</h5>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            + Add Student
        </a>
        <a href="{{ route('instructors.create') }}" class="btn btn-outline-primary">
            + Add Instructor
        </a>
        <a href="{{ route('courses.create') }}" class="btn btn-outline-primary">
            + Add Course
        </a>
        <a href="{{ route('enrollments.create') }}" class="btn btn-outline-primary">
            + New Enrollment
        </a>
    </div>
</div>
@endsection
