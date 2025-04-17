<div class="mb-3">
    <label for="name" class="form-label">Timetable Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
           value="{{ old('name', $masterTimetable->name ?? '') }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
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

{{-- Include Select2 and dark mode styles --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 4px;
    }

    body.dark-mode .select2-container--default .select2-selection--multiple {
        background-color: #2c2c2c;
        color: #e0e0e0;
        border: 1px solid #555;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 2px 6px;
        margin: 2px;
        border-radius: 4px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('.select2-multiple').select2({
            placeholder: "Select class codes",
            tags: true,
            tokenSeparators: [',']
        });
    });
</script>
