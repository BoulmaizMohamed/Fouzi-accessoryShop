// DOM elements
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');
const navLinks = document.querySelectorAll('.nav-link');
const cartCount = document.querySelector('.cart-count');
const contactForm = document.querySelector('.contact-form');

// Page navigation
const pages = {
    home: document.getElementById('home-page'),
    products: document.getElementById('products-page'),
    cart: document.getElementById('cart-page')
};

// Products data
const allProducts = [
    {
        id: 1,
        name: "Plaquettes de frein Peugeot",
        category: "Freinage", 
        price: 45.99,
        image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 2,
        name: "Disques de frein Renault",
        category: "Freinage",
        price: 89.50,
        image: "https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 3,
        name: "Étriers de frein Citroën",
        category: "Freinage",
        price: 125.00,
        image: "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 4,
        name: "Filtre à huile",
        category: "Moteur",
        price: 12.50,
        image: "https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 5,
        name: "Courroie de distribution",
        category: "Moteur", 
        price: 67.80,
        image: "https://images.unsplash.com/photo-1609630875171-b1321377ee65?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 6,
        name: "Bougies d'allumage",
        category: "Moteur",
        price: 28.90,
        image: "https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 7,
        name: "Phares LED",
        category: "Éclairage",
        price: 125.00,
        image: "https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 8,
        name: "Ampoules H7",
        category: "Éclairage",
        price: 15.99,
        image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 9,
        name: "Feux arrière",
        category: "Éclairage", 
        price: 85.00,
        image: "https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 10,
        name: "Pneus été",
        category: "Pneumatiques",
        price: 199.99,
        image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 11,
        name: "Pneus hiver",
        category: "Pneumatiques",
        price: 219.99,
        image: "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=200&h=200&fit=crop&crop=center"
    },
    {
        id: 12,
        name: "Amortisseurs",
        category: "Moteur",
        price: 89.99,
        image: "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=200&h=200&fit=crop&crop=center"
    }
];

// Cart system (using memory instead of localStorage)
let cartItems = [];
let cartTotal = 0;

// Current page state
let currentPage = 'home';

// Mobile menu toggle
hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    navMenu.classList.toggle('active');
});

// Close mobile menu when clicking on nav links
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        hamburger.classList.remove('active');
        navMenu.classList.remove('active');
    });
});

// Page Navigation Functions
function showPage(pageName) {
    // Hide all pages
    Object.values(pages).forEach(page => {
        if (page) page.classList.remove('active');
    });
    
    // Show requested page
    if (pages[pageName]) {
        pages[pageName].classList.add('active');
        currentPage = pageName;
    }
    
    // Update navigation active states
    updateNavigation(pageName);
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function updateNavigation(pageName) {
    navLinks.forEach(link => {
        link.classList.remove('active');
        const href = link.getAttribute('href');
        
        if ((pageName === 'home' && href === '#home') ||
            (pageName === 'products' && href === '#products-catalog') ||
            (pageName === 'home' && href === '#about') ||
            (pageName === 'home' && href === '#contact')) {
            link.classList.add('active');
        }
    });
}

function showHome() {
    showPage('home');
}

function showProductsCatalog() {
    showPage('products');
    renderProductsCatalog();
}

function showCart() {
    showPage('cart');
    renderCart();
}

// Navigation event listeners
navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const targetId = link.getAttribute('href');
        
        if (targetId === '#products-catalog') {
            showProductsCatalog();
        } else if (targetId === '#home' || targetId === '#about' || targetId === '#contact') {
            showHome();
            // Smooth scroll to section if not home
            if (targetId !== '#home') {
                setTimeout(() => {
                    const targetSection = document.querySelector(targetId);
                    if (targetSection) {
                        const headerHeight = document.querySelector('.header').offsetHeight;
                        const targetPosition = targetSection.offsetTop - headerHeight;
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                }, 100);
            }
        }
    });
});

// Product Catalog Functions
function renderProductsCatalog(filterCategory = 'all') {
    const productsGrid = document.getElementById('products-grid');
    if (!productsGrid) return;
    
    const filteredProducts = filterCategory === 'all' 
        ? allProducts 
        : allProducts.filter(product => product.category === filterCategory);
    
    productsGrid.innerHTML = filteredProducts.map(product => `
        <div class="product-card">
            <img src="${product.image}" alt="${product.name}" class="product-image" onerror="this.src='https://placehold.co/200x200/e60000/ffffff?text=${encodeURIComponent(product.name.replace(/\s+/g, '+'))}'">
            <h3 class="product-name">${product.name}</h3>
            <p class="product-price">${product.price.toFixed(2).replace('.', ',')} €</p>
            <button class="add-to-cart-btn" data-product-id="${product.id}">Ajouter au panier</button>
        </div>
    `).join('');
    
    // Add event listeners to new buttons
    attachCartButtonListeners();
}

