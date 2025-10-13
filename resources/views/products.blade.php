<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Catalogue complet de pièces détachées - Auto Pièces R.M">
    <title>Produits - Auto Pièces R.M</title>

    {{-- Fonts & Styles --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>/* Quick View Overlay */
/* Quick View Overlay (white & red theme) */
.product-quickview {
  display: none;
  position: fixed;
  inset: 0;
  z-index: 9999;
  background: rgba(0, 0, 0, 0.6);
}

.product-quickview.active {
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Dialog box */
.product-quickview__dialog {
  position: relative;
  background: #ffffff;
  border-radius: 12px;
  width: 95%;
  max-width: 900px;
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  padding: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
  z-index: 10;
  animation: fadeIn 0.25s ease;
}

/* Close button */
.product-quickview__close {
  position: absolute;
  top: 10px;
  right: 10px;
  background: #e60000;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 32px;
  height: 32px;
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}

.product-quickview__close:hover {
  background: #c00000;
}

/* Media section */
.product-quickview__media {
  flex: 1 1 45%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
}

.product-quickview__media img {
  width: 100%;
  max-height: 380px;
  border-radius: 10px;
  object-fit: contain;
  background: #fafafa;
  border: 1px solid #eee;
}

/* Thumbnails */
.product-quickview__thumbs {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  gap: 10px;
  margin-top: 12px;
  padding: 5px 0;
  overflow-x: auto;
  scrollbar-width: thin;
  scrollbar-color: #e60000 #f0f0f0;
}

.product-quickview__thumbs::-webkit-scrollbar {
  height: 6px;
}

.product-quickview__thumbs::-webkit-scrollbar-thumb {
  background-color: #e60000;
  border-radius: 4px;
}

.product-quickview__thumbs img {
  width: 70px;
  height: 70px;
  object-fit: cover;
  border-radius: 8px;
  cursor: pointer;
  border: 2px solid transparent;
  transition: all 0.25s ease;
  flex-shrink: 0;
  background: #fff;
}

.product-quickview__thumbs img:hover {
  transform: scale(1.05);
}

.product-quickview__thumbs img.active {
  border-color: #e60000;
  box-shadow: 0 0 5px rgba(230, 0, 0, 0.4);
}

/* Content area */
.product-quickview__content {
  flex: 1 1 50%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  color: #333;
}

.qv-title {
  font-size: 1.6rem;
  font-weight: 600;
  margin-bottom: 10px;
  color: #111;
}

.qv-meta {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 10px;
  flex-wrap: wrap;
}

.qv-price {
  color: #e60000;
  font-weight: 700;
  font-size: 1.2rem;
}

.qv-stock {
  color: #555;
  font-size: 0.9rem;
}

.qv-desc {
  margin-bottom: 15px;
  color: #444;
  line-height: 1.5;
}

.qv-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
}

.qv-qty {
  display: flex;
  align-items: center;
  border: 1px solid #ddd;
  border-radius: 6px;
  overflow: hidden;
}

.qv-qty__btn {
  background: #f4f4f4;
  border: none;
  width: 35px;
  height: 35px;
  cursor: pointer;
  font-size: 18px;
  color: #e60000;
  transition: all 0.2s ease;
}

.qv-qty__btn:hover {
  background: #ffe5e5;
}

.qv-qty__input {
  width: 50px;
  text-align: center;
  border: none;
  font-size: 16px;
  color: #f8f6f6ff;
}

.qv-add {
  background: #e60000;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
}

.qv-add:hover {
  background: #c00000;
}

/* Responsive layout */
@media (max-width: 768px) {
  .product-quickview__dialog {
    flex-direction: column;
    padding: 15px;
  }

  .product-quickview__media {
    flex: 1 1 100%;
  }

  .product-quickview__media img {
    max-height: 280px;
  }

  .product-quickview__thumbs img {
    width: 60px;
    height: 60px;
  }

  .product-quickview__content {
    flex: 1 1 100%;
    text-align: center;
  }

  .qv-actions {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .product-quickview__media img {
    max-height: 220px;
  }

  .qv-title {
    font-size: 1.3rem;
  }

  .qv-price {
    font-size: 1.1rem;
  }
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}


</style>
</head>

<body>
    {{-- Header --}}
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <div class="logo-placeholder">
                        <span class="logo-text">AUTO PIÈCES R.M</span>
                    </div>
                </div>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Accueil</a></li>
                    <li class="nav-item"><a href="{{ url('/products') }}" class="nav-link active">Produits</a></li>
                    <li class="nav-item"><a href="{{ url('/#about') }}" class="nav-link">À Propos</a></li>
                    <li class="nav-item"><a href="{{ url('/#contact') }}" class="nav-link">Contact</a></li>
                </ul>

                <div class="cart-counter">
                    <a href="{{ url('/cart') }}" class="cart-link">
                        <span class="cart-icon">🛒</span>
                        <span class="cart-count">0</span>
                    </a>
                </div>

                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

     <main class="main">
       </br>
</br>
</br>
</br>
</br>


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
</br>
</br>
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
        </br>
        </br>
        </br>
    </main>
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



    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <p>&copy; {{ date('Y') }} Auto Pièces R.M - Tous droits réservés</p>
                </div>
                <div class="social-links">
                    <a href="#" target="_blank" class="social-link">Facebook</a>
                    <a href="#" target="_blank" class="social-link">Instagram</a>
                    <a href="#" target="_blank" class="social-link">WhatsApp</a>
                </div>
            </div>
        </div>
    </footer>
</body>
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
        gallery: img.dataset.images ? JSON.parse(img.dataset.images) : [], // ✅ FIXED (was gallery)
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
</html>
