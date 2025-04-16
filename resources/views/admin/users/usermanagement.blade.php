@extends('layouts.app')

@section('title', 'User Management')

@section('styles')
    <style>
        .collapse-toggle {
            cursor: pointer;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .card-header .badge {
            font-size: 0.9rem;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        /* Ensure buttons do not change in dark mode */
        body.dark-mode .btn {
            background-color: unset;
            color: unset;
            border-color: unset;
        }

        body.dark-mode .btn-success {
            background-color: #28a745;
            color: #fff;
            border-color: #28a745;
        }

        body.dark-mode .btn-secondary {
            background-color: #6c757d;
            color: #fff;
            border-color: #6c757d;
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
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Management</h1>
        <div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-success">Create New User</a>
            <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-4">
        <div class="d-flex">
            <input type="text" class="form-control filter-input mr-2" id="classFilter" placeholder="Filter by class code...">
            <select class="form-control filter-input mr-2" id="roleFilter">
                <option value="">Filter by role</option>
                <option value="admin">Admin</option>
                <option value="student">Student</option>
            </select>
            <input type="text" class="form-control filter-input" id="emailFilter" placeholder="Filter by email...">
        </div>
    </div>

    @foreach($groupedUsers as $classCode => $classUsers)
        <div class="card mb-4 class-group" data-class="{{ strtolower($classCode ?? 'unassigned') }}">
            <div class="card-header bg-dark text-white collapse-toggle" data-bs-toggle="collapse" data-bs-target="#group-{{ $loop->index }}" aria-expanded="true">
                <span>Class Code: {{ $classCode ?? 'Unassigned' }}</span>
                <span class="badge bg-light text-dark">{{ $classUsers->count() }} Users</span>
            </div>
            <div id="group-{{ $loop->index }}" class="collapse show">
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Student ID</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classUsers as $user)
                                <tr>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->student_id }}</td>
                                    <td>{{ $user->is_admin ? 'Admin' : 'Student' }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script>
        document.getElementById('classFilter').addEventListener('input', function () {
            const classFilter = this.value.toLowerCase();
            document.querySelectorAll('.class-group').forEach(group => {
                const classCode = group.getAttribute('data-class');
                group.style.display = classCode.includes(classFilter) ? '' : 'none';
            });
        });

        document.getElementById('roleFilter').addEventListener('change', function () {
            const roleFilter = this.value.toLowerCase();
            document.querySelectorAll('.class-group').forEach(group => {
                const users = group.querySelectorAll('tbody tr');
                users.forEach(user => {
                    const role = user.cells[3].textContent.toLowerCase();
                    user.style.display = role === roleFilter || roleFilter === '' ? '' : 'none';
                });
            });
        });

        document.getElementById('emailFilter').addEventListener('input', function () {
            const emailFilter = this.value.toLowerCase();
            document.querySelectorAll('.class-group').forEach(group => {
                const users = group.querySelectorAll('tbody tr');
                users.forEach(user => {
                    const email = user.cells[1].textContent.toLowerCase();
                    user.style.display = email.includes(emailFilter) ? '' : 'none';
                });
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

        updateIcon(); // Set icon on load

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                body.classList.toggle('dark-mode');
                const theme = body.classList.contains('dark-mode') ? 'dark' : 'light';
                localStorage.setItem('theme', theme);
                updateIcon(); // Update icon after toggle
            });
        }
    });
    </script>
@endsection