@extends('layouts.app')
@section('title', 'Enrollment Details')
@section('page-heading', 'Enrollment Details')

@section('content')
<div class="content-card p-4">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-4">
        <div>
            <h4 class="fw-bold mb-1">Enrollment #{{ $enrollment->id }}</h4>
            <p class="text-secondary mb-0">Registration details</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('enrollments.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="text-secondary small">Student</div>
            <div class="fw-semibold">{{ $enrollment->student->full_name }}</div>
            <div>{{ $enrollment->student->email }}</div>
        </div>
        <div class="col-md-6">
            <div class="text-secondary small">Course</div>
            <div class="fw-semibold">{{ $enrollment->course->name }}</div>
            <div>Instructor: {{ $enrollment->course->instructor->full_name }}</div>
        </div>
        <div class="col-md-6">
            <div class="text-secondary small">Enrollment Date</div>
            <div>{{ $enrollment->enrollment_date->format('F d, Y') }}</div>
        </div>
        <div class="col-md-6">
            <div class="text-secondary small">Status</div>
            <div><span class="badge text-bg-primary">{{ $enrollment->status }}</span></div>
        </div>
        <div class="col-12">
            <div class="text-secondary small">Course Fee</div>
            <div class="fw-semibold">₱{{ number_format((float) $enrollment->course->fee, 2) }}</div>
        </div>
        <div class="col-12">
            <div class="text-secondary small">Notes</div>
            <div>{{ $enrollment->notes ?: 'No notes provided.' }}</div>
        </div>
    </div>
</div>
@endsection
