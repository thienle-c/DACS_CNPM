/* =============================================
   THEGIOIDIDONG CLONE - MAIN JS
   ============================================= */

// === PRODUCT DATA ===
const products = {
  phones: [
    {
      id: 1, name: 'iPhone 16 Pro Max 256GB', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/i/p/iphone-16-pro-max_15.png',
      price: 34990000, originalPrice: 39990000, discount: 13, rating: 4.9, reviews: 2841,
      tags: ['Mới', 'Trả góp 0%'], specs: ['Chip A18 Pro', 'Camera 48MP', '6.9"']
    },
    {
      id: 2, name: 'Samsung Galaxy S25 Ultra 12GB/256GB', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/s/a/samsung-galaxy-s25-ultra_1_1.png',
      price: 31990000, originalPrice: 39990000, discount: 20, rating: 4.8, reviews: 1532,
      tags: ['Hot', 'Mới'], specs: ['Snapdragon 8 Elite', 'Camera 200MP', '6.9"']
    },
    {
      id: 3, name: 'Xiaomi Redmi Note 14 Pro 8GB/256GB', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/x/i/xiaomi-redmi-note-14-pro.png',
      price: 8490000, originalPrice: 10990000, discount: 23, rating: 4.7, reviews: 876,
      tags: ['Bán chạy'], specs: ['Dimensity 7300', 'Camera 200MP', '6.67"']
    },
    {
      id: 4, name: 'OPPO Reno 13 F 5G 8GB/256GB', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/o/p/oppo-reno13-f_2.png',
      price: 7490000, originalPrice: 9490000, discount: 21, rating: 4.6, reviews: 634,
      tags: ['Mới'], specs: ['Dimensity 6300', 'Camera 50MP', '6.67"']
    },
    {
      id: 5, name: 'vivo Y39 5G 8GB/256GB', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/v/i/vivo-y39-5g_2.png',
      price: 5990000, originalPrice: 8490000, discount: 29, rating: 4.5, reviews: 412,
      tags: ['Giảm sốc'], specs: ['Snapdragon 4s Gen 2', 'Camera 50MP', '6.77"']
    }
  ],
  laptops: [
    {
      id: 6, name: 'MacBook Air 13 M4 16GB/256GB', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/m/a/macbook-air-m3-sky-blue.png',
      price: 27990000, originalPrice: 32990000, discount: 15, rating: 4.9, reviews: 1243,
      tags: ['Mới 2025', 'Hot'], specs: ['Chip M4', '16GB RAM', '13.6"']
    },
    {
      id: 7, name: 'ASUS Vivobook S 14 Ultra 7 258V', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/a/s/asus-vivobook-s-14-2024_32.png',
      price: 25990000, originalPrice: 31990000, discount: 19, rating: 4.7, reviews: 321,
      tags: ['AI PC', 'Mới'], specs: ['Ultra 7 258V', '16GB RAM', '14"']
    },
    {
      id: 8, name: 'HP 15 fd1063TU Ultra 5 125H', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/h/p/hp-15-fd1063tu-_1.jpg',
      price: 17990000, originalPrice: 21990000, discount: 18, rating: 4.6, reviews: 567,
      tags: ['Bán chạy'], specs: ['Ultra 5 125H', '16GB RAM', '15.6"']
    },
    {
      id: 9, name: 'Acer Nitro V i5 13420H', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/a/c/acer-nitro-v-anv15-51-57b2.png',
      price: 15990000, originalPrice: 19990000, discount: 20, rating: 4.5, reviews: 892,
      tags: ['Gaming'], specs: ['RTX 4050', '16GB RAM', '15.6"']
    }
  ],
  tablets: [
    {
      id: 10, name: 'iPad Air 13 M3 WiFi 128GB', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/i/p/ipad-air-13-m2-_2.png',
      price: 22990000, originalPrice: 28990000, discount: 21, rating: 4.9, reviews: 743,
      tags: ['Mới 2025'], specs: ['Chip M3', '13"', 'WiFi 6E']
    },
    {
      id: 11, name: 'Samsung Galaxy Tab S10 FE 6/128GB', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/s/a/samsung-galaxy-tab-s10-fe.png',
      price: 10490000, originalPrice: 13990000, discount: 25, rating: 4.7, reviews: 456,
      tags: ['Bán chạy'], specs: ['Exynos 1580', '10.9"', 'S Pen']
    }
  ]
};

