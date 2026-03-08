<div class="container py-5">
    <div class="row g-5">
        <!-- Billing Details Form -->
        <div class="col-lg-7">
            <h2 class="mb-4 fw-bold">Thông tin giao hàng</h2>
            
            <form action="<?= URLROOT ?>/checkout/process" method="POST" id="checkout-form">
                <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
                    <div class="mb-3">
                        <label for="customer_name" class="form-label fw-bold">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Ví dụ: Nguyễn Văn A" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Ví dụ: 0912345678" pattern="[0-9]{10,11}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold">Địa chỉ giao hàng (Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố) <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Nhập địa chỉ nhận hàng chi tiết..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label fw-bold">Ghi chú đơn hàng (Tùy chọn)</label>
                        <textarea class="form-control" id="note" name="note" rows="2" placeholder="Ghi chú về thời gian giao hàng, địa điểm..."></textarea>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
                    <h5 class="fw-bold mb-3">Phương thức thanh toán</h5>
                    <div class="form-check p-3 border rounded mb-2 bg-light">
                        <input class="form-check-input ms-1" type="radio" name="payment_method" id="cod" value="cod" checked>
                        <label class="form-check-label ms-2 fw-medium" for="cod">
                            Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>
                    <!-- Add more payment methods here if needed -->
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-5">
            <div class="bg-white p-4 rounded-4 shadow-sm position-sticky" style="top: 80px;">
                <h4 class="fw-bold border-bottom pb-3 mb-4">Đơn hàng của bạn</h4>
                
                <div class="checkout-items mb-4" style="max-height: 300px; overflow-y: auto;">
                    <?php 
                        $total = 0;
                        if(isset($data['cart'])) {
                            foreach($data['cart'] as $item): 
                                $price = $item['sale_price'] ?: $item['price'];
                                $subtotal = $price * $item['quantity'];
                                $total += $subtotal;
                    ?>
                        <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                            <div class="d-flex gap-3">
                                <img src="<?= strpos($item['image'], 'http') === 0 ? $item['image'] : URLROOT . '/assets/images/' . $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="60" class="rounded border">
                                <div>
                                    <div class="fw-bold small"><?= htmlspecialchars($item['name']) ?></div>
                                    <div class="text-muted small">SL: <?= $item['quantity'] ?></div>
                                </div>
                            </div>
                            <div class="fw-bold text-danger text-end">
                                <?= number_format($subtotal, 0, ',', '.') ?>₫
                            </div>
                        </div>
                    <?php 
                            endforeach; 
                        }
                    ?>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Tạm tính:</span>
                    <span class="fw-bold"><?= number_format($total, 0, ',', '.') ?>₫</span>
                </div>
                <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                    <span class="text-muted">Phí vận chuyển:</span>
                    <span class="text-success fw-medium">Miễn phí</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold fs-5">Tổng cộng:</span>
                    <span class="fw-bold fs-3 text-danger"><?= number_format($total, 0, ',', '.') ?>₫</span>
                </div>

                <button type="button" class="btn btn-tgdd-buy btn-lg w-100 fw-bold shadow-sm py-3" onclick="document.getElementById('checkout-form').submit();">
                    ĐẶT HÀNG NGAY
                </button>
            </div>
        </div>
    </div>
</div>
