@extends('layouts.app')
@section('title', 'Edit Enrollment')
@section('page-heading', 'Edit Enrollment')

@section('content')
<div class="content-card p-4">
    <h5 class="fw-bold mb-1">Update Enrollment</h5>
    <p class="text-secondary mb-4">Change the course, student, date, or status.</p>

    <form action="{{ route('enrollments.update', $enrollment) }}" method="POST">
        @csrf
        @method('PUT')
        @include('enrollments._form', ['buttonText' => 'Update Enrollment'])
    </form>
</div>
@endsection
