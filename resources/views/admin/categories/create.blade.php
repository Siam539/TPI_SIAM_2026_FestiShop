@extends('layouts.admin')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Ajouter une catégorie</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required>
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#name').on('input', function() {
            $('#slug').val(convertToSlug($(this).val()));
        });
    </script>
@endpush
