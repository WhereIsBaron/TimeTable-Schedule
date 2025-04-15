<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Register</h2>
        <button id="themeToggle" class="btn btn-sm btn-outline-light">🌙 Toggle Dark Mode</button>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control @error('full_name') is-invalid @enderror">
                        @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Student ID</label>
                        <input type="text" name="student_id" value="{{ old('student_id') }}" class="form-control @error('student_id') is-invalid @enderror">
                        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Class Code</label>
                        <input type="text" name="class_code" value="{{ old('class_code') }}" class="form-control @error('class_code') is-invalid @enderror">
                        @error('class_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">👁️</button>
                        </div>
                        @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Register</button>
                    <a href="{{ url('/login') }}" class="btn btn-link">Already have an account?</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const pass = document.getElementById('password');
        pass.type = pass.type === 'password' ? 'text' : 'password';
    }
    document.addEventListener("DOMContentLoaded", function () {
        const darkMode = localStorage.getItem('theme') === 'dark';
        if (darkMode) document.body.classList.add('dark-mode');
        document.getElementById('themeToggle').addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
        });
    });
</script>
</body>
</html>
