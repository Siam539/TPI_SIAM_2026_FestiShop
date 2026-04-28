@extends('layouts.frontend')

@section('content')
    <div class="my-4">

        {{-- Fil d'Ariane --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Accueil</a></li>
                <li class="breadcrumb-item">Anniversaire</li>
                <li class="breadcrumb-item active" aria-current="page">Riethmüller Banderoles</li>
            </ol>
        </nav>

        {{-- Détail du produit --}}
        <div class="row">

            {{-- Image à gauche --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('images/products/banderoles.jpg') }}" class="card-img-top p-4" alt="Riethmüller Banderoles" style="max-height: 500px; object-fit: contain;">
                </div>
            </div>

            {{-- Infos à droite --}}
            <div class="col-md-6 mb-4">

                <span class="badge bg-secondary mb-3">Anniversaire</span>

                <h1 class="mb-2">Riethmüller Banderoles</h1>
                <p class="text-muted mb-3">Référence : #001</p>

                <h2 class="text-primary fw-bold mb-4">5.90 CHF</h2>

                <p class="text-success mb-4">
                    <i class="fa-solid fa-check me-1"></i>
                    En stock (8 pièces disponibles)
                </p>

                <h5 class="mt-4">Description</h5>
                <p class="card-text">
                    Banderoles dorées métallisées, parfaites pour vos fêtes d'anniversaire.
                    Effet holographique brillant qui attire tous les regards.
                    Livré en rouleau de 1 pièce.
                </p>

                {{-- Quantité + Bouton --}}
                <div class="row g-2 mt-4">
                    <div class="col-4 col-md-3">
                        <label for="quantity" class="form-label">Quantité</label>
                        <input type="number" class="form-control" id="quantity" value="1" min="1" max="8">
                    </div>
                    <div class="col-8 col-md-9 d-flex align-items-end">
                        <button class="btn btn-primary btn-lg w-100">
                            <i class="fa-solid fa-cart-plus me-2"></i>Ajouter au panier
                        </button>
                    </div>
                </div>

                <a href="{{ route('homepage') }}" class="btn btn-outline-secondary mt-4">
                    <i class="fa-solid fa-arrow-left me-2"></i>Retour aux produits
                </a>
            </div>
        </div>

    </div>
@endsection
