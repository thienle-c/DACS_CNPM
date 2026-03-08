<!-- HERO SECTION -->
<section class="hero-section">
<div class="container">
    <div class="hero-inner">
    <!-- Main Slider -->
    <div class="slider-wrapper">
        <div class="slider" id="main-slider">
            <div class="slide" style="background: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460)">
                <div class="slide-content">
                    <div class="badge badge-red mb-2">Mới ra mắt</div>
                    <h2>iPhone 16 Pro Max<br><span style="font-size:16px;font-weight:500;opacity:0.85">Siêu Camera 48MP • A18 Pro</span></h2>
                    <p>Giảm đến 5 triệu đồng + Tặng Apple Watch SE</p>
                    <a href="<?= URLROOT ?>/product/detail/1" class="btn-slide">Mua ngay →</a>
                </div>
                <img src="<?= URLROOT ?>/assets/images/hero_banner.png" alt="iPhone 16 Pro Max" style="position:absolute;right:30px;bottom:0;height:95%;object-fit:contain;max-width:55%">
            </div>
            <!-- More slides can be generated via JS or PHP loop -->
        </div>
    </div>

    <!-- Side Banners -->
    <div class="hero-side">
        <a href="<?= URLROOT ?>/product" class="side-banner d-block h-100">
            <img src="<?= URLROOT ?>/assets/images/flash_sale_banner.png" alt="Flash Sale" class="w-100 h-100" style="object-fit:cover;">
        </a>
    </div>
    </div>
</div>
</section>

<!-- CATEGORIES -->
<section class="section">
<div class="container">
    <div class="categories-grid">
    <?php foreach($data['categories'] as $category): ?>
        <a href="<?= URLROOT ?>/product/category/<?= $category->slug ?>" class="category-item text-decoration-none">
            <div class="category-icon"><?= $category->icon ?: '📱' ?></div>
            <div class="category-name"><?= $category->name ?></div>
        </a>
    <?php endforeach; ?>
    </div>
</div>
</section>

<!-- FLASH SALE -->
<?php if(!empty($data['flash_sale'])) : ?>
<section class="section">
<div class="container">
    <div class="flash-sale-section">
    <div class="flash-sale-header">
        <div class="flash-sale-title">
        <span class="flash-icon">⚡</span>
        <h2>FLASH SALE</h2>
        </div>
        <div class="countdown" id="countdown-timer">
        <span class="countdown-label">Kết thúc sau:</span>
        <div class="countdown-unit"><span data-unit="h">00</span></div>
        <span class="countdown-sep">:</span>
        <div class="countdown-unit"><span data-unit="m">00</span></div>
        <span class="countdown-sep">:</span>
        <div class="countdown-unit"><span data-unit="s">00</span></div>
        </div>
    </div>
    <div class="flash-products">
        <?php foreach($data['flash_sale'] as $product): ?>
        <?php $discount = $product->sale_price ? round((($product->price - $product->sale_price) / $product->price) * 100) : 0; ?>
        <a href="<?= URLROOT ?>/product/detail/<?= $product->id ?>" class="flash-product-card text-decoration-none">
            <?php if($discount > 0): ?>
                <div class="flash-sale-badge">-<?= $discount ?>%</div>
            <?php endif; ?>
            <img class="flash-product-img" src="<?= strpos($product->image, 'http') === 0 ? $product->image : URLROOT . '/assets/images/' . $product->image ?>" alt="<?= $product->name ?>">
            <div class="product-name" style="font-size:12px;margin-bottom:6px"><?= $product->name ?></div>
            <div class="price-new" style="font-size:14px"><?= number_format($product->sale_price ?: $product->price, 0, ',', '.') ?>₫</div>
            <?php if($product->sale_price): ?>
                <div class="price-original"><?= number_format($product->price, 0, ',', '.') ?>₫</div>
            <?php endif; ?>
        </a>
        <?php endforeach; ?>
    </div>
    </div>
</div>
</section>
<?php endif; ?>

