@extends('layouts.frontend')

@section('content')
    <div class="my-4">
        {{-- Barre de recherche et filtres --}}
        <div class="row mb-4 g-2">
            <div class="col-md-5">
                <input type="text" class="form-control" placeholder="Rechercher par nom ou catégorie...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Trier par...</option>
                    <option value="asc">Prix croissant</option>
                    <option value="desc">Prix décroissant</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="inStockOnly">
                    <label class="form-check-label" for="inStockOnly">
                        Uniquement en stock
                    </label>
                </div>
            </div>
        </div>

        {{-- Grille de produits --}}
        <div class="row">
            {{-- Produit 1 : Banderoles --}}
            <div class="col-md-4 mb-4">
                <a href="" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('images/products/banderoles.jpg') }}" class="card-img-top" alt="Riethmüller Banderoles">
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-secondary mb-2 align-self-start">Anniversaire</span>
                            <h5 class="card-title">Riethmüller Banderoles</h5>
                            <p class="card-text">Banderoles dorées métallisées, parfaites pour vos fêtes d'anniversaire.</p>
                            <p class="fw-bold fs-5 text-primary mb-2">5.90 CHF</p>
                            <p class="text-success mb-3"><i class="fa-solid fa-check me-1"></i>En stock (8 pièces)</p>
                            <button class="btn btn-primary mt-auto">
                                <i class="fa-solid fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Produit 2 : Set Happy Birthday --}}
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/products/happy-birthday.jpg') }}" class="card-img-top" alt="I Am Creative Set">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-secondary mb-2 align-self-start">Anniversaire</span>
                        <h5 class="card-title">I Am Creative Set</h5>
                        <p class="card-text">Kit décoration complet Happy Birthday avec pompons, guirlandes et banderole.</p>
                        <p class="fw-bold fs-5 text-primary mb-2">23.90 CHF</p>
                        <p class="text-success mb-3"><i class="fa-solid fa-check me-1"></i>En stock (10+ pièces)</p>
                        <button class="btn btn-primary mt-auto">
                            <i class="fa-solid fa-cart-plus me-2"></i>Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>

            {{-- Produit 3 : Écharpe Birthday Girl --}}
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/products/birthday-girl.jpg') }}" class="card-img-top" alt="MU Style Écharpe Birthday Girl">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-secondary mb-2 align-self-start">Anniversaire</span>
                        <h5 class="card-title">MU Style Écharpe "Birthday Girl" + couronne</h5>
                        <p class="card-text">Écharpe pailletée et couronne strassée pour la reine de la fête.</p>
                        <p class="fw-bold fs-5 text-primary mb-2">14.90 CHF</p>
                        <p class="text-success mb-3"><i class="fa-solid fa-check me-1"></i>En stock (10+ pièces)</p>
                        <button class="btn btn-primary mt-auto">
                            <i class="fa-solid fa-cart-plus me-2"></i>Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
