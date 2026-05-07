{{-- Page listant toutes les commandes de l'utilisateur connecté avec leur statut --}}
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

    .text-primary {
        color: #9c27b0 !important;
    }

    .btn-outline-primary {
        color: #9c27b0;
        border-color: #9c27b0;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-outline-primary:hover {
        background-color: #9c27b0;
        border-color: #9c27b0;
        color: #fff;
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

        <h1 class="mb-4">Mes Commandes</h1>

        @forelse ($orders as $order)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h6 class="mb-0">Commande <strong>#{{ $order->id }}</strong></h6>
                        <small class="text-muted">Passée le {{ $order->created_at->format('d-m-Y | H:i') }}</small>
                    </div>
                    @if ($order->status == 'open')
                        <span class="badge bg-warning text-dark fs-6">
                            <i class="fa-solid fa-box me-1"></i>Ouverte
                        </span>
                    @elseif($order->status == 'preparation')
                        <span class="badge bg-info text-dark fs-6">
                            <i class="fa-solid fa-box me-1"></i>En préparation
                        </span>
                    @elseif($order->status == 'awaiting')
                        <span class="badge bg-warning text-dark fs-6">
                            <i class="fa-solid fa-clock me-1"></i>En attente
                        </span>
                    @elseif($order->status == 'shipping')
                        <span class="badge bg-primary fs-6">
                            <i class="fa-solid fa-truck-fast me-1"></i>En cours d'envoi
                        </span>
                    @elseif($order->status == 'delivered')
                        <span class="badge bg-success fs-6">
                            <i class="fa-solid fa-circle-check me-1"></i>Livrée
                        </span>
                    @endif
                </div>
                <div class="card-body">

                    {{-- Article --}}
                    @foreach ($order->orderItems as $item)
                        <div class="row align-items-center mb-3">
                            <div class="col-md-2">
                                <img src="{{ asset($item->product?->image) }}" class="img-fluid rounded" alt="{{ $item->product?->name }}" style="max-height: 80px; object-fit: contain;">
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-1">{{ $item->product?->name }}</h6>
                                <small class="text-muted">{{ $item->product?->category?->name }} · Quantité : {{ $item->quantity }}</small>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <strong>{{ $item->unit_price * $item->quantity }} CHF</strong>
                            </div>
                        </div>
                    @endforeach

                    <hr>

                    {{-- Total + Détails --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted d-block">Total</small>
                            <strong class="fs-5 text-primary">{{ $order->total_price }} CHF</strong>
                        </div>
                        <a href="{{ route('order-details', $order->id) }}" class="btn btn-outline-primary">
                            <i class="fa-solid fa-eye me-2"></i>Voir les détails
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <p class="text-center">Vous n'avez aucune commande</p>
                </div>
            </div>
        @endforelse
    </div>
@endsection
