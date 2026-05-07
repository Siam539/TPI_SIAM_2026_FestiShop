{{-- Page du panier : liste des articles, quantités, total et bouton de commande --}}
@push('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07) !important;
    }

    .card-body {
        padding: 1.25rem;
    }

    .badge.bg-secondary {
        background-color: #f0e6ff !important;
        color: #7b1fa2;
        font-weight: 500;
        font-size: 0.75rem;
        border-radius: 20px;
        padding: 4px 10px;
    }

    .card-title {
        font-size: 1rem;
        font-weight: 600;
    }

    .text-primary {
        color: #9c27b0 !important;
    }

    .text-success {
        color: #2e7d32 !important;
    }

    .btn-primary {
        background-color: #9c27b0;
        border-color: #9c27b0;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #7b1fa2;
        border-color: #7b1fa2;
    }

    .btn-outline-secondary {
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-outline-danger {
        border-radius: 8px;
    }

    .form-control:focus {
        border-color: #9c27b0;
        box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.15);
    }

    .input-group .btn-outline-secondary {
        border-color: #dee2e6;
    }

    .alert-warning {
        border-radius: 10px;
        border: none;
        background-color: #fff8e1;
    }

    h1 {
        font-weight: 700;
        font-size: 1.8rem;
    }
</style>
@endpush
@extends('layouts.frontend')

