{{-- Formulaire de modification d'un produit existant avec remplacement optionnel de l'image --}}
@extends('layouts.admin')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="mb-0">Modifier le produit</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label fw-medium">Nom du produit <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Nom du produit" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3 mb-3">
                    <label for="slug" class="form-label fw-medium">Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required>
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="category_id" class="form-label fw-medium">Catégorie <span class="text-danger">*</span></label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="" selected disabled>Choisir une catégorie...</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="price" class="form-label fw-medium">Prix <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">CHF</span>
                        <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="0.00" required>
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="stock" class="form-label fw-medium">Stock <span class="text-danger">*</span></label>
                    <input type="number" min="0" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="image" class="form-label fw-medium">Image du produit</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <div class="form-text">Formats acceptés : JPG, PNG. Laissez vide pour conserver l'image actuelle.</div>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @if ($product->image)
                        <div class="mt-2">
                            <img src="{{ asset($product->image) }}" alt="Image actuelle" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif
                </div>

                <div class="col-md-12 mb-3">
                    <label for="description" class="form-label fw-medium">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Description détaillée du produit..." required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-medium" for="is_active">Produit actif (visible en boutique)</label>
                    </div>
                    @error('is_active')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour le produit</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#name').on('input', function() {
                let name = $(this).val();
                $('#slug').val(convertToSlug(name));
            });
        });
    </script>
@endpush