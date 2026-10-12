@extends('layouts.app')
@section('title', 'Instrument Details')
@section('page-heading', 'Instrument Details')

@section('content')
<div class="content-card p-4">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-4">
        <h4 class="fw-bold">{{ $instrument->name }}</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('instruments.edit', $instrument) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('instruments.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6"><span class="text-secondary">Category</span><div>{{ $instrument->category }}</div></div>
        <div class="col-md-6"><span class="text-secondary">Quantity</span><div>{{ $instrument->quantity }}</div></div>
        <div class="col-md-6"><span class="text-secondary">Condition</span><div>{{ $instrument->condition }}</div></div>
        <div class="col-md-6"><span class="text-secondary">Availability</span><div>{{ $instrument->availability }}</div></div>
        <div class="col-12"><span class="text-secondary">Description</span><div>{{ $instrument->description ?: 'No description provided.' }}</div></div>
    </div>

    <hr>
    <h5 class="fw-bold">Associated Courses</h5>
    <ul class="mb-0">
        @forelse ($instrument->courses as $course)
            <li><a href="{{ route('courses.show', $course) }}">{{ $course->name }}</a></li>
        @empty
            <li class="text-secondary">No courses use this instrument.</li>
        @endforelse
    </ul>
</div>
@endsection
