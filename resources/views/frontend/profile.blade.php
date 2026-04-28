@extends('layouts.frontend')

@section('content')
    <div class="my-4">

        <h1 class="mb-4">Mon Profil</h1>

        <div class="row">
            {{-- Colonne de gauche : photo + navigation --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img src="{{ asset('images/profile-picture/blank-profile.webp') }}" alt="Photo de profil" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                        <h5 class="mb-1">John Doe</h5>
                        <span class="badge bg-primary mb-3">Client</span>
                        <p class="text-muted small mb-0">Membre depuis avril 2026</p>
                    </div>
                </div>

                {{-- Déconnexion --}}
                <div class="d-grid mt-3">
                    <button class="btn btn-outline-danger">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>Se déconnecter
                    </button>
                </div>
            </div>

            {{-- Colonne de droite : infos --}}
            <div class="col-lg-8 mb-4">

                {{-- Informations personnelles --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fa-solid fa-user me-2"></i>Informations personnelles</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control" value="Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Prénom</label>
                                <input type="text" class="form-control" value="John">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="john.doe@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" value="+41 79 123 45 67">
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Adresses --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fa-solid fa-location-dot me-2"></i>Mes adresses</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Adresse de facturation</label>
                                <input type="text" class="form-control mb-2" placeholder="Rue et numéro" value="Rue du Stand 45">
                                <div class="row g-2">
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="NPA" value="1204">
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" placeholder="Ville" value="Genève">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Adresse de livraison</label>
                                <input type="text" class="form-control mb-2" placeholder="Rue et numéro" value="Rue du Stand 45">
                                <div class="row g-2">
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="NPA" value="1204">
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" placeholder="Ville" value="Genève">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Sécurité / Mot de passe --}}
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fa-solid fa-lock me-2"></i>Sécurité</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Mot de passe actuel</label>
                                <input type="password" class="form-control" placeholder="••••••••">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control" placeholder="••••••••">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control" placeholder="••••••••">
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button class="btn btn-primary">
                                <i class="fa-solid fa-key me-2"></i>Changer le mot de passe
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
