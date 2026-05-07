{{-- Page de confirmation affichée après la validation d'une commande --}}
@push('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07) !important;
    }

    .card-header {
        border-radius: 12px 12px 0 0 !important;
        border-bottom: 1px solid #f0e6ff;
        padding: 1rem 1.25rem;
    }

    .card-footer {
        border-radius: 0 0 12px 12px !important;
        border-top: 1px solid #f0e6ff;
    }

    .text-success {
        color: #2e7d32 !important;
    }

    .table thead th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .table tbody tr:hover {
        background-color: #fdf6ff;
    }

    h1 {
        font-weight: 700;
    }
</style>
@endpush
@extends('layouts.frontend')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Section message de succès -->
            <div class="text-center mb-5">
                <i class="far fa-check-circle text-success display-1"></i>
                <h1 class="mt-3 fw-bold">Merci pour votre commande !</h1>
                <p class="text-muted lead">Votre commande a été passée avec succès et est en cours de traitement.</p>
            </div>

            <!-- Carte des détails de la commande -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Résumé de la commande</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead class="border-bottom bg-light">
                                <tr>
                                    <th class="py-3 px-4 text-muted">Produit</th>
                                    <th class="py-3 px-4 text-center text-muted">Qté</th>
                                    <th class="py-3 px-4 text-end text-muted">Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order?->orderItems as $orderItem)
                                    <tr>
                                        <td class="py-3 px-4">
                                            <p class="mb-0 fw-semibold">{{ $orderItem->product?->name }}</p>
                                            <small class="text-muted">Catégorie : {{ $orderItem->product?->category?->name }}</small>
                                        </td>
                                        <td class="py-3 px-4 text-center align-middle">{{ $orderItem->quantity }}</td>
                                        <td class="py-3 px-4 text-end align-middle">{{ $orderItem->unit_price * $orderItem->quantity }} CHF</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section calcul du total -->
                <div class="card-footer bg-white px-4 py-3">
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-5">{{ $order->total_price }} CHF</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
