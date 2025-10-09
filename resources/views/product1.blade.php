<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - Auto Pièces R.M</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header__content">
                <div class="logo">
                    <h1>Auto Pièces R.M</h1>
                    <span class="tagline">Votre spécialiste en pièces détachées automobiles</span>
                </div>
                <nav class="nav">
                    <a href="#" class="nav-link">Accueil</a>
                    <a href="#" class="nav-link active">Produits</a>
                    <a href="#" class="nav-link">Services</a>
                    <a href="#" class="nav-link">Contact</a>
                    <button id="products-theme-toggle-btn" class="theme-toggle-button" aria-label="Basculer le mode sombre">
                        <span class="theme-toggle-icon">🌙</span>
                    </button>
                </nav>
            </div>
        </div>
    </header>

    <main class="main">
        <section class="hero">
            <div class="container">
                <h2 class="hero__title">Nos Pièces Détachées</h2>
                <p class="hero__subtitle">Découvrez notre large gamme de pièces automobiles de qualité</p>
            </div>
        </section>

        <section class="products-section">
            <div class="container">
                <div class="filters">
                    <h3 class="filters__title">Filtrer par catégorie</h3>
                    <div class="filter-buttons">
                        <button class="filter-btn active" data-category="Tous">Tous</button>
                        <button class="filter-btn" data-category="Freinage">Freinage</button>
                        <button class="filter-btn" data-category="Moteur">Moteur</button>
                        <button class="filter-btn" data-category="Éclairage">Éclairage</button>
                        <button class="filter-btn" data-category="Pneumatiques">Pneumatiques</button>
                    </div>
                </div>

                <div class="products-grid">
                    <!-- Freinage Products -->
                    <div class="product-card" data-category="Freinage">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&h=200&fit=crop" alt="Plaquettes de frein Peugeot">
                        </div>
                        <div class="product-info">
                            <h4 class="product-name">Plaquettes de frein Peugeot</h4>
                            <span class="product-category">Freinage</span>
                            <div class="product-price">45,99 €</div>
                            <button class="btn btn--primary add-to-cart">Ajouter au panier</button>
                        </div>
                    </div>

                    <div class="product-card" data-category="Freinage">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=300&h=200&fit=crop" alt="Disques de frein Renault">
                        </div>
                        <div class="product-info">
                            <h4 class="product-name">Disques de frein Renault</h4>
                            <span class="product-category">Freinage</span>
                            <div class="product-price">89,50 €</div>
                            <button class="btn btn--primary add-to-cart">Ajouter au panier</button>
                        </div>
                    </div>

                    <!-- Moteur Products -->
                    <div class="product-card" data-category="Moteur">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=300&h=200&fit=crop" alt="Filtre à huile">
                        </div>
                        <div class="product-info">
                            <h4 class="product-name">Filtre à huile</h4>
                            <span class="product-category">Moteur</span>
                            <div class="product-price">12,50 €</div>
                            <button class="btn btn--primary add-to-cart">Ajouter au panier</button>
                        </div>
                    </div>

                    <div class="product-card" data-category="Moteur">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1609630875171-b1321377ee65?w=300&h=200&fit=crop" alt="Courroie de distribution">
                        </div>
                        <div class="product-info">
                            <h4 class="product-name">Courroie de distribution</h4>
                            <span class="product-category">Moteur</span>
                            <div class="product-price">67,80 €</div>
                            <button class="btn btn--primary add-to-cart">Ajouter au panier</button>
                        </div>
                    </div>

                    <div class="product-card" data-category="Moteur">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=300&h=200&fit=crop" alt="Bougies d'allumage">
                        </div>
                        <div class="product-info">
                            <h4 class="product-name">Bougies d'allumage</h4>
                            <span class="product-category">Moteur</span>
                            <div class="product-price">28,90 €</div>
                            <button class="btn btn--primary add-to-cart">Ajouter au panier</button>
                        </div>
                    </div>

                    <div class="product-card" data-category="Moteur">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=300&h=200&fit=crop" alt="Amortisseurs">
                        </div>
                        <div class="product-info">
                            <h4 class="product-name">Amortisseurs</h4>
                            <span class="product-category">Moteur</span>
                            <div class="product-price">89,99 €</div>
                            <button class="btn btn--primary add-to-cart">Ajouter au panier</button>
                        </div>
                    </div>

                    <!-- Éclairage Products -->
                    <div class="product-card" data-category="Éclairage">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=300&h=200&fit=crop" alt="Phares LED">
                        </div>
                        <div class="product-info">
                            <h4 class="product-name">Phares LED</h4>
                            <span class="product-category">Éclairage</span>
                            <div class="product-price">125,00 €</div>
                            <button class="btn btn--primary add-to-cart">Ajouter au panier</button>
                        </div>
                    </div>

                    <div class="product-card" data-category="Éclairage">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&h=200&fit=crop" alt="Ampoules H7">
                        </div>
                        <div class="product-info">
                            <h4 class="product-name">Ampoules H7</h4>
                            <span class="product-category">Éclairage</span>
                            <div class="product-price">15,99 €</div>
                            <button class="btn btn--primary add-to-cart">Ajouter au panier</button>
                        </div>
                    </div>

                    <!-- Pneumatiques Products -->
                    <div class="product-card" data-category="Pneumatiques">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=300&h=200&fit=crop" alt="Pneus été">
                        </div>
                        <div class="product-info">
                            <h4 class="product-name">Pneus été</h4>
                            <span class="product-category">Pneumatiques</span>
                            <div class="product-price">199,99 €</div>
                            <button class="btn btn--primary add-to-cart">Ajouter au panier</button>
                        </div>
                    </div>

                    <div class="product-card" data-category="Pneumatiques">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=300&h=200&fit=crop" alt="Pneus hiver">
                        </div>
                        <div class="product-info">
                            <h4 class="product-name">Pneus hiver</h4>
                            <span class="product-category">Pneumatiques</span>
                            <div class="product-price">219,99 €</div>
                            <button class="btn btn--primary add-to-cart">Ajouter au panier</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Auto Pièces R.M - Tous droits réservés</p>
        </div>
    </footer>

    <script src="app.js"></script>
</body>
</html>