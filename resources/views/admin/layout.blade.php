<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
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
            font-size: 0.7px;
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
            box-shadow: 0 2rem 4rem rgba(0, 0, 0, .1);
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
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 4rem;
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 4rem;
        }

        .container {
            padding: 10rem;
        }

        .card {
            border: none;
            box-shadow: 0 0 15rem rgba(0, 0, 0, .05);
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
                border-top: 1rem solid rgba(255, 255, 255, 0.1);
                padding-top: 10rem;
            }
        }

        .ck-content {
            min-height: 400rem;
        }

        .custom-burger {
            width: 40px;
            height: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 6px;
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        @media screen and (min-width: 770px) {
            .custom-burger {
                display: none;
            }

        }

        .custom-burger .bar {
            width: 28px;
            height: 3px;
            background-color: #fff;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .pagination {
            display: flex;
            width: 100%;
            list-style: none;
            padding: 0;
            margin-top: 24rem;
            gap: 8rem;
        }

        .pagination .page-item {
            display: inline-block;

        }

        .pagination .page-link {
            display: block;
            padding: 8rem 16rem;
            font-size: 14rem;
            font-weight: 500;
            border: 1rem solid #ddd;
            border-radius: 6rem;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
            border-radius: 5px !important;
        }

        @media screen and (max-width: 600px){
            .pagination .page-link {
                color: #fff;
                background-color: #007bff;
            }
        }

        .pagination .page-link:hover {
            background-color: #e0e0e0;
            color: #000;
            border-color: #bbb;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f0f0f0;
            color: #aaa;
            cursor: not-allowed;
            border-color: #e0e0e0;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        @media (min-width: 576px) {
            .pagination .page-link {
                font-size: 16rem;
                padding: 10rem 20rem;
            }
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.projects.index') }}">M&H Panel</a>
            <button class="custom-burger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}"
                            href="{{ route('admin.projects.index') }}">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}"
                            href="{{ route('admin.blog.index') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.requests.*') ? 'active' : '' }}"
                            href="{{ route('admin.requests.index') }}">Requests</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        <a class="nav-link" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log out
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