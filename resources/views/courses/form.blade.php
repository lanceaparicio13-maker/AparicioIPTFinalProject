<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Course Name *</label>
        <input name="name" required maxlength="255"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $course->name ?? '') }}">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3" maxlength="2000"
                  class="form-control">{{ old('description', $course->description ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label">Instructor *</label>
        <select name="instructor_id" required class="form-select @error('instructor_id') is-invalid @enderror">
            <option value="">Select instructor</option>
            @foreach ($instructors as $instructor)
                <option value="{{ $instructor->id }}" @selected((string) old('instructor_id', $course->instructor_id ?? '') === (string) $instructor->id)>
                    {{ $instructor->full_name }} — {{ $instructor->specialty }}
                </option>
            @endforeach
        </select>
        @error('instructor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if ($instructors->isEmpty())
            <div class="form-text text-danger">Add an instructor before creating a course.</div>
        @endif
    </div>

    <div class="col-md-6">
        <label class="form-label">Instrument</label>
        <select name="instrument_id" class="form-select @error('instrument_id') is-invalid @enderror">
            <option value="">No instrument assigned</option>
            @foreach ($instruments as $instrument)
                <option value="{{ $instrument->id }}" @selected((string) old('instrument_id', $course->instrument_id ?? '') === (string) $instrument->id)>
                    {{ $instrument->name }} ({{ $instrument->availability }})
                </option>
            @endforeach
        </select>
        @error('instrument_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Course Fee (₱) *</label>
        <input type="number" name="fee" min="0" max="99999999.99" step="0.01" required
               class="form-control @error('fee') is-invalid @enderror"
               value="{{ old('fee', $course->fee ?? '0.00') }}">
        @error('fee') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Duration (weeks) *</label>
        <input type="number" name="duration_weeks" min="1" max="520" required
               class="form-control @error('duration_weeks') is-invalid @enderror"
               value="{{ old('duration_weeks', $course->duration_weeks ?? 4) }}">
        @error('duration_weeks') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Status *</label>
        <select name="status" required class="form-select">
            @foreach (['Active', 'Inactive'] as $status)
                <option value="{{ $status }}" @selected(old('status', $course->status ?? 'Active') === $status)>{{ $status }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
