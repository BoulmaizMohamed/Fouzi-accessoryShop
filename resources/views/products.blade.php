@extends('layouts.app')

@section('title', 'Produits - Auto Pièces R.M')
@section('description', 'Catalogue complet de pièces détachées - Auto Pièces R.M')
@section('nav-products', 'active')

@section('content')
<div style="padding-top: 100px;"></div>

<section class="products-section">
    <div class="container">
        <div class="filters">
            <div class="filter-buttons">
                <a href="{{ route('products.index') }}" 
                   class="filter-btn {{ request('category') == null ? 'active' : '' }}">Tous</a>

                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category]) }}" 
                       class="filter-btn {{ request('category') == $category ? 'active' : '' }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>

        <section id="products" class="products">
            <div class="container">
                <h2 class="section-title">Nos Produits</h2>
                <div class="products-grid">
                    @forelse($products as $product)
                        <div class="product-card">
                            <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : (is_array($product->images) && count($product->images) ? asset('storage/' . $product->images[0]) : 'https://placehold.co/200x200/e60000/ffffff?text=Produit') }}"
                                alt="{{ $product->name }}" class="product-image">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <p class="product-price">{{ number_format($product->price, 2) }} DZ</p>
                            
                            <form action="{{ route('cart.add', $product) }}" method="post" class="add-to-cart-form">
                                @csrf
                                <div class="quantity-selector">
                                    <input type="number" name="qty" min="1" value="1" class="qty-input" hidden>
                                    <button type="submit" class="add-to-cart-btn">Ajouter au panier</button>
                                </div>
                            </form>
                        </div>
                    @empty
                        <div class="no-results">
                            <p>Aucun produit trouvé.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="pagination-container">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </section>
    </div>
</section>

<!-- Quick View Overlay -->
<div id="product-quickview" class="product-quickview" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="product-quickview__backdrop" data-qv-close></div>

    <div class="product-quickview__dialog" role="document">
        <button class="product-quickview__close" aria-label="Fermer" data-qv-close>✕</button>

        <div class="product-quickview__media">
            <img id="qv-image" src="" alt="Aperçu produit" />
            <div id="qv-thumbs" class="product-quickview__thumbs"></div>
        </div>

        <div class="product-quickview__content">
            <span id="qv-category" class="qv-category" hidden>Catégorie</span>
            <h3 id="qv-title" class="qv-title">Nom du produit</h3>

            <div class="qv-meta">
                <span id="qv-price" class="qv-price">0,00 DH</span>
                <span id="qv-stock" class="qv-stock"></span>
            </div>

            <p id="qv-desc" class="qv-desc">Description du produit.</p>

            <div class="qv-actions">
                <div class="qv-qty">
                    <button class="qv-qty__btn" data-qv-qty="dec" aria-label="Diminuer">−</button>
                    <input id="qv-qty" class="qv-qty__input" type="number" min="1" value="1" aria-label="Quantité" />
                    <button class="qv-qty__btn" data-qv-qty="inc" aria-label="Augmenter">+</button>
                </div>
                <button id="qv-add" class="qv-add">Ajouter au panier</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Quick View Logic
document.addEventListener('DOMContentLoaded', () => {
    const quickview = document.getElementById('product-quickview');
    const qvImage = document.getElementById('qv-image');
    const qvThumbs = document.getElementById('qv-thumbs');

    document.querySelectorAll('.product-image').forEach(img => {
        img.addEventListener('click', () => {
            const product = {
                title: img.closest('.product-card').querySelector('.product-name').textContent,
                price: img.closest('.product-card').querySelector('.product-price').textContent,
                desc: img.dataset.desc || '',
                main: img.src,
                gallery: img.dataset.images ? JSON.parse(img.dataset.images) : [],
            };

            // Display main image
            qvImage.src = product.main;
            document.getElementById('qv-title').textContent = product.title;
            document.getElementById('qv-price').textContent = product.price;
            document.getElementById('qv-desc').textContent = product.desc;

            // Clear old thumbs
            qvThumbs.innerHTML = '';

            // Combine all images
            const allImages = [product.main, ...product.gallery];

            allImages.forEach((src, i) => {
                const thumb = document.createElement('img');
                thumb.src = src;
                thumb.classList.toggle('active', i === 0);
                thumb.addEventListener('click', () => {
                    qvImage.src = src;
                    document.querySelectorAll('#qv-thumbs img').forEach(t => t.classList.remove('active'));
                    thumb.classList.add('active');
                });
                qvThumbs.appendChild(thumb);
            });

            quickview.classList.add('active');
        });
    });

    // Close actions
    document.querySelectorAll('[data-qv-close]').forEach(btn => {
        btn.addEventListener('click', () => quickview.classList.remove('active'));
    });
});
</script>
@endsection