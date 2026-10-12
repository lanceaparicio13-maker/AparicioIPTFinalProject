@extends('layouts.app')

@section('title', 'Add Student')
@section('page-heading', 'Add Student')

@section('content')
<div class="content-card p-4">
    <h5 class="fw-bold mb-1">New Student</h5>
    <p class="text-secondary mb-4">
        Enter the student's information below.
    </p>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        @include('students.form', [
            'buttonText' => 'Save Student'
        ])
    </form>
</div>
@endsection
