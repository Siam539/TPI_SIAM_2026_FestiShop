{{-- Page de commande : saisie des adresses de facturation et de livraison --}}
@push('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07) !important;
    }

    .text-primary {
        color: #9c27b0 !important;
    }

    .badge.bg-primary {
        background-color: #9c27b0 !important;
        border-radius: 20px;
        padding: 4px 10px;
    }

    .list-group-item {
        border-color: #f0e6ff;
        padding: 0.85rem 1rem;
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

    .form-control:focus,
    .form-select:focus {
        border-color: #9c27b0;
        box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.15);
    }

    .form-check-input:checked {
        background-color: #9c27b0;
        border-color: #9c27b0;
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

        <h1 class="mb-4">Passer la commande</h1>

        <div class="row">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3"> <span class="text-primary">Votre panier</span> <span class="badge bg-primary rounded-pill">{{ $cartCount }}</span> </h4>
                <ul class="list-group mb-3">
                    @foreach ($cartItems as $cartItem)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $cartItem->product->name }}</h6> <small class="text-body-secondary">Quantité : {{ $cartItem->quantity }}</small>
                            </div> <span class="text-body-secondary">{{ $cartItem->product->price * $cartItem->quantity }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between"> <span>Total (CHF)</span> <strong>{{ $cartTotal }}</strong> </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <form method="POST" action="{{ route('checkout-store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label for="billing_address" class="form-label">Adresse de facturation <span class="text-danger">*</span></label>
                            <textarea name="billing_address" id="billing_address" class="form-control" rows="4" placeholder="Entrez votre adresse de facturation..." required>{{ old('billing_address', auth()->user()->address) }}</textarea>
                            @error('billing_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="form-check">
                        <input type="checkbox" name="different_shipping_address" value="yes" class="form-check-input" id="different-shipping-address" {{ old('different_shipping_address') == 'yes' ? 'checked' : '' }}>
                        <label class="form-check-label" for="different-shipping-address">Expedier à une autre adresse?</label>
                    </div>
                    <div class="shipping-address-section mt-4" style="{{ old('different_shipping_address') == 'yes' ? '' : 'display: none;' }}">
                        <div class="row">
                            <div class="col-12">
                                <label for="shipping_address" class="form-label">Adresse de livraison <span class="text-danger">*</span></label>
                                <textarea name="shipping_address" id="shipping_address" class="form-control" rows="4" placeholder="Entrez votre adresse de livraison...">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                                @error('shipping_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Continuer vers le paiement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#different-shipping-address').on('click', function() {
            if($(this).is(':checked')) {
                $('.shipping-address-section').show();
            } else {
                $('.shipping-address-section').hide();
            }
        });
    </script>
@endpush