@section('content')
    <div class="my-4">

        @include('partials.session-alert')

        <h1 class="mb-4">Mon Panier</h1>

        <div class="row">
            {{-- Colonne de gauche : articles --}}
            <div class="col-lg-8 mb-4">
                {{-- Article 1 --}}
                @if (auth()->check())
                    @forelse ($cartItems as $item)
                        <div class="card shadow-sm mb-3">
                            <div class="row g-0">
                                {{-- Image --}}
                                <div class="col-md-3">
                                    <img src="{{ asset($item->product->image) }}" class="img-fluid rounded-start p-3" alt="{{ $item->product->name }}" style="max-height: 180px; object-fit: contain;">
                                </div>
                                {{-- Infos produit --}}
                                <div class="col-md-9">
                                    <div class="card-body d-flex flex-column h-100">

                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <span class="badge bg-secondary mb-2">{{ $item->product->category?->name }}</span>
                                                <h5 class="card-title mb-1">{{ $item->product->name }}</h5>
                                            </div>
                                            {{-- Bouton supprimer --}}
                                            <button class="btn btn-outline-danger btn-sm delete-btn" data-id="{{ $item->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>

                                        {{-- Prix unitaire + Quantité + Prix total --}}
                                        <div class="row align-items-center mt-3">
                                            <div class="col-4">
                                                <small class="text-muted d-block">Prix unitaire</small>
                                                <strong>{{ $item->product->price }} CHF</strong>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted d-block mb-1">Quantité</small>
                                                <div class="input-group input-group-sm" style="max-width: 120px;">
                                                    <button class="btn btn-outline-secondary update-quantity-btn" type="button" data-id="{{ $item->id }}" data-action="decrement">-</button>
                                                    <input type="text" class="form-control text-center quantity-input" value="{{ $item->quantity }}" min="1" readonly>
                                                    <button class="btn btn-outline-secondary update-quantity-btn" type="button" data-id="{{ $item->id }}" data-action="increment">+</button>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <small class="text-muted d-block">Total</small>
                                                <strong class="text-primary fs-5">{{ $item->product->price * $item->quantity }} CHF</strong>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning text-center"><i class="fa-solid fa-cart-shopping me-2"></i>Votre panier est vide.</div>
                    @endforelse
                @else
                    <div id="localCart"></div>
                @endif

                {{-- Bouton continuer les achats --}}
                <a href="{{ route('homepage') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Continuer mes achats
                </a>

            </div>

            {{-- Colonne de droite : résumé --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Résumé de la commande</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Sous-total (<span id="summary-count">{{ $cartCount }}</span>)</span>
                            <span id="summary-subtotal">{{ $cartTotal }} CHF</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Livraison</span>
                            <span class="text-success">Gratuite</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <strong class="fs-5">Total</strong>
                            <strong class="fs-5 text-primary" id="summary-total">{{ $cartTotal }} CHF</strong>
                        </div>

                        <a href="{{ route('checkout') }}" class="btn btn-primary w-100 btn-lg">
                            <i class="fa-solid fa-lock me-2"></i>Passer la commande
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let assetBaseUrl = '{{ asset('/') }}';
        $(document).ready(function() {
            if(!isUserLoggedIn) {
                renderLocalCart();
            }
        });

        function renderLocalCart() {
            if (isUserLoggedIn) {
                return;
            }

            let cart = JSON.parse(localStorage.getItem('guest_cart')) || [];

            let localCartDiv = $('#localCart');
            localCartDiv.empty();

            if (cart.length === 0) {
                localCartDiv.html('<div class="alert alert-warning text-center"><i class="fa-solid fa-cart-shopping me-2"></i>Votre panier est vide.</div>');
                updateSummary(0, 0);
                return;
            }

            let totalCount = 0;
            let totalPrice = 0;

            cart.forEach(item => {
                totalCount += item.quantity;
                totalPrice += item.product_price * item.quantity;

                let itemHtml = `
                    <div class="card shadow-sm mb-3">
                        <div class="row g-0">
                            <div class="col-md-3 text-center text-md-start">
                                <img src="${assetBaseUrl + item.product_image}" class="img-fluid rounded-start p-3" alt="${item.product_name}" style="max-height: 180px; object-fit: contain;">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body d-flex flex-column h-100">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="badge bg-secondary mb-2">${item.product_category}</span>
                                            <h5 class="card-title mb-1">${item.product_name}</h5>
                                        </div>
                                        <button class="btn btn-outline-danger btn-sm local-delete-btn" data-id="${item.product_id}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="row align-items-center mt-3">
                                        <div class="col-4">
                                            <small class="text-muted d-block">Prix unitaire</small>
                                            <strong>${item.product_price} CHF</strong>
                                        </div>
                                        <div class="col-4">
                                            <small class="text-muted d-block mb-1">Quantité</small>
                                            <div class="input-group input-group-sm" style="max-width: 120px;">
                                                <button class="btn btn-outline-secondary local-update-quantity-btn" type="button" data-id="${item.product_id}" data-action="decrement">-</button>
                                                <input type="text" class="form-control text-center quantity-input" value="${item.quantity}" min="1" readonly>
                                                <button class="btn btn-outline-secondary local-update-quantity-btn" type="button" data-id="${item.product_id}" data-action="increment">+</button>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <small class="text-muted d-block">Total</small>
                                            <strong class="text-primary fs-5">${(item.product_price * item.quantity).toFixed(2)} CHF</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                localCartDiv.append(itemHtml);
            });

            updateSummary(totalCount, totalPrice);
        }

        function updateSummary(count, total) {
            $('#summary-count').text(count);
            $('#summary-subtotal').text(total.toFixed(2) + ' CHF');
            $('#summary-total').text(total.toFixed(2) + ' CHF');
        }

        $(document).on('click', '.local-update-quantity-btn', function() {
            const id = $(this).data('id');
            const action = $(this).data('action');
            let cart = JSON.parse(localStorage.getItem('guest_cart')) || [];
            let item = cart.find(i => i.product_id == id);

            if (item) {
                if (action === 'increment') {
                    item.quantity++;
                } else if (action === 'decrement' && item.quantity > 1) {
                    item.quantity--;
                }
                localStorage.setItem('guest_cart', JSON.stringify(cart));
                renderLocalCart();
            }
        });

        $(document).on('click', '.local-delete-btn', function() {
            if (confirm("Voulez-vous vraiment supprimer ce produit du panier?")) {
                const id = $(this).data('id');
                let cart = JSON.parse(localStorage.getItem('guest_cart')) || [];
                cart = cart.filter(i => i.product_id != id);
                localStorage.setItem('guest_cart', JSON.stringify(cart));
                renderLocalCart();
            }
        });

        $('.update-quantity-btn').click(function() {
            const id = $(this).data('id');
            const action = $(this).data('action');
            let quantityElement = $(this).parent().find('.quantity-input');
            let quantity = parseInt(quantityElement.val());

            if (action == 'increment') {
                quantity = quantity + 1;
                quantityElement.val(quantity);
            } else if (action == 'decrement') {
                if (quantity > 1) {
                    quantity = quantity - 1;
                    quantityElement.val(quantity);
                }
            }
            let url = "{{ route('product.cart-update-quantity') }}";
            window.location.href = url + '?quantity=' + quantity + '&id=' + id;
        });

        $('.delete-btn').click(function() {
            if (confirm("Voulez-vous vraiment supprimer ce produit du panier?")) {
                const id = $(this).data('id');
                let url = "{{ route('product.cart-delete', ':id') }}".replace(':id', id);
                window.location.href = url;
            }
        });
    </script>
@endpush