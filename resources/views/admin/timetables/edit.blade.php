@extends('layouts.app')

@section('title', 'Edit Timetable Entry')

@section('content')
    <h1 class="mb-4">✏️ Edit Timetable Entry</h1>

    <form action="{{ route('admin.timetables.update', $timetable->id) }}" method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">
        @csrf
        @method('PUT')

        @include('admin.timetables.partials.form', ['timetable' => $timetable])

        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.timetables.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection

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
