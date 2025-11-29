@extends('layouts.app')

@section('title', 'Produits - King Auto')
@section('description', 'Catalogue complet de Accessoires automobiles - King Auto')
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
                                alt="{{ $product->name }}" 
                                class="product-image"
                                data-desc="{{ $product->description }}"
                                data-images='@json($product->images ?? [])'
                                data-add-url="{{ route('cart.add', $product) }}"
                                data-id="{{ $product->id }}"
                                data-price="{{ number_format($product->price, 2) }}">
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
            <h3 id="qv-title" class="qv-title">Nom du produit</h3>
            <p id="qv-desc" class="qv-desc">Description du produit.</p>

            <div class="qv-meta">
                <span id="qv-price" class="qv-price">0,00 Dz</span>
                <span id="qv-stock" class="qv-stock"></span>
            </div>

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
document.addEventListener('DOMContentLoaded', () => {
    const quickview = document.getElementById('product-quickview');
    const qvImage = document.getElementById('qv-image');
    const qvThumbs = document.getElementById('qv-thumbs');
    const qvDesc = document.getElementById('qv-desc');
    const qvAddBtn = document.getElementById('qv-add');
    const qvQty = document.getElementById('qv-qty');
    let currentAddUrl = null;

    // Handle qty buttons
    document.querySelectorAll('[data-qv-qty]').forEach(btn => {
        btn.addEventListener('click', () => {
            let val = parseInt(qvQty.value) || 1;
            if (btn.dataset.qvQty === 'inc') qvQty.value = val + 1;
            if (btn.dataset.qvQty === 'dec' && val > 1) qvQty.value = val - 1;
        });
    });

    // Toggle long description
    function setupDescriptionToggle(description) {
        const wordCount = description.split(' ').length;
        const charCount = description.length;

        if (charCount > 100 || wordCount > 20) {
            qvDesc.classList.add('collapsed');
            const toggleBtn = document.createElement('span');
            toggleBtn.className = 'qv-desc-toggle';
            toggleBtn.textContent = 'Voir plus';
            toggleBtn.addEventListener('click', function() {
                const isCollapsed = qvDesc.classList.contains('collapsed');
                qvDesc.classList.toggle('collapsed');
                qvDesc.classList.toggle('expanded');
                this.textContent = isCollapsed ? 'Voir moins' : 'Voir plus';
            });
            const existingToggle = qvDesc.parentNode.querySelector('.qv-desc-toggle');
            if (existingToggle) existingToggle.remove();
            qvDesc.parentNode.insertBefore(toggleBtn, qvDesc.nextSibling);
        } else {
            qvDesc.classList.remove('collapsed');
            qvDesc.classList.add('expanded');
            const existingToggle = qvDesc.parentNode.querySelector('.qv-desc-toggle');
            if (existingToggle) existingToggle.remove();
        }
    }

    // Open Quick View
    document.querySelectorAll('.product-image').forEach(img => {
        img.addEventListener('click', () => {
            const product = {
                title: img.closest('.product-card').querySelector('.product-name').textContent,
                price: img.closest('.product-card').querySelector('.product-price').textContent,
                desc: img.dataset.desc || 'Aucune description disponible.',
                main: img.src,
                gallery: img.dataset.images ? JSON.parse(img.dataset.images) : [],
                addUrl: img.dataset.addUrl
            };

            qvImage.src = product.main;
            document.getElementById('qv-title').textContent = product.title;
            document.getElementById('qv-price').textContent = product.price;
            document.getElementById('qv-desc').textContent = product.desc;
            currentAddUrl = product.addUrl;
            qvQty.value = 1;

            setupDescriptionToggle(product.desc);
            qvThumbs.innerHTML = '';

            const galleryImages = product.gallery
                .filter(imgPath => imgPath)
                .map(imgPath => imgPath.startsWith('http') ? imgPath : `/storage/${imgPath}`);
            const allImages = [product.main, ...galleryImages];

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

    // Add to cart (inside modal)
    qvAddBtn.addEventListener('click', async () => {
        if (!currentAddUrl) return;
        const qty = qvQty.value || 1;
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('qty', qty);

        qvAddBtn.disabled = true;
        qvAddBtn.textContent = 'Ajout...';

        try {
            const response = await fetch(currentAddUrl, { method: 'POST', body: formData });
            if (response.ok) {
                alert('Produit ajouté au panier ! 🛒');
                quickview.classList.remove('active');
            } else {
                alert('Erreur lors de l’ajout au panier.');
            }
        } catch (err) {
            console.error(err);
            alert('Une erreur s’est produite.');
        }

        qvAddBtn.textContent = 'Ajouter au panier';
        qvAddBtn.disabled = false;
    });

    // Close Quick View
    document.querySelectorAll('[data-qv-close]').forEach(btn => {
        btn.addEventListener('click', () => {
            quickview.classList.remove('active');
            qvDesc.classList.remove('collapsed', 'expanded');
            const toggleBtn = qvDesc.parentNode.querySelector('.qv-desc-toggle');
            if (toggleBtn) toggleBtn.remove();
        });
    });
});
</script>
@endsection