const flashSaleProducts = [
  {
    id: 'f1', name: 'Tai nghe TWS Earfun Air Pro 4', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/e/a/earfun-air-pro-4.png',
    price: 1390000, originalPrice: 2490000, discount: 44, sold: 78
  },
  {
    id: 'f2', name: 'Chuột Bluetooth Philips SPK7448', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/p/h/philips-spk7448.png',
    price: 390000, originalPrice: 750000, discount: 48, sold: 92
  },
  {
    id: 'f3', name: 'Loa Bluetooth Xiaomi Sound Pocket', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/x/i/xiaomi-sound-pocket_2.png',
    price: 590000, originalPrice: 990000, discount: 40, sold: 65
  },
  {
    id: 'f4', name: 'Sạc dự phòng Anker MagGo 27W', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/a/n/anker-maggo-27w-a1654.png',
    price: 890000, originalPrice: 1490000, discount: 40, sold: 55
  },
  {
    id: 'f5', name: 'Bộ bàn phím chuột MicroPack KM-205W', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/m/i/micropack-km-205w.png',
    price: 490000, originalPrice: 890000, discount: 45, sold: 83
  },
  {
    id: 'f6', name: 'Amazfit Active 2 dây silicone', image: 'https://cdn2.cellphones.com.vn/x358,webp/media/catalog/product/a/m/amazfit-active-2.png',
    price: 2490000, originalPrice: 3990000, discount: 38, sold: 71
  }
];

// === CART STATE ===
let cart = JSON.parse(localStorage.getItem('tgdd_cart') || '[]');

// === HELPERS ===
function formatPrice(price) {
  return new Intl.NumberFormat('vi-VN').format(price) + '₫';
}

function showToast(message, icon = '✅') {
  const toast = document.getElementById('toast');
  toast.innerHTML = `<span class="toast-icon">${icon}</span><span>${message}</span>`;
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 3000);
}

function saveCart() {
  localStorage.setItem('tgdd_cart', JSON.stringify(cart));
  updateCartCount();
  renderCartItems();
}

function updateCartCount() {
  const count = cart.reduce((sum, item) => sum + item.qty, 0);
  document.querySelectorAll('.cart-count').forEach(el => {
    el.textContent = count;
    el.style.display = count > 0 ? 'flex' : 'none';
  });
}

function addToCart(product) {
  const existing = cart.find(item => item.id === product.id);
  if (existing) {
    existing.qty++;
  } else {
    cart.push({ ...product, qty: 1 });
  }
  saveCart();
  showToast(`Đã thêm "${product.name.substring(0, 35)}..." vào giỏ hàng!`, '🛒');
}

function renderCartItems() {
  const container = document.getElementById('cart-items-container');
  const totalEl = document.getElementById('cart-total-price');
  const emptyEl = document.getElementById('cart-empty');
  const footerEl = document.querySelector('.cart-footer');

  if (!container) return;

  if (cart.length === 0) {
    container.innerHTML = '';
    emptyEl && (emptyEl.style.display = 'flex');
    footerEl && (footerEl.style.display = 'none');
    return;
  }

  emptyEl && (emptyEl.style.display = 'none');
  footerEl && (footerEl.style.display = 'block');

  container.innerHTML = cart.map(item => `
    <div class="cart-item" data-id="${item.id}">
      <img src="${item.image || 'https://via.placeholder.com/70'}" alt="${item.name}" onerror="this.src='https://via.placeholder.com/70?text=IMG'">
      <div class="cart-item-info">
        <div class="cart-item-name">${item.name}</div>
        <div class="cart-item-price">${formatPrice(item.price)}</div>
        <div class="cart-item-qty">
          <button class="qty-btn" onclick="changeQty('${item.id}', -1)">−</button>
          <span class="qty-num">${item.qty}</span>
          <button class="qty-btn" onclick="changeQty('${item.id}', 1)">+</button>
        </div>
      </div>
      <span class="cart-remove" onclick="removeFromCart('${item.id}')">✕</span>
    </div>
  `).join('');

  const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
  if (totalEl) totalEl.textContent = formatPrice(total);
}

