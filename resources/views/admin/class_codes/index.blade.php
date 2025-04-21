@extends('layouts.app')

@section('title', 'Class Codes')

@section('styles')
    <style>
        .dark-mode .card,
        .dark-mode .table {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .table th,
        .dark-mode .table td {
            color: #e0e0e0;
        }

        .dark-mode .btn {
            background-color: unset;
            color: unset;
            border-color: unset;
        }

        .dark-mode .btn-primary {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .dark-mode .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border-color: #dc3545;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>🏷️ Class Codes</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">🏠 Dashboard</a>
    </div>

    <div class="d-flex mb-4">
        <a href="{{ route('admin.class_codes.create') }}" class="btn btn-success">➕ Add Class Code</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($classCodes as $classCode)
                        <tr>
                            <td>{{ $classCode->code }}</td>
                            <td>{{ $classCode->description }}</td>
                            <td>
                                <a href="{{ route('admin.class_codes.edit', $classCode->id) }}" class="btn btn-sm btn-primary">✏️ Edit</a>
                                <form action="{{ route('admin.class_codes.destroy', $classCode->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this class code?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center">No class codes found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const body = document.body;
            const toggleBtn = document.getElementById('themeToggle');
            const isDark = localStorage.getItem('theme') === 'dark';

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
                    localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
                    updateIcon();
                });
            }
        });
    </script>
@endsection
