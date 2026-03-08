<div class="container py-5 text-center">
    <div class="bg-white p-5 rounded-4 shadow-sm mx-auto" style="max-width: 600px;">
        <div class="mb-4">
            <i class="fa-solid fa-circle-check text-success" style="font-size: 80px;"></i>
        </div>
        <h2 class="fw-bold mb-3">Đặt hàng thành công!</h2>
        <p class="text-secondary fs-5 mb-4">Mã đơn hàng của bạn: <strong class="text-danger">#VD-<?= str_pad($data['order_id'], 5, '0', STR_PAD_LEFT) ?></strong></p>
        <p class="text-muted mb-4">
            Cảm ơn bạn đã mua sắm tại <strong><?= SITENAME ?></strong>.<br>
            Nhân viên CSKH sẽ liên hệ với bạn trong vòng 15 phút để xác nhận đơn hàng.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="<?= URLROOT ?>" class="btn btn-outline-danger btn-lg px-4 rounded-pill">Về trang chủ</a>
            <a href="<?= URLROOT ?>/product" class="btn btn-danger btn-lg px-4 rounded-pill">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>
