{{-- Page d'accueil : catalogue produits avec filtres par nom, catégorie, stock et tri par prix --}}
@extends('layouts.frontend')

@section('content')
    <div class="my-4">
        {{-- Barre de recherche et filtres --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('homepage') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="text" class="form-control" placeholder="Recherche par nom de produit..." name="name" value="{{ request('name') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="category_id">
                                <option value="">Toutes les catégories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" name="sort_by">
                                <option value="">Trier par...</option>
                                <option value="asc" {{ request('sort_by') == 'asc' ? 'selected' : '' }}>Prix croissant</option>
                                <option value="desc" {{ request('sort_by') == 'desc' ? 'selected' : '' }}>Prix décroissant</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="inStockOnly" name="in_stock" value="yes" {{ request('in_stock') == 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inStockOnly">
                                    En stock
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">Filtrer</button>
                            @if (request('name') || request('sort_by') || request('in_stock') == 'yes')
                                <a href="{{ route('homepage') }}" class="btn btn-outline-secondary flex-fill">Réinitialiser</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Grille de produits --}}
        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                <div class="pb-4">
                                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                </div>
                            </a>
                            <span class="badge bg-secondary mb-2 align-self-start">{{ $product->category->name }}</span>
                            <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-dark">
                                <h5 class="card-title">{{ $product->name }}</h5>
                            </a>
                            <p class="card-text">{{ Str::limit($product->description, 150, '...') }}</p>
                            <p class="fw-bold fs-5 text-primary mb-2">{{ $product->price }} CHF</p>
                            @if ($product->stock > 0)
                                <p class="text-success mb-3"><i class="fa-solid fa-check me-1"></i>{{ 'En stock' }}</p>
                            @else
                                <p class="text-danger mb-3"><i class="fa-solid fa-xmark me-1"></i>{{ 'Rupture de stock' }}</p>
                            @endif
                            <button class="btn {{ $product->stock > 0 ? 'btn-primary' : 'btn-secondary' }} mt-auto add-to-cart-btn" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" data-product-image="{{ $product->image }}" data-product-category="{{ $product->category->name }}" {{ $product->stock > 0 ? '' : 'disabled' }}>
                                <i class="fa-solid fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <p class="mb-0">Aucun produit trouvé</p>
                    </div>
                </div>
            @endforelse
            <div class="col-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* BARRE DE RECHERCHE */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07) !important;
        }

        .card-body {
            padding: 1.25rem;
        }

        .input-group-text {
            background-color: #fff;
            border-right: none;
            color: #9c27b0;
        }

        .input-group .form-control {
            border-left: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9c27b0;
            box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.15);
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

        /* CARTES PRODUITS */
        .card.h-100 {
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 12px;
            overflow: hidden;
        }

        .card.h-100:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.11) !important;
        }

        .card-img-top {
            width: 100%;
            aspect-ratio: 1/1;
            object-fit: cover;
            border-radius: 8px;
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
            margin-bottom: 0.4rem;
        }

        .card-text {
            font-size: 0.875rem;
            color: #666;
            line-height: 1.5;
        }

        .text-primary {
            color: #9c27b0 !important;
        }

        .text-success {
            font-size: 0.85rem;
        }

        .text-danger {
            font-size: 0.85rem;
        }

        /* BOUTON PANIER */
        .add-to-cart-btn {
            border-radius: 8px;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        /* PAGINATION */
        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0 2px;
            color: #9c27b0;
            border: 1px solid #e9ecef;
        }

        .pagination .page-item.active .page-link {
            background-color: #9c27b0;
            border-color: #9c27b0;
            color: #fff;
        }

        .pagination .page-link:hover {
            background-color: #f5eeff;
            color: #9c27b0;
        }

        /* ALERTE VIDE */
        .alert-info {
            background-color: #f5eeff;
            border: none;
            color: #9c27b0;
            border-radius: 10px;
            padding: 1.5rem;
        }
    </style>
@endpush