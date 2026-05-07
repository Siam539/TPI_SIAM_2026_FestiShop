{{-- Profil utilisateur : modification des informations personnelles, adresses et mot de passe --}}
@push('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07) !important;
    }

    .card-header {
        border-radius: 12px 12px 0 0 !important;
        background-color: #fafafa !important;
        border-bottom: 1px solid #f0e6ff;
        padding: 1rem 1.25rem;
    }

    .badge.bg-primary {
        background-color: #9c27b0 !important;
        border-radius: 20px;
        padding: 5px 12px;
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

    .btn-outline-danger {
        border-radius: 8px;
        font-weight: 500;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #9c27b0;
        box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.15);
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

        <h1 class="mb-4">Mon Profil</h1>

        <div class="row">
            {{-- Colonne de gauche : photo + navigation --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img src="{{ asset('images/profile-picture/blank-profile.webp') }}" alt="Photo de profil" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                        <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                        <span class="badge bg-primary mb-3">
                            @if(auth()->user()->role == 'customer') Client @elseif(auth()->user()->role == 'admin') Administrateur @else {{ ucwords(auth()->user()->role) }} @endif
                        </span>
                        <p class="text-muted small mb-0">Membre depuis {{ auth()->user()->created_at->format('d F, Y') }}</p>
                    </div>
                </div>

                {{-- Déconnexion --}}
                <div class="d-grid mt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>Se déconnecter
                        </button>
                    </form>
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
                        <form action="{{ route('profile-details-update') }}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}">
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Prénom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Adresses --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fa-solid fa-location-dot me-2"></i>Mes adresses</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile-address-update') }}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Adresse de facturation <span class="text-danger">*</span></label>
                                    <textarea name="billing_address" id="billing_address" rows="4" class="form-control">{{ old('billing_address', auth()->user()->billing_address) }}</textarea>
                                    @error('billing_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Adresse de livraison <span class="text-danger">*</span></label>
                                    <textarea name="shipping_address" id="shipping_address" rows="4" class="form-control">{{ old('shipping_address', auth()->user()->shipping_address) }}</textarea>
                                    @error('shipping_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Sécurité / Mot de passe --}}
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fa-solid fa-lock me-2"></i>Sécurité</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile-password-update') }}" method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Mot de passe actuel <span class="text-danger">*</span></label>
                                    <input type="password" name="password_current" class="form-control" placeholder="••••••••">
                                    @error('password_current')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nouveau mot de passe <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-key me-2"></i>Changer le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
