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
                            <p class="product-price">{{ number_format($product->price, 2) }} DH</p>
                            <button class="add-to-cart-btn" data-product-id="{{ $product->id }}">Ajouter au panier</button>
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
</html>
