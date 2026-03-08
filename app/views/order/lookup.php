<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white p-4 rounded shadow-sm">
                <h3 class="fw-bold mb-4"><i class="fa-solid fa-magnifying-glass me-2"></i> Tra cứu đơn hàng</h3>
                
                <form action="<?= URLROOT ?>/order/lookup" method="POST" class="mb-5">
                    <div class="input-group input-group-lg">
                        <input type="text" name="order_id" class="form-control" placeholder="Nhập mã đơn hàng (VD: 14)" required>
                        <button class="btn btn-danger px-4" type="submit">Tìm kiếm</button>
                    </div>
                </form>

                <?php if($data['order']): ?>
                    <div class="order-result p-4 border rounded">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h4 class="fw-bold mb-1">Đơn hàng #<?= str_pad($data['order']->id, 5, '0', STR_PAD_LEFT) ?></h4>
                                <p class="text-muted small mb-0">Đặt ngày: <?= $data['order']->created_at ?></p>
                            </div>
                            <span class="badge bg-<?= $data['order']->status == 'pending' ? 'warning' : 'success' ?> p-2 px-3">
                                <?= strtoupper($data['order']->status) ?>
                            </span>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold"><i class="fa-solid fa-user me-2"></i> Thông tin khách hàng</h6>
                            <p class="mb-1"><strong>Họ tên:</strong> <?= $data['order']->customer_name ?></p>
                            <p class="mb-1"><strong>SĐT:</strong> <?= $data['order']->phone ?></p>
                            <p class="mb-0"><strong>Địa chỉ:</strong> <?= $data['order']->address ?></p>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-center">SL</th>
                                        <th class="text-end">Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data['items'] as $item): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= URLROOT ?>/assets/images/<?= $item->image ?>" width="40" class="me-2 rounded">
                                                    <span class="small"><?= $item->name ?></span>
                                                </div>
                                            </td>
                                            <td class="text-center"><?= $item->quantity ?></td>
                                            <td class="text-end fw-bold"><?= number_format($item->price, 0, ',', '.') ?>đ</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-light">
                                        <td colspan="2" class="text-end fw-bold">Tổng tiền:</td>
                                        <td class="text-end fw-bold text-danger fs-5"><?= number_format($data['order']->total_price, 0, ',', '.') ?>đ</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
