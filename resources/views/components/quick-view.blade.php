
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
        gallery: img.dataset.images ? JSON.parse(img.dataset.images) : [],
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