@extends('layouts.app')
@section('title', 'Instruments')
@section('page-heading', 'Instrument Inventory')

@section('content')
<div class="content-card p-3 p-lg-4">
    <div class="d-flex justify-content-between flex-wrap gap-2 mb-4">
        <div>
            <h5 class="fw-bold mb-1">Instruments</h5>
            <p class="text-secondary small mb-0">Manage inventory and condition.</p>
        </div>
        <a href="{{ route('instruments.create') }}" class="btn btn-primary">+ Add Instrument</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead><tr><th>Name</th><th>Category</th><th>Quantity</th><th>Condition</th><th>Availability</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse ($instruments as $instrument)
                <tr>
                    <td class="fw-semibold">{{ $instrument->name }}</td>
                    <td>{{ $instrument->category }}</td>
                    <td>{{ $instrument->quantity }}</td>
                    <td>{{ $instrument->condition }}</td>
                    <td><span class="badge text-bg-{{ $instrument->availability === 'Available' ? 'success' : ($instrument->availability === 'Maintenance' ? 'warning' : 'secondary') }}">{{ $instrument->availability }}</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('instruments.show', $instrument) }}">View</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('instruments.edit', $instrument) }}">Edit</a>
                            <form method="POST" action="{{ route('instruments.destroy', $instrument) }}" onsubmit="return confirm('Delete this instrument?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-secondary py-4">No instruments registered yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $instruments->links('pagination::bootstrap-5') }}
</div>
@endsection
