@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
    <style>
        .dashboard-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .dashboard-cards .card {
            flex: 1;
            min-width: 280px;
        }

        .dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .dark-mode .card,
        .dark-mode .navbar {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .form-control {
            background-color: #2c2c2c;
            color: #e0e0e0;
        }

        body.dark-mode .btn {
            background-color: unset;
            color: unset;
            border-color: unset;
        }

        body.dark-mode .btn-primary {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        body.dark-mode .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border-color: #dc3545;
        }

        body.dark-mode .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        body.dark-mode .card-body {
            color: #e0e0e0 !important;
        }

        body.dark-mode .card-title {
            color: #e0e0e0 !important;
        }

        body.dark-mode .text-muted {
            color: #bbb !important;
        }
    </style>
@endsection

@section('content')
    <h1 class="mb-4">Admin Dashboard</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>Welcome, {{ auth()->user()->full_name }}</h5>
            <p>You are logged in as an <strong>Administrator</strong>.</p>

            <div class="mt-3 d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">👥 Manage Users</a>
                <a href="{{ route('admin.timetables.index') }}" class="btn btn-primary">📅 Manage Schedule</a>
                <a href="{{ route('admin.master_timetables.index') }}" class="btn btn-primary">📘 Master Timetables</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="dashboard-cards">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="card-title text-muted">System Summary</h6>
                <p class="mb-1"><strong>Users:</strong> {{ \App\Models\User::count() }}</p>
                <p><strong>Admins:</strong> {{ \App\Models\User::where('is_admin', true)->count() }}</p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="card-title text-muted">Recent Activity</h6>
                <p class="mb-1">📌 Feature rollout on {{ now()->subDays(1)->format('M d, Y') }}</p>
                <p class="mb-0">🗂️ Updated layout system</p>
            </div>
        </div>
    </div>

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
