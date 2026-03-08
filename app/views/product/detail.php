<?php
$product = $data['product'];
$related = $data['related'];

$price = $product->sale_price ? $product->sale_price : $product->price;
$original = $product->sale_price ? $product->price : null;
$discount = $original ? round((($original - $price) / $original) * 100) : 0;
$image = strpos($product->image, 'http') === 0 ? $product->image : URLROOT . '/assets/images/' . $product->image;
$specs = $product->specs ? json_decode($product->specs, true) : [];
?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URLROOT ?>" class="text-decoration-none text-danger fw-bold">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="<?= URLROOT ?>/product/category/<?= $product->category_slug ?>" class="text-decoration-none text-secondary"><?= $product->category_name ?></a></li>
            <li class="breadcrumb-item active"><?= htmlspecialchars($product->name) ?></li>
        </ol>
    </nav>

    <div class="product-detail-wrapper bg-white p-4 rounded-4 shadow-sm mb-4">
        <div class="row g-5">
            <!-- Gallery -->
            <div class="col-md-6">
                <div class="product-gallery position-sticky" style="top: 80px;">
                    <div class="main-image-container bg-light rounded-4 d-flex align-items-center justify-content-center p-4 mb-3" style="height: 400px;">
                        <img class="img-fluid max-h-100" id="main-product-image" src="<?= $image ?>" alt="<?= htmlspecialchars($product->name) ?>">
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="col-md-6">
                <div class="product-info-detail">
                    <div class="d-flex align-items-center gap-3 mb-3 text-secondary small">
                        <span>⭐ <strong class="text-dark">4.9</strong> (1,234 đánh giá)</span>
                        <span>|</span>
                        <span>Đã bán: <strong class="text-dark"><?= $product->sold_count ?></strong></span>
                    </div>
                    
                    <h1 class="h3 fw-bold mb-3"><?= htmlspecialchars($product->name) ?></h1>
                    
                    <div class="d-flex align-items-end gap-3 mb-4">
                        <span class="fs-1 fw-bold text-danger lh-1"><?= number_format($price, 0, ',', '.') ?>₫</span>
                        <?php if($original): ?>
                            <span class="fs-5 text-decoration-line-through text-muted"><?= number_format($original, 0, ',', '.') ?>₫</span>
                            <span class="badge bg-danger rounded-pill">-<?= $discount ?>%</span>
                        <?php endif; ?>
                    </div>

                    <div class="bg-danger bg-opacity-10 border border-danger border-opacity-25 rounded-3 p-3 mb-4 text-danger small">
                        <i class="fa-solid fa-credit-card me-2"></i><strong>Trả góp 0%</strong>: Duyệt hồ sơ nhanh chóng trong 5 phút.
                    </div>

                    <?= $product->description ? htmlspecialchars_decode($product->description) : '' ?>

                    <!-- Form Add to Cart -->
                    <form action="<?= URLROOT ?>/cart/add" method="POST" class="mt-4">
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <label class="fw-bold m-0" style="min-width:80px">Số lượng:</label>
                            <div class="input-group" style="width: 130px;">
                                <button class="btn btn-outline-secondary" type="button" onclick="this.nextElementSibling.stepDown()">-</button>
                                <input type="number" name="quantity" class="form-control text-center text-dark" value="1" min="1" max="10" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="this.previousElementSibling.stepUp()">+</button>
                            </div>
                        </div>

                        <div class="d-flex gap-2 flex-column mt-3">
                            <button type="submit" name="action" value="buy" class="btn btn-tgdd-buy btn-lg w-100 fw-bold shadow-sm d-flex flex-column align-items-center py-2">
                                <span class="fs-5">MUA NGAY</span>
                                <span class="small fw-normal">Giao hàng tận nơi hoặc nhận tại siêu thị</span>
                            </button>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-tgdd-finance btn-lg flex-grow-1 fw-bold d-flex flex-column align-items-center py-2">
                                    <span>MUA TRẢ GÓP 0%</span>
                                    <span class="small fw-normal">Duyệt hồ sơ trong 5 phút</span>
                                </button>
                                <button type="submit" name="action" value="add" class="btn btn-outline-secondary btn-lg flex-grow-1 fw-bold d-flex flex-column align-items-center justify-content-center py-2">
                                    <i class="fa-solid fa-cart-plus mb-1"></i>
                                    <span class="small">Thêm vào giỏ</span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row g-2 mt-4 pt-4 border-top">
                        <div class="col-6"><div class="bg-light p-2 rounded small text-center"><i class="fa-solid fa-check text-success me-1"></i>Hàng chính hãng 100%</div></div>
                        <div class="col-6"><div class="bg-light p-2 rounded small text-center"><i class="fa-solid fa-truck text-success me-1"></i>Giao hàng 2h</div></div>
                        <div class="col-6"><div class="bg-light p-2 rounded small text-center"><i class="fa-solid fa-rotate-left text-success me-1"></i>Đổi trả 30 ngày</div></div>
                        <div class="col-6"><div class="bg-light p-2 rounded small text-center"><i class="fa-solid fa-shield text-success me-1"></i>Bảo hành 12 tháng</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Specs Block -->
    <?php if(!empty($specs)): ?>
    <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
        <h2 class="h5 fw-bold mb-4">Thông số kỹ thuật</h2>
        <table class="table table-striped table-bordered m-0 small">
            <tbody>
                <?php foreach($specs as $key => $val): ?>
                <tr>
                    <td class="fw-medium text-muted w-25 bg-light"><?= htmlspecialchars($key) ?></td>
                    <td><?= htmlspecialchars($val) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <!-- Related Products -->
    <?php if(!empty($related)): ?>
    <h2 class="h5 fw-bold mb-3">Sản phẩm cùng loại</h2>
    <div class="products-grid products-grid-4">
        <?php foreach($related as $rProduct): 
            if($rProduct->id == $product->id) continue;
            
            $rPrice = $rProduct->sale_price ? $rProduct->sale_price : $rProduct->price;
        ?>
        <div class="product-card m-0" onclick="window.location.href='<?= URLROOT ?>/product/detail/<?= $rProduct->id ?>'">
            <div class="product-image-wrapper">
                <img src="<?= strpos($rProduct->image, 'http') === 0 ? $rProduct->image : URLROOT . '/assets/images/' . $rProduct->image ?>" alt="<?= htmlspecialchars($rProduct->name) ?>">
            </div>
            <div class="product-info">
                <div class="product-name"><?= htmlspecialchars($rProduct->name) ?></div>
                <div class="product-price-wrapper">
                    <span class="price-new"><?= number_format($rPrice, 0, ',', '.') ?>₫</span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
