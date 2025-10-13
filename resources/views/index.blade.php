<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Auto Pièces R.M - Votre spécialiste en pièces détachées pour Peugeot, Renault, Citroën et Dacia">
    <title>Auto Pièces R.M - Pièces détachées automobiles</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
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
                    <a href="{{ route('home') }}" class="nav-link">Accueil</a>
                </li>
                    <li class="nav-item">
                        <a href="{{ url('/products') }}" class="nav-link">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link">À Propos</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">Contact</a>
                    </li>
                </ul>
               <li class="nav-item">
                    <a href="{{ route('cart.index') }}" class="nav-link">
                        Panier <span class="cart-count">{{ app(\App\Services\Cart::class)->count() }}</span>
                    </a>
               </li>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Container -->
    <main class="main-content">
        <!-- Home Page -->
        <div id="home-page" class="page active">
            <!-- Hero Section -->
            <section id="home" class="hero">
                <div class="hero-overlay">
                    <div class="hero-content">
                        <h1 class="hero-title">Votre partenaire de confiance pour les pièces auto</h1>
                        <p class="hero-subtitle">Pièces détachées de qualité pour Peugeot, Renault, Citroën et Dacia</p>
                        <button class="cta-button" onclick="showProductsCatalog()">Voir nos produits</button>
                    </div>
                </div>
            </section>

            <!-- Brands Section - Changed to 2x2 Grid -->
            <section id="brands" class="brands">
                <div class="container">
                    <h2 class="section-title">Nos Marques</h2>
                    <div class="brands-grid">
                        <div class="brand-item">
                            <div class="brand-logo-img">
                                <img src="https://images.unsplash.com/photo-1621936746098-c4e014110c95?w=120&h=60&fit=crop&crop=center" alt="Peugeot" class="brand-image" onerror="this.src='https://placehold.co/120x60/e60000/ffffff?text=PEUGEOT'">
                            </div>
                        </div>
                        <div class="brand-item">
                            <div class="brand-logo-img">
                                <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=120&h=60&fit=crop&crop=center" alt="Renault" class="brand-image" onerror="this.src='https://placehold.co/120x60/0066cc/ffffff?text=RENAULT'">
                            </div>
                        </div>
                        <div class="brand-item">
                            <div class="brand-logo-img">
                                <img src="https://images.unsplash.com/photo-1600712242805-5f78671b24da?w=120&h=60&fit=crop&crop=center" alt="Citroën" class="brand-image" onerror="this.src='https://placehold.co/120x60/cc0000/ffffff?text=CITROEN'">
                            </div>
                        </div>
                        <div class="brand-item">
                            <div class="brand-logo-img">
                                <img src="https://images.unsplash.com/photo-1542282088-fe8426682b8f?w=120&h=60&fit=crop&crop=center" alt="Dacia" class="brand-image" onerror="this.src='https://placehold.co/120x60/666666/ffffff?text=DACIA'">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Products Preview Section -->
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
                </div>
            </section>

            <!-- About Section -->
            <section id="about" class="about">
                <div class="container">
                    <h2 class="section-title">À Propos</h2>
                    <div class="about-content">
                        <div class="about-text">
                            <p>Auto Pièces R.M est votre spécialiste en pièces détachées automobiles. Nous proposons une large gamme de pièces de qualité pour les marques Peugeot, Renault, Citroën et Dacia. Avec plus de 15 ans d'expérience, notre équipe vous garantit des pièces authentiques et un service client exceptionnel.</p>
                            <p>Notre expertise nous permet de vous conseiller et de vous fournir les pièces adaptées à votre véhicule, que ce soit pour l'entretien courant ou les réparations plus complexes.</p>
                        </div>
                        <div class="about-image">
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Atelier automobile" class="about-img">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Section with Real Google Maps -->
            <section id="contact" class="contact">
                <div class="container">
                    <h2 class="section-title">Contactez-nous</h2>
                    <div class="contact-content">
                        <div class="contact-info">
                            <h3>Informations de contact</h3>
                            <div class="contact-item">
                                <strong>Adresse:</strong>
                                <p>123 Avenue de la République, 75011 Paris</p>
                            </div>
                            <div class="contact-item">
                                <strong>Téléphone:</strong>
                                <p><a href="tel:+33123456789">+33 1 23 45 67 89</a></p>
                            </div>
                            <div class="contact-item">
                                <strong>Email:</strong>
                                <p><a href="mailto:contact@autopiecesrm.fr">contact@autopiecesrm.fr</a></p>
                            </div>
                            <div class="contact-item">
                                <strong>Horaires:</strong>
                                <p>Lun-Ven: 8h-18h, Sam: 8h-12h</p>
                            </div>
                        </div>
                        <div class="contact-form-container">
                            <form class="contact-form">
                                <h3>Envoyez-nous un message</h3>
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Nom" required class="form-input">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" required class="form-input">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="Message" required class="form-textarea"></textarea>
                                </div>
                                <button type="submit" class="form-submit">Envoyer</button>
                            </form>
                        </div>
                    </div>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.991441919!2d2.3520659!3d48.8566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2s123%20Avenue%20de%20la%20R%C3%A9publique%2C%2075011%20Paris!5e0!3m2!1sen!2sfr!4v1699123456789!5m2!1sen!2sfr" 
                            width="100%" 
                            height="400" 
                            style="border:0; border-radius: 10px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </section>
        </div>

        <!-- Products Catalog Page -->
        <div id="products-page" class="page">
            <section id="products-catalog" class="products-catalog">
                <div class="container">
                    <h1 class="section-title">Catalogue Produits</h1>
                    
                    <div class="category-filters">
                        <button class="filter-btn active" data-category="all">Tous</button>
                        <button class="filter-btn" data-category="Freinage">Freinage</button>
                        <button class="filter-btn" data-category="Moteur">Moteur</button>
                        <button class="filter-btn" data-category="Éclairage">Éclairage</button>
                        <button class="filter-btn" data-category="Pneumatiques">Pneumatiques</button>
                    </div>

                    <div id="products-grid" class="products-grid">
                        <!-- Products will be populated by JavaScript -->
                    </div>
                </div>
            </section>
        </div>

        <!-- Cart Page -->
        <div id="cart-page" class="page">
            <section class="cart-section">
                <div class="container">
                    <h1 class="section-title">Panier</h1>
                    
                    <div id="cart-content">
                        <div id="cart-items-container">
                            <!-- Cart items will be populated by JavaScript -->
                        </div>
                        
                        <div class="cart-summary">
                            <div class="cart-total">
                                <h3>Total: <span id="cart-total">0,00 €</span></h3>
                            </div>
                            
                            <div class="cart-actions">
                                <button class="btn-secondary" onclick="showHome()">Continuer les achats</button>
                                <button class="btn-primary" onclick="checkout()">Commander</button>
                            </div>
                        </div>
                    </div>
                    
                    <div id="empty-cart" class="empty-cart" style="display: none;">
                        <p>Votre panier est vide</p>
                        <button class="cta-button" onclick="showProductsCatalog()">Voir nos produits</button>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <p>&copy; 2025 Auto Pièces R.M - Tous droits réservés</p>
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