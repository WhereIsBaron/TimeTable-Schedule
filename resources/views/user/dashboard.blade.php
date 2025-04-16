@extends('layouts.app')

@section('title', 'User Dashboard')

@section('styles')
    <style>
        body.dark-mode {
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
            border: 1px solid #555;
        }

        /* Buttons retain default Bootstrap appearance */
    </style>
@endsection

@section('content')
    <h1 class="mb-4">User Dashboard</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h5>Welcome, {{ auth()->user()->full_name }}</h5>
            <p>Class Code: <strong>{{ auth()->user()->class_code ?? 'N/A' }}</strong></p>

            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
@endsection
