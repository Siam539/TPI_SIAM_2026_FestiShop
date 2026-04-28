@extends('layouts.admin')

@section('content')
    <div class="my-4">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h1 class="mb-0">Gestion des utilisateurs</h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Créer un utilisateur
            </a>
        </div>

        {{-- Filtres --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.users') }}" method="GET">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="text" class="form-control" placeholder="Rechercher par nom ou prénom..." name="name" value="{{ request('name') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="role">
                                <option value="">Tous les rôles</option>
                                <option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                                <option value="manutentionnaire" {{ request('role') == 'manutentionnaire' ? 'selected' : '' }}>Manutentionnaire</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
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
                            @if (request('name') || request('role') || request('is_active'))
                                <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary flex-fill">Réinitialiser</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Session alerts --}}
        @include('partials.session-alert')

        {{-- Tableau --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            @php
                                $user_color_class = '';
                                switch ($user->role) {
                                    case 'customer':
                                        $user_color_class = 'bg-primary';
                                        break;
                                    case 'manutentionnaire':
                                        $user_color_class = 'bg-success';
                                        break;
                                    case 'admin':
                                        $user_color_class = 'bg-danger';
                                        break;
                                }
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                <td><strong>{{ $user->last_name }}</strong></td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge {{ $user_color_class }}">{{ ucfirst($user->role) }}</span></td>
                                <td><span class="badge {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $user->is_active ? 'Actif' : 'Inactif' }}</span></td>
                                <td class="text-end">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    @if ($user->role != 'admin')
                                        <button class="btn btn-sm {{ $user->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} change-status" data-id="{{ $user->id }}" title="{{ $user->is_active ? 'Désactiver' : 'Activer' }}">
                                            <i class="fa-solid {{ $user->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-user" data-id="{{ $user->id }}" title="Supprimer">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-3">
                                    <div class="text-muted">
                                        Aucun utilisateur trouvé pour les critères de recherche.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="card-footer">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.change-status').click(function () {
            var id = $(this).data('id');
            if (confirm('Êtes-vous sûr de vouloir changer le statut de cet utilisateur?')) {
                window.location.href = "{{ route('admin.users.change-status', ':id') }}".replace(':id', id);
            }
        })
        $('.delete-user').click(function () {
            var id = $(this).data('id');
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')) {
                window.location.href = "{{ route('admin.users.delete', ':id') }}".replace(':id', id);
            }
        })
    </script>
@endpush