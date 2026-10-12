@extends('layouts.app')
@section('title', 'Add Instrument')
@section('page-heading', 'Add Instrument')

@section('content')
<div class="content-card p-4">
    <h5 class="fw-bold mb-3">New Instrument</h5>
    <form method="POST" action="{{ route('instruments.store') }}">
        @csrf
        @include('instruments.form', ['buttonText' => 'Save Instrument'])
    </form>
</div>
@endsection
