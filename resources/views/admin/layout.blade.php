<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8" />
    <title>M&H - Панель керування</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            font-size: 1.1rem;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: #fff !important;
            background-color: rgba(255,255,255,0.1);
            border-radius: 4px;
        }
        .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            border-radius: 4px;
        }
        .container {
            padding: 10px;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,.05);
            border-radius: 10px;
        }
        .btn {
            border-radius: 5px;
            padding: 8px 20px;
        }
        @media (max-width: 768px) {
            .navbar-nav {
                flex-direction: column;
                width: 100%;
            }
            .nav-item {
                width: 100%;
                text-align: center;
            }
            .navbar-collapse {
                background-color: #343a40;
                padding: 10px;
                border-radius: 8px;
            }
            .ms-auto {
                margin-top: 10px;
                border-top: 1px solid rgba(255,255,255,0.1);
                padding-top: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.projects.index') }}">M&H Панель</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}"
                           href="{{ route('admin.projects.index') }}">Проєкти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}"
                           href="{{ route('admin.blog.index') }}">Блог</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="nav-link" href="#" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Вийти
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
