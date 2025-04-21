@extends('layouts.app')

@section('title', 'Create Master Timetable')

@section('styles')
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
@endsection

@section('content')
    <!-- Top navigation buttons -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">➕ Create Master Timetable</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">🏠 Dashboard</a>
            <a href="{{ route('admin.master_timetables.index') }}" class="btn btn-outline-secondary">🔙 Back</a>
        </div>
    </div>

    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('admin.master_timetables.store') }}" method="POST">
                @csrf

                @include('admin.master_timetables.partials.form', [
                    'masterTimetable' => null,
                    'facultyAdmins' => $facultyAdmins,
                    'existingClassCodes' => $existingClassCodes ?? [],
                    'selectedClassCodes' => [],
                ])

                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-success">Create</button>
                    <a href="{{ route('admin.master_timetables.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const isDark = localStorage.getItem('theme') === 'dark';
            const body = document.body;
            const toggleBtn = document.getElementById('themeToggle');

            if (isDark) body.classList.add('dark-mode');

            const updateIcon = () => {
                if (toggleBtn) {
                    toggleBtn.textContent = body.classList.contains('dark-mode') ? '☀️' : '🌙';
                }
            };

            updateIcon();

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    body.classList.toggle('dark-mode');
                    const theme = body.classList.contains('dark-mode') ? 'dark' : 'light';
                    localStorage.setItem('theme', theme);
                    updateIcon();
                });
            }
        });
    </script>
@endsection
