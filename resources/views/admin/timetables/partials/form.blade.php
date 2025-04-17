<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror"
           name="title" id="title" value="{{ old('title', $masterTimetable->title ?? '') }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $masterTimetable->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="faculty_admin_id" class="form-label">Assign Faculty Admin</label>
    <select name="faculty_admin_id" id="faculty_admin_id" class="form-select @error('faculty_admin_id') is-invalid @enderror" required>
        <option value="">Select a faculty admin</option>
        @foreach($facultyAdmins as $admin)
            <option value="{{ $admin->id }}" {{ old('faculty_admin_id', $masterTimetable->faculty_admin_id ?? '') == $admin->id ? 'selected' : '' }}>
                {{ $admin->full_name }}
            </option>
        @endforeach
    </select>
    @error('faculty_admin_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="class_codes" class="form-label">Class Codes (Tags)</label>
    <select name="class_codes[]" id="class_codes" class="form-select select2-multiple" multiple="multiple">
        @foreach($existingClassCodes as $code)
            <option value="{{ $code }}"
                {{ collect(old('class_codes', $selectedClassCodes ?? []))->contains($code) ? 'selected' : '' }}>
                {{ $code }}
            </option>
        @endforeach
    </select>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('.select2-multiple').select2({
            placeholder: "Select class codes",
            tags: true,
            tokenSeparators: [',']
        });
    });
</script>
@endpush
