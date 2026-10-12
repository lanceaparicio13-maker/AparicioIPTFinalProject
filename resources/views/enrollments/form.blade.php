<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Student *</label>
        <select name="student_id" required class="form-select @error('student_id') is-invalid @enderror">
            <option value="">Select student</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}" @selected((string) old('student_id', $enrollment->student_id ?? '') === (string) $student->id)>
                    {{ $student->full_name }} — {{ $student->email }}
                </option>
            @endforeach
        </select>
        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if ($students->isEmpty())
            <div class="form-text text-danger">Add a student before creating an enrollment.</div>
        @endif
    </div>

    <div class="col-md-6">
        <label class="form-label">Course *</label>
        <select name="course_id" required class="form-select @error('course_id') is-invalid @enderror">
            <option value="">Select course</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}" @selected((string) old('course_id', $enrollment->course_id ?? '') === (string) $course->id)>
                    {{ $course->name }} — ₱{{ number_format((float) $course->fee, 2) }}
                </option>
            @endforeach
        </select>
        @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if ($courses->isEmpty())
            <div class="form-text text-danger">Create a course before creating an enrollment.</div>
        @endif
    </div>

    <div class="col-md-6">
        <label class="form-label">Enrollment Date *</label>
        <input type="date" name="enrollment_date" required
               max="{{ now()->toDateString() }}"
               class="form-control @error('enrollment_date') is-invalid @enderror"
               value="{{ old('enrollment_date', isset($enrollment) ? $enrollment->enrollment_date->format('Y-m-d') : now()->toDateString()) }}">
        @error('enrollment_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Status *</label>
        <select name="status" required class="form-select">
            @foreach (['Enrolled', 'Completed', 'Dropped'] as $status)
                <option value="{{ $status }}" @selected(old('status', $enrollment->status ?? 'Enrolled') === $status)>
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" rows="3" maxlength="2000"
                  class="form-control">{{ old('notes', $enrollment->notes ?? '') }}</textarea>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    <a href="{{ route('enrollments.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