<!-- FEATURED PHONES -->
<?php if(!empty($data['phones'])): ?>
<section class="section">
<div class="container">
    <div class="section-header">
        <h2 class="section-title">📱 Điện thoại nổi bật</h2>
        <a href="<?= URLROOT ?>/product/category/dien-thoai" class="section-link">Xem tất cả →</a>
    </div>
    <div class="products-grid">
        <?php foreach($data['phones'] as $product): ?>
            <?php 
                $price = $product->sale_price ? $product->sale_price : $product->price;
                $original = $product->sale_price ? $product->price : null;
                $discount = $original ? round((($original - $price) / $original) * 100) : 0;
            ?>
            <div class="product-card" onclick="window.location.href='<?= URLROOT ?>/product/detail/<?= $product->id ?>'">
                <div class="product-card-badge">
                    <?php if($product->tags): ?>
                        <?php foreach(explode(',', $product->tags) as $tag): ?>
                            <span class="badge <?= $tag === 'Mới' || $tag === 'Mới 2025' ? 'badge-blue' : 'badge-red' ?>"><?= trim($tag) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="product-image-wrapper">
                    <img src="<?= strpos($product->image, 'http') === 0 ? $product->image : URLROOT . '/assets/images/' . $product->image ?>" alt="<?= $product->name ?>">
                </div>
                <div class="product-info">
                    <div class="product-name"><?= $product->name ?></div>
                    <div class="product-price-wrapper">
                        <span class="price-new"><?= number_format($price, 0, ',', '.') ?>₫</span>
                        <?php if($original): ?>
                            <span class="price-original"><?= number_format($original, 0, ',', '.') ?>₫</span>
                            <span class="discount-tag">-<?= $discount ?>%</span>
                        <?php endif; ?>
                    </div>
                </div>
                <form action="<?= URLROOT ?>/cart/add" method="POST" onclick="event.stopPropagation()">
                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-buy border-0 w-100">🛒 Thêm vào giỏ</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</section>
<?php endif; ?>

<!-- FEATURED LAPTOPS -->
<?php if(!empty($data['laptops'])): ?>
<section class="section">
<div class="container">
    <div class="section-header">
        <h2 class="section-title">💻 Laptop nổi bật</h2>
        <a href="<?= URLROOT ?>/product/category/laptop" class="section-link">Xem tất cả →</a>
    </div>
    <div class="products-grid products-grid-4">
        <?php foreach($data['laptops'] as $product): ?>
            <?php 
                $price = $product->sale_price ? $product->sale_price : $product->price;
                $original = $product->sale_price ? $product->price : null;
                $discount = $original ? round((($original - $price) / $original) * 100) : 0;
            ?>
            <div class="product-card" onclick="window.location.href='<?= URLROOT ?>/product/detail/<?= $product->id ?>'">
                <div class="product-card-badge">
                    <?php if($product->tags): ?>
                        <?php foreach(explode(',', $product->tags) as $tag): ?>
                            <span class="badge <?= $tag === 'Mới' || $tag === 'Mới 2025' ? 'badge-blue' : 'badge-red' ?>"><?= trim($tag) ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="product-image-wrapper">
                    <img src="<?= strpos($product->image, 'http') === 0 ? $product->image : URLROOT . '/assets/images/' . $product->image ?>" alt="<?= $product->name ?>">
                </div>
                <div class="product-info">
                    <div class="product-name"><?= $product->name ?></div>
                    <div class="product-price-wrapper">
                        <span class="price-new"><?= number_format($price, 0, ',', '.') ?>₫</span>
                        <?php if($original): ?>
                            <span class="price-original"><?= number_format($original, 0, ',', '.') ?>₫</span>
                            <span class="discount-tag">-<?= $discount ?>%</span>
                        <?php endif; ?>
                    </div>
                </div>
                <form action="<?= URLROOT ?>/cart/add" method="POST" onclick="event.stopPropagation()">
                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-buy border-0 w-100">🛒 Thêm vào giỏ</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</section>
<?php endif; ?>
