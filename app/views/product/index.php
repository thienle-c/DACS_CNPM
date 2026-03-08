<?php
// Extracted variables from $data
$products = $data['products'] ?? [];
$currentCategory = $data['current_category'] ?? null;
$categories = $data['categories'] ?? [];
$keyword = $data['keyword'] ?? null;
?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URLROOT ?>" class="text-decoration-none text-danger fw-bold">Trang chủ</a></li>
            <?php if($keyword): ?>
                <li class="breadcrumb-item active">Tìm kiếm "<?= htmlspecialchars($keyword) ?>"</li>
            <?php elseif($currentCategory): ?>
                <li class="breadcrumb-item active"><?= $currentCategory->name ?></li>
            <?php else: ?>
                <li class="breadcrumb-item active">Tất cả sản phẩm</li>
            <?php endif; ?>
        </ol>
    </nav>

    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-lg-3 d-none d-lg-block">
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-bottom fw-bold py-3">Danh mục</div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <?php foreach($categories as $c): ?>
                            <a href="<?= URLROOT ?>/product/category/<?= $c->slug ?>" class="list-group-item list-group-item-action d-flex align-items-center gap-2 <?= ($currentCategory && $currentCategory->id == $c->id) ? 'active bg-danger border-danger' : 'border-0' ?>">
                                <span><?= $c->icon ?></span>
                                <span><?= $c->name ?></span>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Optional: Price Filter -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom fw-bold py-3">Lọc theo giá</div>
                <div class="card-body">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="price1">
                        <label class="form-check-label" for="price1">Dưới 2 triệu</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="price2">
                        <label class="form-check-label" for="price2">Từ 2 - 4 triệu</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="price3">
                        <label class="form-check-label" for="price3">Từ 4 - 7 triệu</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="price4">
                        <label class="form-check-label" for="price4">Từ 7 - 13 triệu</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="price5">
                        <label class="form-check-label" for="price5">Trên 13 triệu</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-3 bg-white p-3 rounded-3 shadow-sm">
                <h1 class="h4 m-0 fw-bold">
                    <?php if($keyword): ?>
                        Kết quả tìm kiếm: "<?= htmlspecialchars($keyword) ?>" (<?= count($products) ?>)
                    <?php elseif($currentCategory): ?>
                        <?= $currentCategory->name ?> (<?= count($products) ?>)
                    <?php else: ?>
                        Tất cả sản phẩm (<?= count($products) ?>)
                    <?php endif; ?>
                </h1>
            </div>

            <?php if(count($products) > 0): ?>
                <div class="products-grid products-grid-4 w-100 m-0">
                    <?php foreach($products as $product): ?>
                        <?php 
                            $price = $product->sale_price ? $product->sale_price : $product->price;
                            $original = $product->sale_price ? $product->price : null;
                            $discount = $original ? round((($original - $price) / $original) * 100) : 0;
                        ?>
                        <div class="product-card m-0" onclick="window.location.href='<?= URLROOT ?>/product/detail/<?= $product->id ?>'">
                            <div class="product-card-badge">
                                <?php if($product->tags): ?>
                                    <?php foreach(explode(',', $product->tags) as $tag): ?>
                                        <span class="badge <?= $tag === 'Mới' || $tag === 'Mới 2025' ? 'badge-blue' : 'badge-red' ?>"><?= trim($tag) ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="product-image-wrapper">
                                <img src="<?= strpos($product->image, 'http') === 0 ? $product->image : URLROOT . '/assets/images/' . $product->image ?>" alt="<?= htmlspecialchars($product->name) ?>">
                            </div>
                            <div class="product-info">
                                <div class="product-name"><?= htmlspecialchars($product->name) ?></div>
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
            <?php else: ?>
                <div class="alert alert-warning">
                    Không tìm thấy sản phẩm nào.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
