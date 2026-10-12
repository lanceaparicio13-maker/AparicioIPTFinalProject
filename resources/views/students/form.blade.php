<div class="row g-3">
    <div class="col-md-6">
        <label for="first_name" class="form-label">First Name *</label>
        <input type="text" id="first_name" name="first_name"
               class="form-control @error('first_name') is-invalid @enderror"
               value="{{ old('first_name', $student->first_name ?? '') }}"
               maxlength="255" required>
        @error('first_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="last_name" class="form-label">Last Name *</label>
        <input type="text" id="last_name" name="last_name"
               class="form-control @error('last_name') is-invalid @enderror"
               value="{{ old('last_name', $student->last_name ?? '') }}"
               maxlength="255" required>
        @error('last_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Email Address *</label>
        <input type="email" id="email" name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $student->email ?? '') }}"
               maxlength="255" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" id="phone" name="phone"
               class="form-control @error('phone') is-invalid @enderror"
               value="{{ old('phone', $student->phone ?? '') }}"
               maxlength="30">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="birth_date" class="form-label">Birth Date</label>
        <input type="date" id="birth_date" name="birth_date"
               max="{{ now()->subDay()->toDateString() }}"
               class="form-control @error('birth_date') is-invalid @enderror"
               value="{{ old('birth_date', isset($student) && $student->birth_date ? $student->birth_date->format('Y-m-d') : '') }}">
        @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="address" class="form-label">Address</label>
        <textarea id="address" name="address" rows="3"
                  class="form-control @error('address') is-invalid @enderror"
                  maxlength="2000">{{ old('address', $student->address ?? '') }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        {{ $buttonText }}
    </button>

    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
        Cancel
    </a>
</div>
