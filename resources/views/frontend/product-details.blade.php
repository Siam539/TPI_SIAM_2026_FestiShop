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
