@extends('layouts.app')
@section('title', 'Add Course')
@section('page-heading', 'Add Course')

@section('content')
<div class="content-card p-4">
    <h5 class="fw-bold mb-3">New Course</h5>
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        @include('courses.form', ['buttonText' => 'Save Course'])
    </form>
</div>
@endsection
