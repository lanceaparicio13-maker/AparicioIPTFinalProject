@extends('layouts.app')
@section('title', 'Edit Instrument')
@section('page-heading', 'Edit Instrument')

@section('content')
<div class="content-card p-4">
    <h5 class="fw-bold mb-3">Edit {{ $instrument->name }}</h5>
    <form method="POST" action="{{ route('instruments.update', $instrument) }}">
        @csrf
        @method('PUT')
        @include('instruments.form', ['buttonText' => 'Update Instrument'])
    </form>
</div>
@endsection
