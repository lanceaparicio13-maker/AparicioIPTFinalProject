@extends('layouts.app')
@section('title', 'Edit Course')
@section('page-heading', 'Edit Course')

@section('content')
<div class="content-card p-4">
    <h5 class="fw-bold mb-3">Edit {{ $course->name }}</h5>
    <form action="{{ route('courses.update', $course) }}" method="POST">
        @csrf
        @method('PUT')
        @include('courses.form', ['buttonText' => 'Update Course'])
    </form>
</div>
@endsection
