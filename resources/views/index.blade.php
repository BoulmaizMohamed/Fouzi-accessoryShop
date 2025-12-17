@extends('layouts.app')

@section('title', 'King Auto - Accessoires et équipements automobiles')
@section('description', 'King Auto - Votre spécialiste en accessoires ')
@section('nav-home', 'active')

@section('content')
<!-- Hero Section -->
<section id="home" class="hero">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1 class="hero-title">Votre partenaire de confiance pour les Accessoires automobiles</h1>
            <p class="hero-subtitle">Accessoires automobiles de qualité pour toutes les marques et tous les modèles de voitures</p>
            <a href="{{ route('products.index') }}" class="cta-button">Voir nos produits</a>
        </div>
    </div>
</section>
</br></br></br>
<!-- Brands Section -->
 <!-- <section id="brands" class="brands">
    <div class="container">
        <div class="brands-grid">
            <div class="brand-item">
                <div class="brand-icon-bg">
                    <img src="{{ asset('img/peugeot.png') }}" alt="Peugeot">
                </div>
                <h3 class="brand-title">Peugeot</h3>
                <p class="brand-subtitle">Fiabilité et performance</p>
            </div>

            <div class="brand-item">
                <div class="brand-icon-bg">
                    <img src="{{ asset('img/renault.png') }}" alt="Renault">
                </div>
                <h3 class="brand-title">Renault</h3>
                <p class="brand-subtitle">Innovation au quotidien</p>
            </div>

            <div class="brand-item">
                <div class="brand-icon-bg">
                    <img src="{{ asset('img/citroen.png') }}" alt="Citroën">
                </div>
                <h3 class="brand-title">Citroën</h3>
                <p class="brand-subtitle">Confort et style français</p>
            </div>

            <div class="brand-item">
                <div class="brand-icon-bg">
                    <img src="{{ asset('img/dacia.png') }}" alt="Dacia">
                </div>
                <h3 class="brand-title">Dacia</h3>
                <p class="brand-subtitle">Accessible et robuste</p>
            </div>
            
        </div>
    </div>
</section> -->


<!-- Products Preview Section -->
<section id="products" class="products">
    <div class="container">
        <div class="products-header">
            <h2 class="section-title">Nos Produits</h2>
            <a href="{{ route('products.index') }}" class="see-all-link">
                Voir tout
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
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
                <p>King Auto est votre spécialiste en accessoires automobiles.
Nous proposons une large gamme d’accessoires de qualité adaptés à toutes les marques et tous les modèles de voitures.
Avec plus de 10 ans d’expérience, notre équipe vous garantit des produits fiables, un large choix et un service client exceptionnel.</p>
                <p>Notre expertise nous permet de vous conseiller et de vous fournir les accessoires adaptés à votre véhicule, que ce soit pour l’améliorer, le personnaliser ou le rendre plus confortable.</p>
            </div>
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Atelier automobile" class="about-img">
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact">
    <div class="container">
        <h2 class="section-title">Contactez-nous</h2>
        <div class="contact-content">
            <div class="contact-info">
                <h3>Informations de contact</h3>
                <div class="contact-item">
                    <strong>Adresse:</strong>
                    <p>F57H+X2H, N79, Zeghaia 43012</p>
                </div>
                <div class="contact-item">
                    <strong>Téléphone:</strong>
                    <p><a href="tel:055555555">0784194608</a> </p>
                </div>
                <div class="contact-item">
                    <strong>Email:</strong>
                    <p><a href="mailto:samibob422@gmail.com">samibob422@gmail.com</a></p>
                </div>
                <div class="contact-item">
                    <strong>Horaires:</strong>
                    <p>Lun–Ven : 8h–18h, Sam : 8h–12h</p>
                </div>
            </div>
            <div class="contact-form-container">
                <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <h3>Envoyez-nous un message</h3>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Nom" required class="form-input">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" required class="form-input">
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" placeholder="Téléphone" required class="form-input">
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
               src="https://www.google.com/maps/d/u/0/embed?mid=1atEq1piYO7_r3KiZ7UQGjEi-nDlVZPg&ehbc=2E312F&noprof=1"
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
@endsection