@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h1 class="mb-0">Gestion des catégories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-2"></i>Créer une catégorie
        </a>
    </div>

    {{-- Session alerts --}}
    @include('partials.session-alert')

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Slug</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                            <td><strong>{{ $category->name }}</strong></td>
                            <td>{{ $category->slug }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger delete-category" data-id="{{ $category->id }}" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3">
                                <div class="text-muted">
                                    Aucune catégorie trouvée.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $categories->links() }}
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.delete-category', function() {
            let id = $(this).data('id');
            if (confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')) {
                window.location.href = "{{ route('admin.categories.delete', ':id') }}".replace(':id', id);
            }
        });
    </script>
@endpush