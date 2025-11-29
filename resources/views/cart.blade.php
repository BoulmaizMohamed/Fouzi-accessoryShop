@extends('layouts.app')

@section('title', 'Panier - King Auto')
@section('nav-cart', 'active')

@section('content')
<section class="cart-section" data-color-scheme="light">
    <div class="container">
        <h1 class="section-title">Votre Panier</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if(empty($items))
            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <h2>Votre panier est vide</h2>
                <p>Découvrez nos produits et ajoutez-les à votre panier</p>
                <a href="{{ route('products.index') }}" class="btn btn--primary">Voir nos produits</a>
            </div>
        @else
            <div class="cart-content">
                <div class="cart-items">
                    @foreach($items as $item)
                        <div class="cart-item">
                            <div class="cart-item-image">
                                @if(!empty($item['image']))
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                @else
                                    <div class="no-image">📦</div>
                                @endif
                            </div>
                            
                            <div class="cart-item-details">
                                <h3 class="cart-item-name">{{ $item['name'] }}</h3>
                                <p class="cart-item-price">{{ number_format($item['price'], 2) }} Dz</p>
                            </div>
                            
                            <div class="cart-item-quantity">
                                <form action="{{ route('cart.update', $item['product_id']) }}" method="post" class="quantity-form">
                                    @csrf
                                    @method('PATCH')
                                    <div class="quantity-controls">
                                        <input type="number" name="qty" min="1" value="{{ $item['qty'] }}" class="quantity-input">
                                        <button type="submit" class="btn btn--sm btn--secondary">Mettre à jour</button>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="cart-item-subtotal">
                                <span class="subtotal-amount">{{ number_format($item['price'] * $item['qty'], 2) }} Dz</span>
                            </div>
                            
                            <div class="cart-item-actions">
                                <form action="{{ route('cart.remove', $item['product_id']) }}" method="post" class="remove-form">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-remove" title="Supprimer">🗑️</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="cart-summary">
                    <div class="summary-card">
                        <h3>Résumé de la commande</h3>
                        <div class="summary-line">
                            <span>Sous-total</span>
                            <span>{{ number_format($total, 2) }} Dz</span>
                        </div>
                        <div class="summary-line total">
                            <span>Total</span>
                            <span>{{ number_format($total, 2) }} Dz</span>
                        </div>
                        <form action="{{ route('cart.clear') }}" method="post" class="clear-cart-form">
                            @csrf 
                            <button type="submit" class="btn btn--outline">Vider le panier</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="checkout-section">
                <div class="checkout-form-container">
                    <h2 class="form-title">Informations de livraison</h2>
                    <form action="{{ route('cart.checkout') }}" method="post" class="checkout-form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="customer_name" class="form-label">Nom complet *</label>
                                <input type="text" id="customer_name" name="customer_name" 
                                       value="{{ old('customer_name') }}" 
                                       class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Téléphone *</label>
                                <input type="text" id="phone" name="phone" 
                                       value="{{ old('phone') }}" 
                                       class="form-input" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" 
                                   value="{{ old('email') }}" 
                                   class="form-input">
                        </div>
                        
                        <div class="form-group">
                            <label for="address" class="form-label">Adresse de livraison *</label>
                            <input type="text" id="address" name="address" 
                                   value="{{ old('address') }}" 
                                   class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="notes" class="form-label">Notes (optionnel)</label>
                            <textarea id="notes" name="notes" 
                                      class="form-textarea" rows="3">{{ old('notes') }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn--primary btn--full-width" 
                                {{ empty($items) ? 'disabled' : '' }}>
                            Confirmer la commande ({{ number_format($total, 2) }} Dz)
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection