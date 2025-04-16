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

        .dark-mode .card,
        .dark-mode .navbar {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .form-control {
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
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1000;
            border: none;
            background-color: #f8f9fa;
            color: #000;
            padding: 6px 10px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        body.dark-mode .theme-toggle-btn {
            background-color: #2c2c2c;
            color: #e0e0e0;
            border: 1px solid #888;
        }

        .theme-toggle-btn:hover {
            opacity: 0.85;
        }
    </style>

    @yield('styles')
</head>
<body>
    
<!-- Global Dark Mode Toggle Button -->
<button id="themeToggle" class="theme-toggle-btn"></button>


    <div class="container mt-4">
        @yield('content')
    </div>

    @yield('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const body = document.body;
            const toggleBtn = document.getElementById('themeToggle');
            const iconSpan = document.getElementById('themeIcon');

            // Apply stored theme on load
            const isDark = localStorage.getItem('theme') === 'dark';
            if (isDark) {
                body.classList.add('dark-mode');
                iconSpan.textContent = '☀️';
            } else {
                iconSpan.textContent = '🌙';
            }

            // Toggle theme on click
            toggleBtn.addEventListener('click', function () {
                body.classList.toggle('dark-mode');
                const isNowDark = body.classList.contains('dark-mode');
                localStorage.setItem('theme', isNowDark ? 'dark' : 'light');
                iconSpan.textContent = isNowDark ? '☀️' : '🌙';
            });
        });
    </script>
</body>
</html>
