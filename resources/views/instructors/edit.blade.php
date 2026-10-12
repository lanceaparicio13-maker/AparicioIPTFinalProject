@extends('layouts.app')
@section('title', 'Edit Instructor')
@section('page-heading', 'Edit Instructor')

@section('content')
<div class="content-card p-4">
    <h5 class="fw-bold mb-3">Edit {{ $instructor->full_name }}</h5>
    <form action="{{ route('instructors.update', $instructor) }}" method="POST">
        @csrf
        @method('PUT')
        @include('instructors.form', ['buttonText' => 'Update Instructor'])
    </form>
</div>
@endsection