// Category filter functionality
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('filter-btn')) {
        const category = e.target.getAttribute('data-category');
        
        // Update active filter button
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        e.target.classList.add('active');
        
        // Render filtered products
        renderProductsCatalog(category);
    }
});

// Cart Functions
function addToCart(productId) {
    const product = allProducts.find(p => p.id === parseInt(productId));
    if (!product) return;
    
    const existingItem = cartItems.find(item => item.id === product.id);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cartItems.push({
            ...product,
            quantity: 1
        });
    }
    
    updateCartCounter();
    showNotification(`${product.name} ajouté au panier!`, 'success');
}

function removeFromCart(productId) {
    const index = cartItems.findIndex(item => item.id === parseInt(productId));
    if (index > -1) {
        cartItems.splice(index, 1);
        updateCartCounter();
        renderCart();
        showNotification('Produit retiré du panier', 'success');
    }
}

function updateQuantity(productId, newQuantity) {
    const item = cartItems.find(item => item.id === parseInt(productId));
    if (item) {
        if (newQuantity <= 0) {
            removeFromCart(productId);
        } else {
            item.quantity = newQuantity;
            updateCartCounter();
            renderCart();
        }
    }
}

function updateCartCounter() {
    const totalItems = cartItems.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;
}

function calculateTotal() {
    return cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
}

function renderCart() {
    const cartItemsContainer = document.getElementById('cart-items-container');
    const cartTotalElement = document.getElementById('cart-total');
    const emptyCart = document.getElementById('empty-cart');
    const cartContent = document.getElementById('cart-content');
    
    if (cartItems.length === 0) {
        if (emptyCart) emptyCart.style.display = 'block';
        if (cartContent) cartContent.style.display = 'none';
        return;
    }
    
    if (emptyCart) emptyCart.style.display = 'none';
    if (cartContent) cartContent.style.display = 'block';
    
    if (cartItemsContainer) {
        cartItemsContainer.innerHTML = cartItems.map(item => `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}" class="cart-item-image" onerror="this.src='https://placehold.co/80x80/e60000/ffffff?text=${encodeURIComponent(item.name.split(' ')[0])}'">
                <div class="cart-item-details">
                    <h3 class="cart-item-name">${item.name}</h3>
                    <p class="cart-item-category">${item.category}</p>
                    <p class="cart-item-price">${item.price.toFixed(2).replace('.', ',')} €</p>
                </div>
                <div class="cart-item-controls">
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                        <span class="quantity-display">${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                    </div>
                    <button class="remove-btn" onclick="removeFromCart(${item.id})">Supprimer</button>
                </div>
            </div>
        `).join('');
    }
    
    const total = calculateTotal();
    if (cartTotalElement) {
        cartTotalElement.textContent = `${total.toFixed(2).replace('.', ',')} €`;
    }
}

function checkout() {
    if (cartItems.length === 0) {
        showNotification('Votre panier est vide', 'error');
        return;
    }
    
    showNotification('Commande envoyée avec succès!', 'success');
    cartItems = [];
    updateCartCounter();
    renderCart();
}

// Attach event listeners to add to cart buttons
function attachCartButtonListeners() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const productId = e.target.getAttribute('data-product-id');
            addToCart(productId);
            
            // Button animation
            e.target.style.transform = 'scale(0.95)';
            setTimeout(() => {
                e.target.style.transform = 'scale(1)';
            }, 150);
        });
    });
}

// Function for CTA button smooth scroll
function scrollToSection(sectionId) {
    if (currentPage !== 'home') {
        showHome();
        setTimeout(() => {
            const targetSection = document.querySelector(`#${sectionId}`);
            if (targetSection) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetSection.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        }, 100);
    } else {
        const targetSection = document.querySelector(`#${sectionId}`);
        if (targetSection) {
            const headerHeight = document.querySelector('.header').offsetHeight;
            const targetPosition = targetSection.offsetTop - headerHeight;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }
}

// Notification system
function showNotification(message, type = 'success') {
    // Remove any existing notifications
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification--${type}`;
    notification.textContent = message;
    
    // Notification styles
    const notificationStyles = `
        position: fixed;
        top: 90px;
        right: 20px;
        padding: 15px 25px;
        background-color: ${type === 'success' ? '#e60000' : '#ff6b6b'};
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 10000;
        font-weight: 500;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    notification.style.cssText = notificationStyles;
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Contact form validation and submission
if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const formData = new FormData(contactForm);
        const name = formData.get('name').trim();
        const email = formData.get('email').trim();
        const message = formData.get('message').trim();
        
        // Basic validation
        if (!name || !email || !message) {
            showNotification('Veuillez remplir tous les champs', 'error');
            return;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showNotification('Veuillez saisir un email valide', 'error');
            return;
        }
        
        // Simulate form submission
        const submitButton = contactForm.querySelector('.form-submit');
        const originalText = submitButton.textContent;
        
        submitButton.textContent = 'Envoi en cours...';
        submitButton.disabled = true;
        
        setTimeout(() => {
            showNotification('Message envoyé avec succès!', 'success');
            contactForm.reset();
            submitButton.textContent = originalText;
            submitButton.disabled = false;
        }, 1500);
    });
}

