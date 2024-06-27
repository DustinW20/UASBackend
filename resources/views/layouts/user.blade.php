<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Es Teh Solo - Tempat Minum Es Buat Kaum Gen Z</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Welcome To Es Teh</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteNamed('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">About</a>
                    </li>
                    @auth
                        <a class="nav-link {{ Route::currentRouteNamed('about') ? 'active' : '' }}"
                            href="{{ route('orders') }}">Orders</a>
                    @endauth

                    @auth
                        <a class="nav-link {{ Route::currentRouteNamed('profile') ? 'active' : '' }}"
                            href="{{ route('profile') }}">Profile</a>
                    @endauth
                </ul>
                @if (!auth()->check())
                    <a href="{{ route('login') }}" class="btn btn-outline-primary mx-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success mx-2">Register</a>
                @else
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger mx-2">logout</a>
                @endif
                <form class="d-flex" action="{{ route('cart') }}">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">{{ $totalCart }}</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header -->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Es Teh Solo</h1>
                <p class="lead fw-normal text-white-50 mb-0">Tempat Minum Es Buat Kaum Gen Z</p>
            </div>
        </div>
    </header>
    <!-- Section -->

    @yield('content')
    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Es Teh Solo 2024</p>
        </div>
    </footer>
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="js/scripts.js"></script>
</body>

</html>
