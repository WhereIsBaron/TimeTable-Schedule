<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }
        .dark-mode .card {
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
        <h2>Login</h2>
        <button id="themeToggle" class="btn btn-sm btn-outline-light">Toggle Dark Mode</button>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ url('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">👁️</button>
                        </div>
                        @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <a href="{{ url('/register') }}" class="btn btn-link w-100">Register</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
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
            const theme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
            localStorage.setItem('theme', theme);
        });

        setTimeout(() => {
            const successMessage = document.getElementById('success-message');
            if (successMessage) successMessage.style.display = 'none';
        }, 4000);
    });
</script>
</body>
</html>
