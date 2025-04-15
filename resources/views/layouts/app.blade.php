<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Classroom Scheduler')</title>
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
<body class="@if(session('theme') === 'dark') dark-mode @endif">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>@yield('title')</h2>
            <button id="themeToggle" class="btn btn-sm btn-outline-light">Toggle Dark Mode</button>
        </div>

        @yield('content')
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const darkMode = localStorage.getItem('theme') === 'dark';
            if (darkMode) document.body.classList.add('dark-mode');

            document.getElementById('themeToggle').addEventListener('click', function () {
                document.body.classList.toggle('dark-mode');
                const theme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
                localStorage.setItem('theme', theme);

                // Optionally send to backend to persist theme (using AJAX or form)
            });
        });
    </script>
</body>
</html>