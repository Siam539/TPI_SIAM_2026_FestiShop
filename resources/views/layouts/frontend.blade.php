{{-- Layout principal du site client : navbar, panier, footer et scripts Bootstrap --}}
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
     
         <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

            * {
                font-family: 'Poppins', sans-serif;
            }

            body {
                background-color: #f8f9fa;
            }

            /* NAVBAR */
            .navbar {
                background-color: #ffffff !important;
                border-bottom: 1px solid #e9ecef;
                padding: 0.75rem 1rem;
            }

            .navbar-nav .nav-link {
                color: #333 !important;
                font-weight: 500;
                padding: 0.4rem 0.8rem;
                border-radius: 6px;
                transition: background 0.2s, color 0.2s;
            }

            .navbar-nav .nav-link:hover,
            .navbar-nav .nav-link.active {
                background-color: #f5eeff;
                color: #9c27b0 !important;
            }

            .logo img {
                height: 55px;
            }

            .ms-auto .nav-link {
                border-radius: 20px;
                padding: 0.4rem 1.1rem !important;
                font-weight: 500;
            }

            .ms-auto .nav-link:first-child {
                border: 1.5px solid #ccc;
                color: #333 !important;
            }

            .ms-auto .nav-link:last-child {
                background-color: #9c27b0;
                color: #fff !important;
            }

            .ms-auto .nav-link:last-child:hover {
                background-color: #7b1fa2;
            }

            /* DROPDOWN USER */
            .dropdown > button {
                background: none !important;
                border: 1.5px solid #ddd !important;
                border-radius: 20px !important;
                padding: 5px 14px 5px 8px !important;
                color: #333 !important;
            }

            .dropdown-menu {
                border-radius: 10px;
                border: 1px solid #e9ecef;
                box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            }

            .dropdown-item:hover {
                background-color: #f5eeff;
                color: #9c27b0;
            }

            .navbar {
                --bs-navbar-active-color: #9c27b0;
            }

            .auth-user {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .auth-user img {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                object-fit: cover;
            }

            /* COULEURS ROLES — protégées contre les surcharges des pages */
            .dropdown .fw-medium.text-primary  { color: #0d6efd !important; }
            .dropdown .fw-medium.text-success  { color: #198754 !important; }
            .dropdown .fw-medium.text-danger   { color: #dc3545 !important; }
        </style>
       

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
                        @if (auth()->check())
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
                                @if (auth()->user()->role == 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Tableau de bord</a></li>
                                @endif
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manutentionnaire')
                                    <li><a class="dropdown-item" href="{{ route('admin.orders.index') }}">Gérer les commandes</a></li>
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

        <script>
            const isUserLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

            $(document).on('click', '.add-to-cart-btn', function() {
                const productId = $(this).data('product-id');
                const productName = $(this).data('product-name');
                const productPrice = $(this).data('product-price');
                const productImage = $(this).data('product-image');
                const productCategory = $(this).data('product-category');

                if (isUserLoggedIn) {
                    window.location.href = "{{ route('product.add-to-cart', ':id') }}".replace(':id', productId);
                } else {
                    let cart = JSON.parse(localStorage.getItem('guest_cart')) || [];
                    let existingItem = cart.find(item => item.product_id === productId);

                    if (existingItem) {
                        existingItem.quantity += 1;
                    } else {
                        cart.push({
                            product_id: productId,
                            quantity: 1,
                            product_name: productName,
                            product_price: productPrice,
                            product_image: productImage,
                            product_category: productCategory,
                        });
                    }

                    localStorage.setItem('guest_cart', JSON.stringify(cart));

                    window.location.href = "{{ route('cart') }}";
                }

            });

            if (isUserLoggedIn) {
                let localCart = localStorage.getItem('guest_cart');

                if (localCart) {
                    let cartItems = JSON.parse(localCart);

                    if (cartItems.length > 0) {
                        $.ajax({
                            url: "{{ route('product.cart-sync') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                cart_items: cartItems
                            },
                            success: function(response) {
                                if (response.status) {
                                    localStorage.removeItem('guest_cart');
                                    console.log('Panier synchronisé avec succès!');
                                } else {
                                    console.log('Erreur lors de la synchronisation du panier:', response);
                                }
                            },
                            error: function(err) {
                                console.log('Erreur lors de la synchronisation du panier:', err);
                            }
                        });
                    }
                }
            }
        </script>

        @stack('scripts')
    </body>

</html>
