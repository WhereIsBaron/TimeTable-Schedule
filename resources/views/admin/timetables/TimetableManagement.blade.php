@extends('layouts.app')

@section('title', 'Manage Timetables')

@section('styles')
    <style>
        .dark-mode .table th,
        .dark-mode .table td {
            color: #e0e0e0;
            background-color: #1e1e1e;
            border-color: #333;
        }

        .dark-mode .table thead {
            background-color: #2c2c2c;
        }

        .filter-input {
            max-width: 300px;
        }

        body.dark-mode .filter-input {
            background-color: #2c2c2c;
            color: #e0e0e0;
            border: 1px solid #555;
        }

        body.dark-mode .filter-input::placeholder {
            color: #bbb;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📅 Timetable Management</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">🏠 Back to Dashboard</a>
            <a href="{{ route('admin.timetables.export') }}" class="btn btn-outline-secondary">⬇️ Export CSV</a>
        </div>
    </div>

    <div class="d-flex mb-4">
        <a href="{{ route('admin.timetables.create') }}" class="btn btn-success">➕ Add Entry</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <input type="text" id="filterInput" class="form-control filter-input" placeholder="Filter by class code...">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Class Code</th>
                    <th>Instructor</th>
                    <th>Room</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($timetables as $timetable)
                    <tr class="timetable-row" data-class="{{ strtolower($timetable->class_code) }}">
                        <td>{{ $timetable->class_code }}</td>
                        <td>{{ $timetable->instructor_name }}</td>
                        <td>{{ $timetable->room }}</td>
                        <td>{{ $timetable->day_of_week }}</td>
                        <td>{{ $timetable->start_time }} - {{ $timetable->end_time }}</td>
                        <td>
                            <a href="{{ route('admin.timetables.edit', $timetable->id) }}" class="btn btn-sm btn-primary">✏️ Edit</a>
                            <form action="{{ route('admin.timetables.destroy', $timetable->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this entry?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No timetable entries found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $timetables->links('pagination::bootstrap-5') }}
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('filterInput').addEventListener('input', function () {
            const filter = this.value.toLowerCase();
            document.querySelectorAll('.timetable-row').forEach(row => {
                const classCode = row.getAttribute('data-class');
                row.style.display = classCode.includes(filter) ? '' : 'none';
            });
        });

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