function changeQty(id, delta) {
  const item = cart.find(i => i.id == id);
  if (!item) return;
  item.qty += delta;
  if (item.qty <= 0) {
    cart = cart.filter(i => i.id != id);
  }
  saveCart();
}

function removeFromCart(id) {
  cart = cart.filter(i => i.id != id);
  saveCart();
  showToast('Đã xóa sản phẩm khỏi giỏ hàng', '🗑️');
}

// === SLIDER ===
let currentSlide = 0;
let sliderInterval;

const slides = [
  {
    title: 'iPhone 16 Pro Max',
    subtitle: 'Siêu Camera 48MP • A18 Pro',
    desc: 'Giảm đến 5 triệu đồng + Tặng Apple Watch SE',
    badge: 'Mới ra mắt',
    gradient: 'linear-gradient(135deg, #1a1a2e, #16213e, #0f3460)',
    imageUrl: 'images/hero_banner.png'
  },
  {
    title: 'Samsung Galaxy S25 Ultra',
    subtitle: 'Galaxy AI • Snapdragon 8 Elite',
    desc: 'Trả góp 0% • Giảm đến 8 triệu đồng',
    badge: 'Bán chạy nhất',
    gradient: 'linear-gradient(135deg, #0d0d0d, #1a1a3e, #090949)',
    imageUrl: 'images/smartphones_collection.png'
  },
  {
    title: 'Laptop Gaming',
    subtitle: 'Hiệu năng đỉnh cao • RTX 4060',
    desc: 'Trả góp 0% lãi suất • Giao ngay trong ngày',
    badge: 'HOT 2025',
    gradient: 'linear-gradient(135deg, #0f2027, #203a43, #2c5364)',
    imageUrl: 'images/laptop_banner.png'
  }
];

function renderSlider() {
  const sliderEl = document.getElementById('main-slider');
  if (!sliderEl) return;

  sliderEl.innerHTML = slides.map((slide, i) => `
    <div class="slide" style="background: ${slide.gradient}">
      <div class="slide-content">
        <div class="badge badge-red" style="margin-bottom:10px">${slide.badge}</div>
        <h2>${slide.title}<br><span style="font-size:16px;font-weight:500;opacity:0.85">${slide.subtitle}</span></h2>
        <p>${slide.desc}</p>
        <a href="#" class="btn-slide">Mua ngay →</a>
      </div>
      <img src="${slide.imageUrl}" alt="${slide.title}" style="position:absolute;right:30px;bottom:0;height:95%;object-fit:contain;max-width:55%" onerror="this.style.display='none'">
    </div>
  `).join('');

  const dotsEl = document.getElementById('slider-dots');
  dotsEl.innerHTML = slides.map((_, i) => `
    <div class="slider-dot ${i === 0 ? 'active' : ''}" onclick="goToSlide(${i})"></div>
  `).join('');

  startSlider();
}

function goToSlide(n) {
  currentSlide = n;
  const sliderEl = document.getElementById('main-slider');
  if (sliderEl) sliderEl.style.transform = `translateX(-${n * 100}%)`;
  document.querySelectorAll('.slider-dot').forEach((dot, i) => {
    dot.classList.toggle('active', i === n);
  });
}

function startSlider() {
  clearInterval(sliderInterval);
  sliderInterval = setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    goToSlide(currentSlide);
  }, 4500);
}

window.prevSlide = function() {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  goToSlide(currentSlide);
  startSlider();
};

window.nextSlide = function() {
  currentSlide = (currentSlide + 1) % slides.length;
  goToSlide(currentSlide);
  startSlider();
};

window.goToSlide = goToSlide;

