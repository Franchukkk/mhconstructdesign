<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8" />
    <title>M&H - Панель керування</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        
    <style>
        html {
            font-size: 0.5px;
        }
        @media screen and (min-width: 480px) {
            html {
                font-size: 0.6px;
            }
        }
        @media screen and (min-width: 1360px) {
            html {
                font-size: 0.8px;
            }
        }
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2rem 4rem rgba(0,0,0,.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 24rem;
        }
        .nav-link {
            font-size: 16rem;
            padding: 8rem 16rem !important;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: #fff !important;
            background-color: rgba(255,255,255,0.1);
            border-radius: 4rem;
        }
        .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            border-radius: 4rem;
        }
        .container {
            padding: 10rem;
        }
        .card {
            border: none;
            box-shadow: 0 0 15rem rgba(0,0,0,.05);
            border-radius: 10rem;
        }
        .btn {
            border-radius: 5rem;
            padding: 8rem 20rem;
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
                padding: 10rem;
                border-radius: 8rem;
            }
            .ms-auto {
                margin-top: 10rem;
                border-top: 1rem solid rgba(255,255,255,0.1);
                padding-top: 10rem;
            }
        }

        .ck-content {
            min-height: 400rem;
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
