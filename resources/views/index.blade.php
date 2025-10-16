@extends('layouts.app')

@section('title', 'Auto Pièces R.M - Pièces détachées automobiles')
@section('description', 'Auto Pièces R.M - Votre spécialiste en pièces détachées pour Peugeot, Renault, Citroën et Dacia')
@section('nav-home', 'active')

@section('content')
<!-- Hero Section -->
<section id="home" class="hero">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1 class="hero-title">Votre partenaire de confiance pour les pièces auto</h1>
            <p class="hero-subtitle">Pièces détachées de qualité pour Peugeot, Renault, Citroën et Dacia</p>
            <a href="{{ route('products.index') }}" class="cta-button">Voir nos produits</a>
        </div>
    </div>
</section>

<!-- Brands Section -->
<section id="brands" class="brands">
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

<!-- Contact Section -->
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
@endsection