// === RENDER PRODUCTS ===
function renderProducts(containerId, productList, max = 10) {
  const container = document.getElementById(containerId);
  if (!container) return;

  container.innerHTML = productList.slice(0, max).map(p => `
    <div class="product-card animate-in" onclick="openProduct(${p.id})">
      <div class="product-card-badge">
        ${p.tags.map(tag => `<span class="badge badge-${tag === 'Mới' || tag === 'Mới 2025' ? 'blue' : tag === 'Hot' || tag === 'Bán chạy' ? 'orange' : 'red'}">${tag}</span>`).join('')}
      </div>
      <div class="product-card-wishlist" onclick="event.stopPropagation(); toggleWishlist(${p.id}, this)">♡</div>
      <div class="product-image-wrapper">
        <img src="${p.image}" alt="${p.name}" onerror="this.src='https://via.placeholder.com/140?text=📱'" loading="lazy">
      </div>
      <div class="product-info">
        <div class="product-name">${p.name}</div>
        <div class="product-price-wrapper">
          <span class="price-new">${formatPrice(p.price)}</span>
          <span class="price-original">${formatPrice(p.originalPrice)}</span>
          <span class="discount-tag">-${p.discount}%</span>
        </div>
        <div class="product-specs">
          ${p.specs.map(s => `<span class="product-spec">${s}</span>`).join('')}
        </div>
        <div class="product-rating">
          <span class="stars">★★★★★</span>
          <span class="rating-count">(${p.reviews.toLocaleString()})</span>
        </div>
      </div>
      <button class="btn-buy" onclick="event.stopPropagation(); addToCart(${JSON.stringify(p).replace(/"/g, '&quot;')})">
        🛒 Thêm vào giỏ
      </button>
    </div>
  `).join('');
}

function renderFlashSale() {
  const container = document.getElementById('flash-sale-products');
  if (!container) return;

  container.innerHTML = flashSaleProducts.map(p => `
    <div class="flash-product-card" onclick="handleFlashAddToCart(${JSON.stringify(p).replace(/"/g, '&quot;')})">
      <div class="flash-sale-badge">-${p.discount}%</div>
      <img class="flash-product-img" src="${p.image}" alt="${p.name}" onerror="this.src='https://via.placeholder.com/120?text=🔌'" loading="lazy">
      <div class="product-name" style="font-size:12px;margin-bottom:6px">${p.name}</div>
      <div class="price-new" style="font-size:14px">${formatPrice(p.price)}</div>
      <div class="price-original">${formatPrice(p.originalPrice)}</div>
      <div class="sold-bar">
        <div class="sold-fill" style="width:${p.sold}%"></div>
      </div>
      <div class="sold-text">Đã bán ${p.sold}%</div>
    </div>
  `).join('');
}

window.handleFlashAddToCart = function(p) {
  addToCart({ id: p.id, name: p.name, price: p.price, image: p.image });
};

// === TABS ===
window.switchTab = function(tabGroup, value, btn) {
  document.querySelectorAll(`[data-tab-group="${tabGroup}"]`).forEach(t => t.classList.remove('active'));
  btn.classList.add('active');

  if (tabGroup === 'phones') {
    renderProducts('phones-grid', sortProducts(products.phones, value));
  }
};

function sortProducts(productList, sort) {
  const list = [...productList];
  if (sort === 'popular') return list.sort((a, b) => b.reviews - a.reviews);
  if (sort === 'price_asc') return list.sort((a, b) => a.price - b.price);
  if (sort === 'price_desc') return list.sort((a, b) => b.price - a.price);
  if (sort === 'discount') return list.sort((a, b) => b.discount - a.discount);
  return list;
}

// === CART SIDEBAR ===
window.openCart = function() {
  document.getElementById('cart-sidebar').classList.add('open');
  document.getElementById('cart-overlay').classList.add('open');
  document.body.style.overflow = 'hidden';
};

window.closeCart = function() {
  document.getElementById('cart-sidebar').classList.remove('open');
  document.getElementById('cart-overlay').classList.remove('open');
  document.body.style.overflow = '';
};

window.changeQty = changeQty;
window.removeFromCart = removeFromCart;

// === WISHLIST ===
let wishlist = JSON.parse(localStorage.getItem('tgdd_wishlist') || '[]');

window.toggleWishlist = function(id, btn) {
  const idx = wishlist.indexOf(id);
  if (idx > -1) {
    wishlist.splice(idx, 1);
    btn.textContent = '♡';
    btn.style.color = '';
  } else {
    wishlist.push(id);
    btn.textContent = '❤️';
    btn.style.color = 'var(--primary)';
    showToast('Đã thêm vào danh sách yêu thích!', '❤️');
  }
  localStorage.setItem('tgdd_wishlist', JSON.stringify(wishlist));
};

