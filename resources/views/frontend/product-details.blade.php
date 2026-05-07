{{-- Page de détail d'un produit : image, description, prix, stock et ajout au panier --}}
@push('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07) !important;
    }

    .badge.bg-secondary {
        background-color: #f0e6ff !important;
        color: #7b1fa2;
        font-weight: 500;
        font-size: 0.75rem;
        border-radius: 20px;
        padding: 4px 10px;
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

    .form-control:focus {
        border-color: #9c27b0;
        box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.15);
    }

    .breadcrumb-item a {
        color: #9c27b0;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: #7b1fa2;
        text-decoration: underline;
    }
</style>
@endpush
@extends('layouts.frontend')

@section('content')
    <div class="my-4">

        {{-- Fil d'Ariane --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Accueil</a></li>
                <li class="breadcrumb-item">{{ $product->category?->name }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        {{-- Détail du produit --}}
        <div class="row">

            {{-- Image à gauche --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset($product->image) }}" class="card-img-top p-4" alt="{{ $product->name }}" style="max-height: 500px; object-fit: contain;">
                </div>
            </div>

            {{-- Infos à droite --}}
            <div class="col-md-6 mb-4">

                <span class="badge bg-secondary mb-3">{{ $product->category?->name }}</span>

                <h1 class="mb-2">{{ $product->name }}</h1>

                <h2 class="text-primary fw-bold mb-4">{{ $product->price }} CHF</h2>

                @if ($product->stock > 0)
                    <p class="text-success mb-3"><i class="fa-solid fa-check me-1"></i>{{ 'En stock' }}</p>
                @else
                    <p class="text-danger mb-3"><i class="fa-solid fa-xmark me-1"></i>{{ 'Rupture de stock' }}</p>
                @endif

                {{-- Quantité + Bouton --}}
                <div class="row g-2 mt-4">
                    <div class="col-4 col-md-3">
                        <label for="quantity" class="form-label">Quantité</label>
                        <input type="number" class="form-control" id="quantity" value="1" min="1" max="8">
                    </div>
                    <div class="col-8 col-md-9 d-flex align-items-end">
                        <button class="btn {{ $product->stock > 0 ? 'btn-primary' : 'btn-secondary' }} mt-auto add-to-cart-btn" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ $product->price }}" data-product-image="{{ $product->image }}" data-product-category="{{ $product->category->name }}" {{ $product->stock > 0 ? '' : 'disabled' }}>
                            <i class="fa-solid fa-cart-plus me-2"></i>Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-4">Description</h5>
                <p class="card-text">
                    {{ $product->description }}
                </p>
            </div>
        </div>

    </div>
@endsection
