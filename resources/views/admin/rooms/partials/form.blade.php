<div class="mb-3">
    <label for="name" class="form-label">Room Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $room->name ?? '') }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="type" class="form-label">Type</label>
    <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror"
           value="{{ old('type', $room->type ?? '') }}">
    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="capacity" class="form-label">Capacity</label>
    <input type="number" name="capacity" id="capacity" class="form-control @error('capacity') is-invalid @enderror"
           value="{{ old('capacity', $room->capacity ?? '') }}" required>
    @error('capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Available</label>
    <div>
        <div class="form-check form-check-inline">
            <input type="radio" name="is_available" id="available_yes" value="1"
                   class="form-check-input" {{ old('is_available', $room->is_available ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="available_yes">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" name="is_available" id="available_no" value="0"
                   class="form-check-input" {{ old('is_available', $room->is_available ?? true) === false ? 'checked' : '' }}>
            <label class="form-check-label" for="available_no">No</label>
        </div>
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" rows="3"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $room->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
