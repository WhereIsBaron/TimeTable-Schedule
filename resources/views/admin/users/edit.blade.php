<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .dark-mode .card, .dark-mode .navbar {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .form-control {
            background-color: #2c2c2c;
            color: #e0e0e0;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit User</h2>
        <button id="themeToggle" class="btn btn-sm btn-outline-secondary">Toggle Dark Mode</button>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="card shadow p-4">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                               id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
                        @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student ID</label>
                        <input type="text" class="form-control @error('student_id') is-invalid @enderror"
                               id="student_id" name="student_id" value="{{ old('student_id', $user->student_id) }}">
                        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="class_code" class="form-label">Class Code</label>
                        <input type="text" class="form-control @error('class_code') is-invalid @enderror"
                               id="class_code" name="class_code" value="{{ old('class_code', $user->class_code) }}">
                        @error('class_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    @auth
                        @if(Auth::user()->is_admin)
                            <div class="mb-3">
                                <label for="is_admin" class="form-label">Role</label>
                                <select name="is_admin" id="is_admin" class="form-select" required>
                                    <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>Student</option>
                                    <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                        @endif
                    @endauth

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Update User</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Dark Mode Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const darkMode = localStorage.getItem('theme') === 'dark';
        if (darkMode) document.body.classList.add('dark-mode');

        const toggleBtn = document.getElementById('themeToggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                const theme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
                localStorage.setItem('theme', theme);
            });
        }
    });
</script>
</body>
</html>
