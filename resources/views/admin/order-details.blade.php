{{-- Détail d'une commande côté admin : articles, adresses et changement de statut --}}
@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Session alerts --}}
            @include('partials.session-alert')

            <!-- Carte des détails de la commande -->
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center flex-wrap py-3">
                    <div>
                        <h5 class="mb-0 fw-bold">Détails de la commande</h5>
                        <p class="mb-0 text-muted">Passée le {{ $order->created_at->format('d-m-Y | H:i') }}</p>
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

            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center flex-wrap py-3">
                    <h5 class="mb-0 fw-bold">Informations de livraison</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Nom :</strong> {{ $order->user->name }}</p>
                            <p><strong>Email :</strong> {{ $order->user->email }}</p>
                            <p><strong>Téléphone :</strong> {{ $order->user->phone }}</p>
                            <p><strong>Adresse de facturation :</strong> {{ $order->user->billing_address }}</p>
                            <p><strong>Adresse de livraison :</strong> {{ $order->user->shipping_address }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white px-4 py-3">
                    @if ($order->status == 'open')
                        <button class="btn btn-info status-btn" data-id="{{ $order->id }}" data-status="preparation"><i class="fa-solid fa-box me-1"></i>En préparation</button>
                    @elseif($order->status == 'preparation')
                        <button class="btn btn-primary status-btn" data-id="{{ $order->id }}" data-status="shipping"><i class="fa-solid fa-truck-fast me-1"></i>En cours d'envoi</button>
                        <button class="btn btn-warning status-btn" data-id="{{ $order->id }}" data-status="awaiting"><i class="fa-solid fa-clock me-1"></i>En attente</button>
                    @elseif($order->status == 'awaiting')
                        <button class="btn btn-primary status-btn" data-id="{{ $order->id }}" data-status="shipping"><i class="fa-solid fa-truck-fast me-1"></i>En cours d'envoi</button>
                    @elseif($order->status == 'shipping')
                        <button class="btn btn-success status-btn" data-id="{{ $order->id }}" data-status="delivered"><i class="fa-solid fa-circle-check me-1"></i>Livrée</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.status-btn').click(function() {
            let orderId = $(this).data('id');
            let status = $(this).data('status');
            if (confirm("Êtes-vous sûr de vouloir changer le statut de la commande?")) {
                let url = "{{ route('admin.order.status-update', ':orderId') }}".replace(':orderId', orderId) + '?status=' + status;
                window.location.href = url;
            }
        });
    </script>
@endpush
