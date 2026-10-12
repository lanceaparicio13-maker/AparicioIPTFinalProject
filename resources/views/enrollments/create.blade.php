@extends('layouts.app')
@section('title', 'New Enrollment')
@section('page-heading', 'New Enrollment')

@section('content')
<div class="content-card p-4">
    <h5 class="fw-bold mb-1">Register Student</h5>
    <p class="text-secondary mb-4">Select a student and an active course.</p>

    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf
        @include('enrollments.form', ['buttonText' => 'Save Enrollment'])
    </form>
</div>
@endsection
