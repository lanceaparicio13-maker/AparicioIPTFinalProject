@extends('layouts.app')
@section('title', 'Instructors')
@section('page-heading', 'Instructor Management')

@section('content')
<div class="content-card p-3 p-lg-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h5 class="fw-bold mb-1">Instructors</h5>
            <p class="text-secondary small mb-0">Manage your teaching staff.</p>
        </div>
        <a href="{{ route('instructors.create') }}" class="btn btn-primary">+ Add Instructor</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Name</th><th>Email</th><th>Specialty</th>
                    <th>Courses</th><th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($instructors as $instructor)
                <tr>
                    <td class="fw-semibold">{{ $instructor->full_name }}</td>
                    <td>{{ $instructor->email }}</td>
                    <td>{{ $instructor->specialty }}</td>
                    <td><span class="badge text-bg-info">{{ $instructor->courses_count }}</span></td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1 flex-wrap">
                            <a class="btn btn-sm btn-outline-secondary"
                               href="{{ route('instructors.show', $instructor) }}">View</a>
                            <a class="btn btn-sm btn-outline-primary"
                               href="{{ route('instructors.edit', $instructor) }}">Edit</a>
                            <form method="POST" action="{{ route('instructors.destroy', $instructor) }}"
                                  onsubmit="return confirm('Delete this instructor?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-secondary py-4">No instructors registered yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $instructors->links('pagination::bootstrap-5') }}
</div>
@endsection
