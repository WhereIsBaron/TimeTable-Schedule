<div class="mb-3">
    <label for="title" class="form-label">Timetable Title</label>
    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
           value="{{ old('title', $masterTimetable->title ?? '') }}" required>
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
    <select name="class_codes[]" id="class_codes" class="form-select select2-multiple @error('class_codes') is-invalid @enderror" multiple="multiple">
        @foreach($existingClassCodes as $code)
            <option value="{{ $code }}"
                {{ collect(old('class_codes', $selectedClassCodes ?? []))->contains($code) ? 'selected' : '' }}>
                {{ $code }}
            </option>
        @endforeach
    </select>
    @error('class_codes') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

{{-- Select2 and dark mode styling --}}
@push('styles')
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
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('#class_codes').select2({
                placeholder: "Select or type class codes",
                tags: true,
                tokenSeparators: [',']
            });
        });
    </script>
@endpush
