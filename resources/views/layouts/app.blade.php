<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Auto Pièces R.M - Votre spécialiste en pièces détachées pour Peugeot, Renault, Citroën et Dacia')">
    <title>@yield('title', 'Auto Pièces R.M - Pièces détachées automobiles')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Additional styles -->
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <div class="logo-placeholder">
                        <span class="logo-text">AUTO PIÈCES R.M</span>
                    </div>
                </div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link @yield('nav-home')">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link @yield('nav-products')">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/#about') }}" class="nav-link @yield('nav-about')">À Propos</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/#contact') }}" class="nav-link @yield('nav-contact')">Contact</a>
                    </li>
                </ul>

                <div class="cart-counter">
                    @php($cartCount = app(\App\Services\Cart::class)->count())
                    <a href="{{ route('cart.index') }}" class="cart-link" aria-label="Panier ({{ $cartCount }} article{{ $cartCount > 1 ? 's' : '' }})">
                        <span class="cart-icon" aria-hidden="true">🛒</span>
                        <span class="cart-count">{{ $cartCount ?: '' }}</span>
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

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>