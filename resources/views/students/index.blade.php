@extends('layouts.app')

@section('title', 'Students')
@section('page-heading', 'Student Management')

@section('content')
<div class="content-card p-3 p-lg-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h5 class="fw-bold mb-1">Students</h5>
            <p class="text-secondary small mb-0">
                Manage student records and contact details.
            </p>
        </div>

        <a href="{{ route('students.create') }}" class="btn btn-primary">
            + Add Student
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Birth Date</th>
                <th class="text-end">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($students as $student)
                <tr>
                    <td class="fw-semibold">{{ $student->full_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone ?: '—' }}</td>
                    <td>
                        {{ $student->birth_date?->format('M d, Y') ?? '—' }}
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex flex-wrap gap-1">
                            <a href="{{ route('students.show', $student) }}"
                               class="btn btn-sm btn-outline-secondary">
                                View
                            </a>

                            <a href="{{ route('students.edit', $student) }}"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <form action="{{ route('students.destroy', $student) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this student?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-secondary py-5">
                        No students found. Click Add Student to create your first record.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $students->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
