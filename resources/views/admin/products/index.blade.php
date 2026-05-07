{{-- Liste des produits avec options de création, modification, activation et suppression --}}
@extends('layouts.admin')

@section('content')
    <div class="my-4">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h1 class="mb-0">Gestion des produits</h1>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Créer un produit
            </a>
        </div>

        {{-- Filtres --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.products.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" class="form-control" placeholder="Rechercher par nom..." name="name" value="{{ request('name') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="category" value="{{ request('category') }}">
                            <option value="">Toutes les catégories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="is_active">
                            <option value="">Tous les statuts</option>
                            <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Actif</option>
                            <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Inactif</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">Filtrer</button>
                        @if (request('name') || request('category') || request('is_active') != null)
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary flex-fill">Réinitialiser</a>
                        @endif
                    </div>
                </div>
                </form>
            </div>
        </div>

        {{-- Session alerts --}}
        @include('partials.session-alert')

        {{-- Tableau des produits --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td><strong>{{ $product->name }}</strong></td>
                                <td><span class="badge bg-secondary">{{ $product->category?->name }}</span></td>
                                <td>{{ $product->price }} CHF</td>
                                <td>{{ $product->stock }}</td>
                                <td><span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">{{ $product->is_active ? 'Actif' : 'Inactif' }}</span></td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.edit', $product->id) }}" title="Modifier">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <button class="btn btn-sm {{ $product->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} change-status" data-id="{{ $product->id }}" title="{{ $product->is_active ? 'Désactiver' : 'Activer' }}">
                                        <i class="fa-solid {{ $product->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-product" data-id="{{ $product->id }}" title="Supprimer">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucun produit trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $products->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.change-status').click(function() {
            let id = $(this).data('id');
            if (confirm('Êtes-vous sûr de vouloir changer le statut de ce produit?')) {
                window.location.href = "{{ route('admin.products.change-status', ':id') }}".replace(':id', id);
            }
        });

        $('.delete-product').click(function() {
            let id = $(this).data('id');
            if (confirm('Êtes-vous sûr de vouloir supprimer ce produit?')) {
                window.location.href = "{{ route('admin.products.delete', ':id') }}".replace(':id', id);
            }
        });
    </script>
@endpush
