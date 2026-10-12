<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="first_name">First Name *</label>
        <input id="first_name" name="first_name" required maxlength="255"
               class="form-control @error('first_name') is-invalid @enderror"
               value="{{ old('first_name', $instructor->first_name ?? '') }}">
        @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label" for="last_name">Last Name *</label>
        <input id="last_name" name="last_name" required maxlength="255"
               class="form-control @error('last_name') is-invalid @enderror"
               value="{{ old('last_name', $instructor->last_name ?? '') }}">
        @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label" for="email">Email *</label>
        <input type="email" id="email" name="email" required maxlength="255"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $instructor->email ?? '') }}">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label" for="phone">Phone</label>
        <input id="phone" name="phone" maxlength="30"
               class="form-control @error('phone') is-invalid @enderror"
               value="{{ old('phone', $instructor->phone ?? '') }}">
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label" for="specialty">Specialty *</label>
        <input id="specialty" name="specialty" required maxlength="255"
               placeholder="e.g. Piano, Guitar, Violin"
               class="form-control @error('specialty') is-invalid @enderror"
               value="{{ old('specialty', $instructor->specialty ?? '') }}">
        @error('specialty') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label" for="address">Address</label>
        <textarea id="address" name="address" rows="3" maxlength="2000"
                  class="form-control @error('address') is-invalid @enderror">{{ old('address', $instructor->address ?? '') }}</textarea>
        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    <a href="{{ route('instructors.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
