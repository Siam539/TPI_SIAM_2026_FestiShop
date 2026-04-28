@extends('layouts.frontend')

@section('content')
    <div class="my-4">

        <h1 class="mb-4">Mon Panier</h1>

        <div class="row">
            {{-- Colonne de gauche : articles --}}
            <div class="col-lg-8 mb-4">
                {{-- Article 1 --}}
                <div class="card shadow-sm mb-3">
                    <div class="row g-0">
                        {{-- Image --}}
                        <div class="col-md-3">
                            <img src="{{ asset('images/products/banderoles.jpg') }}" class="img-fluid rounded-start p-3" alt="Riethmüller Banderoles" style="max-height: 180px; object-fit: contain;">
                        </div>
                        {{-- Infos produit --}}
                        <div class="col-md-9">
                            <div class="card-body d-flex flex-column h-100">

                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="badge bg-secondary mb-2">Anniversaire</span>
                                        <h5 class="card-title mb-1">Riethmüller Banderoles</h5>
                                        <p class="text-muted small mb-2">Référence : #001</p>
                                    </div>
                                    {{-- Bouton supprimer --}}
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>

                                {{-- Prix unitaire + Quantité + Prix total --}}
                                <div class="row align-items-center mt-3">
                                    <div class="col-4">
                                        <small class="text-muted d-block">Prix unitaire</small>
                                        <strong>5.90 CHF</strong>
                                    </div>
                                    <div class="col-4">
                                        <small class="text-muted d-block mb-1">Quantité</small>
                                        <div class="input-group input-group-sm" style="max-width: 120px;">
                                            <button class="btn btn-outline-secondary" type="button">-</button>
                                            <input type="number" class="form-control text-center" value="2" min="1">
                                            <button class="btn btn-outline-secondary" type="button">+</button>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <small class="text-muted d-block">Total</small>
                                        <strong class="text-primary fs-5">11.80 CHF</strong>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

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
                            <span>Sous-total (1 article)</span>
                            <span>11.80 CHF</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Livraison</span>
                            <span class="text-success">Gratuite</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <strong class="fs-5">Total</strong>
                            <strong class="fs-5 text-primary">11.80 CHF</strong>
                        </div>

                        <button class="btn btn-primary w-100 btn-lg">
                            <i class="fa-solid fa-lock me-2"></i>Passer la commande
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
