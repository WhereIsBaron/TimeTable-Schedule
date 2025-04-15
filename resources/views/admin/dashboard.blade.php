<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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

        .dark-mode .form-control,
        .dark-mode .btn-primary,
        .dark-mode .btn-danger {
            background-color: #2c2c2c;
            color: #e0e0e0;
            border: 1px solid #444;
        }

        .dark-mode .btn-outline-light {
            color: #e0e0e0;
            border-color: #e0e0e0;
        }

        .dark-mode .btn-outline-light:hover {
            background-color: #e0e0e0;
            color: #121212;
        }

        .theme-toggle-btn {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
        }
    </style>
</head>
<body>
    <!-- Dark Mode Toggle Button -->
    <button id="themeToggle" class="btn btn-sm btn-outline-light theme-toggle-btn">🌙 Toggle Theme</button>

    <div class="container mt-5">
        <h1>Admin Dashboard</h1>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mt-3">
            <div class="card-body">
                <h5>Welcome, {{ auth()->user()->full_name }}</h5>
                <p>You are logged in as an <strong>Administrator</strong>.</p>

                <div class="mt-3 d-flex gap-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Dark Mode Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const darkMode = localStorage.getItem('theme') === 'dark';
            if (darkMode) document.body.classList.add('dark-mode');

            document.getElementById('themeToggle').addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                const newTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
                localStorage.setItem('theme', newTheme);
            });
        });
    </script>
</body>
</html>
