@extends('layouts.frontend')

@section('content')
    <div class="my-4">

        <h1 class="mb-4">Mes Commandes</h1>

        {{-- Commande 1 : Livrée --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h6 class="mb-0">Commande <strong>#00124</strong></h6>
                    <small class="text-muted">Passée le 15 avril 2026</small>
                </div>
                <span class="badge bg-success fs-6">
                    <i class="fa-solid fa-check me-1"></i>Livrée
                </span>
            </div>
            <div class="card-body">

                {{-- Article --}}
                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <img src="{{ asset('images/products/banderoles.jpg') }}" class="img-fluid rounded" alt="Riethmüller Banderoles" style="max-height: 80px; object-fit: contain;">
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-1">Riethmüller Banderoles</h6>
                        <small class="text-muted">Anniversaire · Quantité : 2</small>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <strong>11.80 CHF</strong>
                    </div>
                </div>

                <hr>

                {{-- Total + Détails --}}
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Total</small>
                        <strong class="fs-5 text-primary">11.80 CHF</strong>
                    </div>
                    <button class="btn btn-outline-primary">
                        <i class="fa-solid fa-eye me-2"></i>Voir les détails
                    </button>
                </div>

            </div>
        </div>

        {{-- Commande 2 : En cours d'envoi --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h6 class="mb-0">Commande <strong>#00125</strong></h6>
                    <small class="text-muted">Passée le 18 avril 2026</small>
                </div>
                <span class="badge bg-primary fs-6">
                    <i class="fa-solid fa-truck me-1"></i>En cours d'envoi
                </span>
            </div>
            <div class="card-body">

                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <img src="{{ asset('images/products/happy-birthday.jpg') }}" class="img-fluid rounded" alt="I Am Creative Set" style="max-height: 80px; object-fit: contain;">
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-1">I Am Creative Set</h6>
                        <small class="text-muted">Anniversaire · Quantité : 1</small>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <strong>23.90 CHF</strong>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Total</small>
                        <strong class="fs-5 text-primary">23.90 CHF</strong>
                    </div>
                    <button class="btn btn-outline-primary">
                        <i class="fa-solid fa-eye me-2"></i>Voir les détails
                    </button>
                </div>

            </div>
        </div>

        {{-- Commande 3 : En préparation --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h6 class="mb-0">Commande <strong>#00126</strong></h6>
                    <small class="text-muted">Passée le 21 avril 2026</small>
                </div>
                <span class="badge bg-warning text-dark fs-6">
                    <i class="fa-solid fa-box me-1"></i>En préparation
                </span>
            </div>
            <div class="card-body">

                <div class="row align-items-center mb-3">
                    <div class="col-md-2">
                        <img src="{{ asset('images/products/birthday-girl.jpg') }}" class="img-fluid rounded" alt="MU Style Écharpe Birthday Girl" style="max-height: 80px; object-fit: contain;">
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-1">MU Style Écharpe "Birthday Girl" + couronne</h6>
                        <small class="text-muted">Anniversaire · Quantité : 1</small>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <strong>14.90 CHF</strong>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Total</small>
                        <strong class="fs-5 text-primary">14.90 CHF</strong>
                    </div>
                    <button class="btn btn-outline-primary">
                        <i class="fa-solid fa-eye me-2"></i>Voir les détails
                    </button>
                </div>

            </div>
        </div>

    </div>
@endsection
