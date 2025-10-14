
<div class="product-card">
    <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : (is_array($product->images) && count($product->images) ? asset('storage/' . $product->images[0]) : 'https://placehold.co/200x200/e60000/ffffff?text=Produit') }}"
         alt="{{ $product->name }}" 
         class="product-image"
         @if($withQuickView ?? false)
         data-desc="{{ $product->description }}"
         data-images="{{ json_encode($product->images ?? []) }}"
         @endif>
    <h3 class="product-name">{{ $product->name }}</h3>
    <p class="product-price">{{ number_format($product->price, 2) }} DH</p>
    
    <form action="{{ route('cart.add', $product) }}" method="post" class="add-to-cart-form">
        @csrf
        <div class="quantity-selector">
            <input type="number" name="qty" min="1" value="1" class="qty-input" hidden>
            <button type="submit" class="add-to-cart-btn">Ajouter au panier</button>
        </div>
    </form>
</div>