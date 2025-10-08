<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Catalogue Produits - Auto Pièces R.M</title>
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
  <style>
    /* Page scaffolding aligned to your design system */
    .page-container { max-width: 1280px; margin: 0 auto; padding: 120px 20px 64px; }
    .page-header { text-align: center; margin-bottom: 32px; }
    .page-title { font-size: var(--font-size-4xl); font-weight: var(--font-weight-bold); color: var(--color-text); }
    .page-subtitle { color: var(--color-text-secondary); margin-top: 8px; }

    /* Filters */
    .filters-bar { display: grid; grid-template-columns: 1fr auto; gap: 16px; align-items: center; margin: 32px 0 24px; }
    .search-input { width: 100%; padding: 12px 16px; border: 1px solid var(--color-border); border-radius: var(--radius-base); background: var(--color-background); color: var(--color-text); }
    .search-input:focus { outline: none; border-color: var(--color-primary); box-shadow: var(--focus-ring); }
    .filters-actions { display: flex; gap: 10px; flex-wrap: wrap; }
    .select { padding: 12px 16px; border: 1px solid var(--color-border); border-radius: var(--radius-base); background: var(--color-surface); color: var(--color-text); appearance: none; background-image: var(--select-caret); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; min-width: 180px; }

    /* Product Card */
    .products-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
    .product-card { background: var(--color-surface); border: 1px solid var(--color-card-border); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; transition: transform var(--duration-fast) var(--ease-standard), box-shadow var(--duration-fast) var(--ease-standard); }
    .product-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
    .product-media { position: relative; background: var(--color-secondary); aspect-ratio: 4/3; display: flex; align-items: center; justify-content: center; }
    .product-media img { width: 100%; height: 100%; object-fit: cover; }
    .badge { position: absolute; top: 12px; left: 12px; background: rgba(var(--color-teal-500-rgb), 0.15); color: var(--color-primary); padding: 6px 10px; border-radius: var(--radius-full); font-size: var(--font-size-sm); font-weight: var(--font-weight-semibold); }
    .product-body { padding: 16px; display: grid; gap: 8px; }
    .product-title { font-weight: var(--font-weight-semibold); color: var(--color-text); }
    .product-meta { color: var(--color-text-secondary); font-size: var(--font-size-sm); }
    .product-price { font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-top: 8px; }
    .product-actions { display: grid; grid-template-columns: 1fr auto; gap: 10px; margin-top: 12px; }
    .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 14px; border-radius: var(--radius-base); border: 1px solid var(--color-border); background: var(--color-secondary); color: var(--color-text); text-decoration: none; cursor: pointer; font-weight: var(--font-weight-semibold); transition: all var(--duration-fast) var(--ease-standard); }
    .btn:hover { background: var(--color-secondary-hover); }
    .btn-primary { background: var(--color-primary); color: var(--color-btn-primary-text); border: none; }
    .btn-primary:hover { background: var(--color-primary-hover); }

    /* Pagination */
    .pagination { display: flex; justify-content: center; gap: 8px; margin-top: 28px; }
    .page-btn { padding: 10px 14px; border: 1px solid var(--color-border); background: var(--color-surface); color: var(--color-text); border-radius: var(--radius-base); cursor: pointer; }
    .page-btn.active { border-color: var(--color-primary); color: var(--color-primary); }

    @media (max-width: 1200px) { .products-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 900px) { .products-grid { grid-template-columns: repeat(2, 1fr); } .filters-bar { grid-template-columns: 1fr; } }
    @media (max-width: 560px) { .products-grid { grid-template-columns: 1fr; } .page-title { font-size: var(--font-size-3xl); } }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="header">
    <div class="nav-container">
      <div class="logo">
        <div class="logo-placeholder">RM</div>
        <span class="logo-text">Auto Pièces R.M</span>
      </div>
      <nav class="nav-menu">
        <a href="index.html" class="nav-link">Accueil</a>
        <a href="products-standalone.html" class="nav-link active">Catalogue</a>
        <a href="#" class="nav-link">À propos</a>
        <a href="#" class="nav-link">Contact</a>
      </nav>
      <div class="nav-actions">
        <a href="cart-page.html" class="cart-link">
          <div class="cart-icon">🛒</div>
          <span class="cart-count" id="cartCount">0</span>
        </a>
        <button class="hamburger"><span></span><span></span><span></span></button>
      </div>
    </div>
  </header>

  <main class="page-container">
    <div class="page-header">
      <h1 class="page-title">Catalogue des produits</h1>
      <p class="page-subtitle">Pièces pour Peugeot, Renault, Citroën et Dacia</p>
    </div>

    <div class="filters-bar">
      <input type="text" class="search-input" id="searchInput" placeholder="Rechercher une pièce (ex: plaquettes, filtre, pneus)">
      <div class="filters-actions">
        <select class="select" id="categorySelect">
          <option value="all">Toutes les catégories</option>
          <option value="Freinage">Freinage</option>
          <option value="Moteur">Moteur</option>
          <option value="Éclairage">Éclairage</option>
          <option value="Pneumatiques">Pneumatiques</option>
        </select>
        <select class="select" id="sortSelect">
          <option value="popular">Populaires</option>
          <option value="price-asc">Prix: du plus bas au plus élevé</option>
          <option value="price-desc">Prix: du plus élevé au plus bas</option>
          <option value="name-asc">Nom: A → Z</option>
          <option value="name-desc">Nom: Z → A</option>
        </select>
      </div>
    </div>

    <section id="productsGrid" class="products-grid"></section>

    <div class="pagination" id="pagination"></div>
  </main>

  <script>
    // Product data (kept consistent with your app.js structure)
    const ALL_PRODUCTS = [
      { id: 1, name: "Plaquettes de frein Peugeot", category: "Freinage", price: 45.99, image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=640&h=480&fit=crop&crop=center" },
      { id: 2, name: "Disques de frein Renault", category: "Freinage", price: 89.50, image: "https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=640&h=480&fit=crop&crop=center" },
      { id: 3, name: "Étriers de frein Citroën", category: "Freinage", price: 125.00, image: "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=640&h=480&fit=crop&crop=center" },
      { id: 4, name: "Filtre à huile", category: "Moteur", price: 12.50, image: "https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=640&h=480&fit=crop&crop=center" },
      { id: 5, name: "Courroie de distribution", category: "Moteur", price: 67.80, image: "https://images.unsplash.com/photo-1609630875171-b1321377ee65?w=640&h=480&fit=crop&crop=center" },
      { id: 6, name: "Bougies d'allumage", category: "Moteur", price: 28.90, image: "https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=640&h=480&fit=crop&crop=center" },
      { id: 7, name: "Phares LED", category: "Éclairage", price: 125.00, image: "https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=640&h=480&fit=crop&crop=center" },
      { id: 8, name: "Ampoules H7", category: "Éclairage", price: 15.99, image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=640&h=480&fit=crop&crop=center" },
      { id: 9, name: "Feux arrière", category: "Éclairage", price: 85.00, image: "https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=640&h=480&fit=crop&crop=center" },
      { id: 10, name: "Pneus été", category: "Pneumatiques", price: 199.99, image: "https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=640&h=480&fit=crop&crop=center" },
      { id: 11, name: "Pneus hiver", category: "Pneumatiques", price: 219.99, image: "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=640&h=480&fit=crop&crop=center" },
      { id: 12, name: "Amortisseurs", category: "Moteur", price: 89.99, image: "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=640&h=480&fit=crop&crop=center" }
    ];

    // Simple cart count (in-memory). Replace with localStorage if needed.
    const CART = [];

    const state = { query: '', category: 'all', sort: 'popular', page: 1, perPage: 8 };

    function formatPrice(n) { return n.toFixed(2).replace('.', ',') + ' €'; }

    function applyFilters(data) {
      let out = data.filter(p => state.category === 'all' || p.category === state.category);
      if (state.query) {
        const q = state.query.toLowerCase();
        out = out.filter(p => p.name.toLowerCase().includes(q));
      }
      switch (state.sort) {
        case 'price-asc': out.sort((a,b) => a.price - b.price); break;
        case 'price-desc': out.sort((a,b) => b.price - a.price); break;
        case 'name-asc': out.sort((a,b) => a.name.localeCompare(b.name, 'fr')); break;
        case 'name-desc': out.sort((a,b) => b.name.localeCompare(a.name, 'fr')); break;
      }
      return out;
    }

    function paginate(data) {
      const start = (state.page - 1) * state.perPage;
      return data.slice(start, start + state.perPage);
    }

    function renderProducts() {
      const grid = document.getElementById('productsGrid');
      const filtered = applyFilters(ALL_PRODUCTS);
      const paged = paginate(filtered);
      grid.innerHTML = paged.map(p => `
        <article class="product-card">
          <div class="product-media">
            <img src="${p.image}" alt="${p.name}">
            <span class="badge">${p.category}</span>
          </div>
          <div class="product-body">
            <h3 class="product-title">${p.name}</h3>
            <div class="product-meta">Réf: ${String(p.id).padStart(5, '0')}</div>
            <div class="product-price">${formatPrice(p.price)}</div>
            <div class="product-actions">
              <a class="btn" href="product-${p.id}.html">Détails</a>
              <button class="btn btn-primary" onclick='addToCart(${JSON.stringify(p)})'>Ajouter</button>
            </div>
          </div>
        </article>
      `).join('');

      renderPagination(filtered.length);
    }

    function renderPagination(total) {
      const pages = Math.ceil(total / state.perPage) || 1;
      const el = document.getElementById('pagination');
      el.innerHTML = Array.from({length: pages}, (_, i) => i+1).map(n => `
        <button class="page-btn ${n === state.page ? 'active' : ''}" onclick="goToPage(${n})">${n}</button>
      `).join('');
    }

    function goToPage(n) { state.page = n; renderProducts(); window.scrollTo({ top: 0, behavior: 'smooth' }); }

    // Cart
    function addToCart(p) {
      const existing = CART.find(i => i.id === p.id);
      if (existing) existing.qty += 1; else CART.push({ ...p, qty: 1 });
      updateCartCount();
    }

    function updateCartCount() {
      const count = CART.reduce((s, i) => s + i.qty, 0);
      document.getElementById('cartCount').textContent = count;
    }

    // Events
    document.getElementById('searchInput').addEventListener('input', (e) => { state.query = e.target.value.trim(); state.page = 1; renderProducts(); });
    document.getElementById('categorySelect').addEventListener('change', (e) => { state.category = e.target.value; state.page = 1; renderProducts(); });
    document.getElementById('sortSelect').addEventListener('change', (e) => { state.sort = e.target.value; state.page = 1; renderProducts(); });

    // Mobile menu
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    hamburger.addEventListener('click', () => { hamburger.classList.toggle('active'); navMenu.classList.toggle('active'); });

    // Init
    renderProducts();
    updateCartCount();
  </script>
</body>
</html>
