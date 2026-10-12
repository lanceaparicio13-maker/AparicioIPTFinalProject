@extends('layouts.app')
@section('title', 'Add Instructor')
@section('page-heading', 'Add Instructor')

@section('content')
<div class="content-card p-4">
    <h5 class="fw-bold mb-3">New Instructor</h5>
    <form action="{{ route('instructors.store') }}" method="POST">
        @csrf
        @include('instructors.form', ['buttonText' => 'Save Instructor'])
    </form>
</div>
@endsection
