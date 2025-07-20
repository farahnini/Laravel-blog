<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Blog') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif;
            background: #fff;
            color: #222;
        }
        @media (prefers-color-scheme: dark) {
            body, .bg-light {
                background-color: #181a1b !important;
                color: #f1f1f1 !important;
            }
            .navbar, .card, .modal-content, .dropdown-menu {
                background-color: #23272b !important;
                color: #f1f1f1 !important;
            }
            .btn-primary {
                background-color: #2563eb;
                border-color: #2563eb;
            }
            .btn-primary:hover {
                background-color: #1d4ed8;
                border-color: #1d4ed8;
            }
        }
        body.dark-mode, .dark-mode .bg-light {
            background-color: #181a1b !important;
            color: #f1f1f1 !important;
        }
        .dark-mode .navbar, .dark-mode .card, .dark-mode .modal-content, .dark-mode .dropdown-menu {
            background-color: #23272b !important;
            color: #f1f1f1 !important;
        }
        .dark-mode .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        .dark-mode .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }
        .navbar {
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            box-shadow: none;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
            color: #222 !important;
        }
        .navbar-nav .nav-link {
            color: #444 !important;
            font-weight: 500;
            margin-right: 1rem;
        }
        .navbar-nav .nav-link.active, .navbar-nav .nav-link:focus, .navbar-nav .nav-link:hover {
            color: #007aff !important;
        }
        .dropdown-menu {
            border-radius: 0.5rem;
            border: 1px solid #e5e5e5;
            box-shadow: 0 2px 8px rgba(44,62,80,0.07);
        }
        .main-content {
            max-width: 900px;
            margin: 2rem auto 0 auto;
            padding: 0 1rem;
        }
        .footer {
            background: #fff;
            color: #888;
            padding: 2rem 0 1rem 0;
            text-align: center;
            margin-top: 3rem;
            border-top: 1px solid #e5e5e5;
            font-size: 1rem;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif;
            color: #222;
            font-weight: 700;
        }
        .btn-primary {
            background: #007aff;
            border-color: #007aff;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: #0056b3;
            border-color: #0056b3;
        }
        .btn-info {
            background: #f5f5f5;
            color: #222;
            border: 1px solid #e5e5e5;
        }
        .btn-info:hover, .btn-info:focus {
            background: #e5e5e5;
            color: #222;
        }
        .btn-danger {
            background: #222;
            border-color: #222;
            color: #fff;
        }
        .btn-danger:hover, .btn-danger:focus {
            background: #444;
            border-color: #444;
        }
        .blog-input, .form-control, .form-select {
            background: #fff;
            color: #222;
            border: 1px solid #e5e5e5;
            border-radius: 0.5rem;
            font-family: inherit;
        }
        .blog-input:focus, .form-control:focus, .form-select:focus {
            border-color: #007aff;
            background: #fff;
            color: #222;
        }
        .alert {
            border-radius: 0.5rem;
        }
        .section-box {
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 1rem;
            box-shadow: none;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .badge {
            background: #222;
            color: #fff;
            font-size: 0.95em;
            font-weight: 500;
            border-radius: 0.4em;
        }
        .table thead {
            background: #f5f5f5;
        }
        .form-check-input:checked {
            background-color: #007aff;
            border-color: #007aff;
        }
    </style>
    <script>
        // Dark mode toggle logic
        function setDarkMode(enabled) {
            if (enabled) {
                document.body.classList.add('dark-mode');
                localStorage.setItem('darkMode', '1');
                document.getElementById('darkModeIcon').classList.remove('bi-moon');
                document.getElementById('darkModeIcon').classList.add('bi-sun');
            } else {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', '0');
                document.getElementById('darkModeIcon').classList.remove('bi-sun');
                document.getElementById('darkModeIcon').classList.add('bi-moon');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const stored = localStorage.getItem('darkMode');
            if (stored === '1' || (stored === null && prefersDark)) {
                setDarkMode(true);
            } else {
                setDarkMode(false);
            }
            document.getElementById('darkModeToggle').addEventListener('click', function() {
                setDarkMode(!document.body.classList.contains('dark-mode'));
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid" style="max-width: 1100px;">
        <a class="navbar-brand" href="{{ route('articles.index') }}">Laravel Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}">Articles</a></li>
                @can('view-users')
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                @endcan
                @can('view-roles')
                    <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                @endcan
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><span class="dropdown-item-text">{{ Auth::user()->email }}</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
                @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endguest
                <button id="darkModeToggle" class="btn btn-outline-secondary ms-2" type="button" aria-label="Toggle dark mode">
                    <span id="darkModeIcon" class="bi bi-moon"></span>
                </button>
            </ul>
        </div>
    </div>
</nav>
<div class="main-content">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</div>
<footer class="footer">
    <div class="container-fluid" style="max-width: 1100px;">
        <span>&copy; {{ date('Y') }} Laravel Blog</span>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 