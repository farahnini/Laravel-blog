<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Blog') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f9fafc 0%, #e0f7fa 100%);
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            color: #222;
        }
        .navbar {
            background: #fff;
            box-shadow: 0 4px 24px rgba(44,62,80,0.10);
            border-bottom: 2px solid #ffe5b4;
            position: sticky; top: 0; z-index: 100;
        }
        .navbar-brand {
            font-family: 'Pacifico', cursive, system-ui;
            font-size: 2rem;
            color: #00bcd4 !important;
            letter-spacing: 2px;
        }
        .navbar-nav .nav-link {
            color: #444 !important;
            font-weight: 600;
            margin-right: 1rem;
            border-radius: 0.5rem;
            transition: background 0.2s, color 0.2s;
        }
        .navbar-nav .nav-link.active, .navbar-nav .nav-link:focus, .navbar-nav .nav-link:hover {
            color: #fff !important;
            background: #007aff;
        }
        .dropdown-menu {
            border-radius: 0.5rem;
            border: 1px solid #e5e5e5;
            box-shadow: 0 2px 8px rgba(44,62,80,0.07);
        }
        .main-content {
            max-width: 1000px;
            margin: 2rem auto 0 auto;
            padding: 0 1.5rem;
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
            font-weight: 900;
            background: linear-gradient(90deg, #00bcd4 40%, #ff7f50 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-primary, .btn-info {
            background: linear-gradient(90deg, #00bcd4 60%, #ff7f50 100%);
            border: none;
            color: #fff;
            font-weight: 700;
            border-radius: 0.7rem;
            box-shadow: 0 2px 8px rgba(0,188,212,0.07);
            transition: background 0.2s;
        }
        .btn-primary:hover, .btn-info:hover {
            background: linear-gradient(90deg, #ff7f50 40%, #00bcd4 100%);
        }
        .btn-danger {
            background: #ff7f50;
            border-color: #ff7f50;
            color: #fff;
            font-weight: 700;
            border-radius: 0.7rem;
        }
        .btn-danger:hover, .btn-danger:focus {
            background: #d84315;
            border-color: #d84315;
        }
        .form-control, .form-select {
            background: #fff;
            color: #222;
            border: 1.5px solid #e5e5e5;
            border-radius: 0.7rem;
            font-family: inherit;
            font-size: 1.08rem;
            padding: 0.7rem 1rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #00bcd4;
            background: #fff;
            color: #222;
            box-shadow: 0 0 0 0.2rem rgba(0,188,212,0.10);
        }
        .alert {
            border-radius: 0.7rem;
        }
        .section-box, .card, .bg-card {
            background: #fff;
            border: 2px solid #ffe5b4;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px rgba(0,188,212,0.10);
            padding: 2.5rem 2rem;
            margin-bottom: 2rem;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table {
            background: #fff;
            border-radius: 1rem;
            overflow: hidden;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f9fafc;
        }
        .badge {
            background: #007aff;
            color: #fff;
            font-size: 0.95em;
            font-weight: 700;
            border-radius: 0.4em;
        }
        .table thead {
            background: linear-gradient(90deg, #00bcd4 60%, #ffe5b4 100%);
            color: #fff;
            font-weight: 700;
        }
        .form-check-input:checked {
            background-color: #007aff;
            border-color: #007aff;
        }
        .avatar-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ffe5b4;
            color: #ff7f50;
            font-weight: 900;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(255,183,77,0.10);
        }
        .empty-illustration {
            max-width: 220px;
            margin-bottom: 1.5rem;
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
                {{-- <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}">Articles</a></li> --}}
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
{{-- <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li> --}}
@endguest
                {{-- <button id="darkModeToggle" class="btn btn-outline-secondary ms-2" type="button" aria-label="Toggle dark mode">
                    <span id="darkModeIcon" class="bi bi-moon"></span>
                </button> --}}
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