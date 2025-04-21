@extends('layouts.app')

@section('title', 'Edit Master Timetable')

@section('content')
    <h1 class="mb-4">✏️ Edit Master Timetable</h1>

    <form action="{{ route('admin.master_timetables.update', $masterTimetable->id) }}" method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">
        @csrf
        @method('PUT')

        @include('admin.master_timetables.partials.form', [
            'masterTimetable' => $masterTimetable,
            'facultyAdmins' => $facultyAdmins,
            'existingClassCodes' => $existingClassCodes ?? [],
            'selectedClassCodes' => $assignedClassCodes ?? [],
        ])

        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.master_timetables.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection

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
            $('.select2-multiple').select2({
                placeholder: "Select class codes",
                tags: true,
                tokenSeparators: [',']
            });
        });
    </script>
@endpush