// === SEARCH ===
function setupSearch() {
  const input = document.getElementById('search-input');
  const suggestions = document.getElementById('search-suggestions');
  if (!input) return;

  const searchItems = [
    'iPhone 16 Pro Max', 'Samsung Galaxy S25 Ultra', 'iPad Air M3',
    'MacBook Air M4', 'Xiaomi Redmi Note 14', 'OPPO Reno 13',
    'Tai nghe AirPods Pro 2', 'Apple Watch Series 10', 'Laptop Gaming',
    'Pin dự phòng Anker', 'Loa Bluetooth JBL', 'Chuột không dây Logitech'
  ];

  input.addEventListener('input', function() {
    const query = this.value.trim().toLowerCase();
    if (!query) {
      suggestions.classList.remove('active');
      return;
    }
    const filtered = searchItems.filter(item => item.toLowerCase().includes(query)).slice(0, 6);
    if (filtered.length === 0) {
      suggestions.classList.remove('active');
      return;
    }
    suggestions.innerHTML = filtered.map(item => `
      <div class="suggestion-item" onclick="doSearch('${item}')">
        <span class="suggestion-icon">🔍</span>
        <span>${item}</span>
      </div>
    `).join('');
    suggestions.classList.add('active');
  });

  document.addEventListener('click', (e) => {
    if (!e.target.closest('.search-bar')) {
      suggestions.classList.remove('active');
    }
  });

  input.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && this.value.trim()) {
      doSearch(this.value.trim());
    }
  });
}

window.doSearch = function(query) {
  showToast(`Đang tìm kiếm: "${query}"`, '🔍');
  document.getElementById('search-input').value = query;
  document.getElementById('search-suggestions').classList.remove('active');
};

// === OPEN PRODUCT ===
window.openProduct = function(id) {
  window.location.href = `product.html?id=${id}`;
};

// === COUNTDOWN TIMER ===
function updateCountdown() {
  const now = new Date();
  const end = new Date();
  end.setHours(23, 59, 59, 0);
  let diff = Math.max(0, Math.floor((end - now) / 1000));

  const h = String(Math.floor(diff / 3600)).padStart(2, '0');
  diff %= 3600;
  const m = String(Math.floor(diff / 60)).padStart(2, '0');
  const s = String(diff % 60).padStart(2, '0');

  const el = document.getElementById('countdown-timer');
  if (el) {
    el.querySelector('[data-unit="h"]').textContent = h;
    el.querySelector('[data-unit="m"]').textContent = m;
    el.querySelector('[data-unit="s"]').textContent = s;
  }
}

// === BACK TO TOP ===
function setupBackToTop() {
  const btn = document.getElementById('back-to-top');
  if (!btn) return;
  window.addEventListener('scroll', () => {
    btn.classList.toggle('visible', window.scrollY > 400);
  });
  btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

// === SCROLL REVEAL ===
function setupScrollReveal() {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

  document.querySelectorAll('.section').forEach(section => {
    section.style.opacity = '0';
    section.style.transform = 'translateY(20px)';
    section.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    observer.observe(section);
  });
}

// === STICKY HEADER ===
function setupStickyHeader() {
  const header = document.querySelector('.main-header');
  let lastScrollY = window.scrollY;

  window.addEventListener('scroll', () => {
    const currentScrollY = window.scrollY;
    if (currentScrollY > lastScrollY && currentScrollY > 100) {
      header.style.transform = 'translateY(-100%)';
    } else {
      header.style.transform = 'translateY(0)';
    }
    lastScrollY = currentScrollY;
  }, { passive: true });
}

// === INIT ===
document.addEventListener('DOMContentLoaded', function() {
  renderSlider();
  renderFlashSale();
  renderProducts('phones-grid', products.phones);
  renderProducts('laptops-grid', products.laptops);

  setupSearch();
  setupBackToTop();
  setupScrollReveal();

  updateCartCount();
  renderCartItems();

  setInterval(updateCountdown, 1000);
  updateCountdown();

  console.log('🛒 Website khởi động thành công!');
});
