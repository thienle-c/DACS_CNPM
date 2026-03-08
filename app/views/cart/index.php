<div class="container py-5">
    <h2 class="mb-4 fw-bold"><i class="fa-solid fa-cart-shopping me-2 text-danger"></i>Giỏ hàng của bạn</h2>

    <?php if(empty($_SESSION['cart'])): ?>
        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
            <div class="fs-1 text-muted mb-3"><i class="fa-solid fa-basket-shopping"></i></div>
            <h4 class="text-secondary mb-4">Giỏ hàng của bạn đang trống</h4>
            <a href="<?= URLROOT ?>" class="btn btn-danger btn-lg px-5 rounded-pill">Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="bg-white rounded-4 shadow-sm p-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Tạm tính</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $total = 0;
                                    foreach($_SESSION['cart'] as $item): 
                                        $price = $item['sale_price'] ?: $item['price'];
                                        $subtotal = $price * $item['quantity'];
                                        $total += $subtotal;
                                ?>
                                    <tr>
                                        <td style="width: 40%">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="<?= strpos($item['image'], 'http') === 0 ? $item['image'] : URLROOT . '/assets/images/' . $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="rounded bg-light p-2" style="width: 80px; height: 80px; object-fit: contain;">
                                                <a href="<?= URLROOT ?>/product/detail/<?= $item['id'] ?>" class="text-decoration-none text-dark fw-bold"><?= htmlspecialchars($item['name']) ?></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-danger"><?= number_format($price, 0, ',', '.') ?>₫</div>
                                            <?php if($item['sale_price']): ?>
                                                <div class="text-muted text-decoration-line-through small"><?= number_format($item['price'], 0, ',', '.') ?>₫</div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <form action="<?= URLROOT ?>/cart/update" method="POST" class="d-flex justify-content-center">
                                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                                <div class="input-group input-group-sm" style="width: 100px;">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="this.nextElementSibling.stepDown(); this.form.submit()">-</button>
                                                    <input type="number" name="quantity" class="form-control text-center" value="<?= $item['quantity'] ?>" min="1" onchange="this.form.submit()">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="this.previousElementSibling.stepUp(); this.form.submit()">+</button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="text-end fw-bold text-danger">
                                            <?= number_format($subtotal, 0, ',', '.') ?>₫
                                        </td>
                                        <td class="text-end">
                                            <a href="<?= URLROOT ?>/cart/remove/<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')" title="Xóa">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="bg-white rounded-4 shadow-sm p-4 position-sticky" style="top: 80px;">
                    <h5 class="fw-bold mb-4">Tóm tắt đơn hàng</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tạm tính:</span>
                        <span class="fw-bold"><?= number_format($total, 0, ',', '.') ?>₫</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                        <span class="text-muted">Phí giao hàng:</span>
                        <span class="text-success fw-medium">Miễn phí</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Tổng cộng:</span>
                        <span class="fw-bold fs-4 text-danger"><?= number_format($total, 0, ',', '.') ?>₫</span>
                    </div>
                    <a href="<?= URLROOT ?>/checkout" class="btn btn-tgdd-buy btn-lg w-100 fw-bold shadow-sm d-flex align-items-center justify-content-center py-3">
                        ĐẶT HÀNG NGAY
                    </a>
                    <a href="<?= URLROOT ?>" class="btn btn-outline-secondary w-100 mt-2">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
