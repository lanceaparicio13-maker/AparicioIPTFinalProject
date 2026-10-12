@extends('layouts.app')

@section('title', 'Edit Student')
@section('page-heading', 'Edit Student')

@section('content')
<div class="content-card p-4">
    <h5 class="fw-bold mb-1">Update Student</h5>
    <p class="text-secondary mb-4">
        Edit the information for {{ $student->full_name }}.
    </p>

    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')

        @include('students.form', [
            'buttonText' => 'Update Student'
        ])
    </form>
</div>
@endsection
