<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>FestiShop</title>
        <link rel="icon" type="image/png" href="{{ asset('favvvicon.jpg') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('assets/frontend.css') }}">
        @stack('styles')
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">

                <div class="logo">
                    <a href="{{ route('homepage') }}">
                        <img src="{{ asset('images/logo-site/logo.png') }}" alt="FestiShop Logo">
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}" aria-current="page" href="{{ route('homepage') }}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cart') ? 'active' : '' }}" href="{{ route('cart') }}">Panier</a>
                        </li>
                        @if(auth()->check())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('orders') ? 'active' : '' }}" href="{{ route('orders') }}">Mes Commandes</a>
                            </li>
                        @endif
                    </ul>
                    @guest
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">S'inscrire</a>
                            </li>
                        </ul>
                    @else
                        {{-- Photo + Nom cliquables --}}
                        <div class="dropdown">
                            @php
                                $user_color_class = '';
                                switch (auth()->user()->role) {
                                    case 'customer':
                                        $user_color_class = 'text-primary';
                                        break;
                                    case 'manutentionnaire':
                                        $user_color_class = 'text-success';
                                        break;
                                    case 'admin':
                                        $user_color_class = 'text-danger';
                                        break;
                                }
                            @endphp
                            <button class="d-flex align-items-center gap-2 text-decoration-none text-dark p-2 rounded border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('images/profile-picture/blank-profile.webp') }}" alt="User Image" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                <span class="fw-medium {{ $user_color_class }}">{{ auth()->user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                                @if(auth()->user()->role == 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.products') }}">Tableau de bord</a></li>
                                @endif
                                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'manutentionnaire')
                                    <li><a class="dropdown-item" href="{{ route('admin.orders') }}">Gérer les commandes</a></li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </nav>

            <div class="py-3">
                @yield('content')
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        @stack('scripts')
    </body>

</html>
