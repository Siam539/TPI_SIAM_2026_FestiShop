<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>FestiShop - Administration</title>
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

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.products') ? 'active' : '' }}" href="{{ route('admin.products') }}">
                                <i class="fa-solid fa-box me-1"></i>Produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                                <i class="fa-solid fa-users me-1"></i>Utilisateurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}">
                                <i class="fa-solid fa-clipboard-list me-1"></i>Commandes
                            </a>
                        </li>
                    </ul>

                    {{-- Profil admin avec nom EN ROUGE (critère A20) --}}
                    <div class="dropdown">
                        @php
                            $user_color_class = '';
                            switch (auth()->user()->role) {
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
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="py-3">
                @yield('content')
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>

</html>
