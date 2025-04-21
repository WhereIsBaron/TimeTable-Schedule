@extends('layouts.app')

@section('title', 'Add Class Code')

@section('styles')
    <style>
        .dark-mode .card,
        .dark-mode .form-control {
            background-color: #1e1e1e;
            color: #e0e0e0;
            border-color: #444;
        }

        .dark-mode .form-control::placeholder {
            color: #aaa;
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

        .dark-mode .btn-secondary {
            background-color: #6c757d;
            color: #fff;
            border-color: #6c757d;
        }

        .dark-mode .btn-success {
            background-color: #28a745;
            color: #fff;
            border-color: #28a745;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>➕ Add Class Code</h1>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2">← Back</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">🏠 Dashboard</a>
        </div>
    </div>

    <form action="{{ route('admin.class_codes.store') }}" method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">
        @csrf
        @include('admin.class_codes.partials.form')
        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-success">Create</button>
            <a href="{{ route('admin.class_codes.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
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