// Scroll-triggered animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
        }
    });
}, observerOptions);

// Observe sections for animation
function initializeAnimations() {
    const sectionsToAnimate = document.querySelectorAll('.brands, .products, .about, .contact');
    sectionsToAnimate.forEach(section => {
        observer.observe(section);
    });
}

// Navbar background change on scroll
window.addEventListener('scroll', () => {
    const header = document.querySelector('.header');
    if (window.scrollY > 100) {
        header.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
        header.style.backdropFilter = 'blur(10px)';
    } else {
        header.style.backgroundColor = '#fff';
        header.style.backdropFilter = 'none';
    }
});

// Active navigation link highlighting for home page
window.addEventListener('scroll', () => {
    if (currentPage !== 'home') return;
    
    const sections = document.querySelectorAll('#home-page section[id]');
    const scrollPos = window.scrollY + 100;
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        const sectionId = section.getAttribute('id');
        
        if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
            // Remove active class from all nav links
            navLinks.forEach(link => {
                link.classList.remove('active');
            });
            
            // Add active class to current section link
            const activeLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);
            if (activeLink) {
                activeLink.classList.add('active');
            }
        }
    });
});

// Product card hover effects
function initializeProductHoverEffects() {
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
            card.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
        });
    });
}

// Initialize animations on page load
document.addEventListener('DOMContentLoaded', () => {
    // Initialize cart button listeners for home page
    attachCartButtonListeners();
    
    // Initialize animations
    initializeAnimations();
    
    // Initialize hover effects
    initializeProductHoverEffects();
    
    // Add initial animation class to hero section
    const heroContent = document.querySelector('.hero-content');
    if (heroContent) {
        heroContent.style.opacity = '0';
        heroContent.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            heroContent.style.transition = 'opacity 1s ease, transform 1s ease';
            heroContent.style.opacity = '1';
            heroContent.style.transform = 'translateY(0)';
        }, 500);
    }
    
    // Animate brand items on scroll
    const brandItems = document.querySelectorAll('.brand-item');
    brandItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 100 * index);
    });
    
    // Set initial page state
    showHome();
});

// Add active navigation styles
const style = document.createElement('style');
style.textContent = `
    .nav-link.active {
        color: #e60000;
    }
    
    .nav-link.active::after {
        width: 100%;
    }
    
    .notification--error {
        background-color: #ff6b6b !important;
    }
    
    @media (max-width: 768px) {
        .notification {
            right: 15px !important;
            left: 15px !important;
            transform: translateY(-100%) !important;
        }
        
        .notification.show {
            transform: translateY(0) !important;
        }
    }
`;
document.head.appendChild(style);

// Smooth scroll fallback for older browsers
if (!CSS.supports('scroll-behavior', 'smooth')) {
    function smoothScrollTo(target) {
        const startPosition = window.pageYOffset;
        const targetPosition = target;
        const distance = targetPosition - startPosition;
        const duration = 800;
        let start = null;
        
        function animation(currentTime) {
            if (start === null) start = currentTime;
            const timeElapsed = currentTime - start;
            const run = ease(timeElapsed, startPosition, distance, duration);
            window.scrollTo(0, run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        }
        
        function ease(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }
        
        requestAnimationFrame(animation);
    }
    
    // Override smooth scroll functions
    window.scrollTo = function(options) {
        if (typeof options === 'object' && options.behavior === 'smooth') {
            smoothScrollTo(options.top || 0);
        } else {
            window.scroll.apply(window, arguments);
        }
    };
}

// Export functions to global scope for inline event handlers
window.showHome = showHome;
window.showProductsCatalog = showProductsCatalog;
window.showCart = showCart;
window.addToCart = addToCart;
window.removeFromCart = removeFromCart;
window.updateQuantity = updateQuantity;
window.checkout = checkout;
window.scrollToSection = scrollToSection;