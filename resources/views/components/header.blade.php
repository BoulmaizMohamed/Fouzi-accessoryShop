<header class="header">
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <div class="logo-placeholder">
                    <span class="logo-text">King Auto</span>
                </div>
            </div>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link">Produits</a>
                </li>
                <li class="nav-item">
                    <a href="#about" class="nav-link">À Propos</a>
                </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link">Contact</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cart.index') }}" class="nav-link">
                        Panier <span class="cart-count">{{ app(\App\Services\Cart::class)->count() }}</span>
                    </a>
                </li>
            </ul>

            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>
</header>
