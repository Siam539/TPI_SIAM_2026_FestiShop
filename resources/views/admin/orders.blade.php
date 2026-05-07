{{-- Liste des commandes côté admin : suivi et mise à jour des statuts --}}
@extends('layouts.admin')

@section('content')
    <div class="my-4">

        {{-- Session alerts --}}
        @include('partials.session-alert')

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h1 class="mb-0">Gestion des commandes</h1>
        </div>

        {{-- Tableau (de la + récente à la + ancienne) --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Articles</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->created_at->format('d-m-Y | H:i') }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td><span class="badge bg-success">{{ $order->orderItems->sum('quantity') }}</span></td>
                                <td><strong>{{ $order->total_price }} CHF</strong></td>
                                <td>
                                    @if ($order->status == 'open')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fa-solid fa-box me-1"></i>Ouverte
                                        </span>
                                    @elseif($order->status == 'preparation')
                                        <span class="badge bg-info text-dark">
                                            <i class="fa-solid fa-box me-1"></i>En préparation
                                        </span>
                                    @elseif($order->status == 'awaiting')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fa-solid fa-clock me-1"></i>En attente
                                        </span>
                                    @elseif($order->status == 'shipping')
                                        <span class="badge bg-primary">
                                            <i class="fa-solid fa-truck-fast me-1"></i>En cours d'envoi
                                        </span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge bg-success">
                                            <i class="fa-solid fa-circle-check me-1"></i>Livrée
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.order-details', $order->id) }}" class="btn btn-sm btn-outline-primary" title="Voir détails">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        @if ($order->status == 'open')
                                            <button class="btn btn-sm btn-info status-btn" data-id="{{ $order->id }}" data-status="preparation" title="En préparation">
                                                <i class="fa-solid fa-box"></i>
                                            </button>
                                        @elseif($order->status == 'preparation')
                                            <button class="btn btn-sm btn-primary status-btn" data-id="{{ $order->id }}" data-status="shipping" title="En cours d'envoi">
                                                <i class="fa-solid fa-truck-fast"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning status-btn" data-id="{{ $order->id }}" data-status="awaiting" title="En attente">
                                                <i class="fa-solid fa-clock"></i>
                                            </button>
                                        @elseif($order->status == 'awaiting')
                                            <button class="btn btn-sm btn-primary status-btn" data-id="{{ $order->id }}" data-status="shipping" title="En cours d'envoi">
                                                <i class="fa-solid fa-truck-fast"></i>
                                            </button>
                                        @elseif($order->status == 'shipping')
                                            <button class="btn btn-sm btn-success status-btn" data-id="{{ $order->id }}" data-status="delivered" title="Livrée">
                                                <i class="fa-solid fa-circle-check"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fa-solid fa-inbox fa-3x mb-3"></i>
                                        <p class="h5">Aucune commande trouvée</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
