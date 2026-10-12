<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Instrument Name *</label>
        <input name="name" required maxlength="255"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $instrument->name ?? '') }}">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Category *</label>
        <select name="category" required class="form-select @error('category') is-invalid @enderror">
            <option value="">Select category</option>
            @foreach (['Strings', 'Keyboard', 'Percussion', 'Wind', 'Brass', 'Other'] as $category)
                <option value="{{ $category }}" @selected(old('category', $instrument->category ?? '') === $category)>
                    {{ $category }}
                </option>
            @endforeach
        </select>
        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Condition *</label>
        <select name="condition" required class="form-select">
            @foreach (['Excellent', 'Good', 'Fair', 'Needs Repair'] as $condition)
                <option value="{{ $condition }}" @selected(old('condition', $instrument->condition ?? 'Good') === $condition)>
                    {{ $condition }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Quantity *</label>
        <input type="number" name="quantity" min="0" max="10000" required
               class="form-control @error('quantity') is-invalid @enderror"
               value="{{ old('quantity', $instrument->quantity ?? 1) }}">
        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Availability *</label>
        <select name="availability" required class="form-select">
            @foreach (['Available', 'Unavailable', 'Maintenance'] as $availability)
                <option value="{{ $availability }}" @selected(old('availability', $instrument->availability ?? 'Available') === $availability)>
                    {{ $availability }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3" maxlength="2000"
                  class="form-control">{{ old('description', $instrument->description ?? '') }}</textarea>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    <a href="{{ route('instruments.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
