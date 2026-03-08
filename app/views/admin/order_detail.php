<!-- Sidebar and Header omitted for brevity, Assuming to include a layout later or duplicate -->
<?php
// Include header (Extracting top part of index.php into admin/layout/header.php would be better, but simulating single file for speed)
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar { width: 250px; background: #fff; position: fixed; top: 0; left: 0; height: 100vh; border-right: 1px solid #e9ecef; z-index: 1000; }
        .sidebar-header { padding: 20px; border-bottom: 1px solid #e9ecef; text-align: center; }
        .sidebar-header .logo-text { font-size: 24px; font-weight: 900; color: #d70018; margin: 0; }
        .sidebar-menu { padding: 15px 0; list-style: none; margin: 0; }
        .sidebar-menu li a { display: flex; align-items: center; padding: 12px 20px; color: #495057; text-decoration: none; font-weight: 500; transition: all 0.3s; }
        .sidebar-menu li a:hover, .sidebar-menu li a.active { background: #fff5f5; color: #d70018; border-right: 3px solid #d70018; }
        .sidebar-menu li a i { width: 25px; font-size: 18px; margin-right: 10px; }
        .main-content { margin-left: 250px; min-height: 100vh; }
        .topbar { background: #fff; height: 60px; padding: 0 20px; display: flex; align-items: center; justify-content: flex-end; border-bottom: 1px solid #e9ecef; position: sticky; top: 0; z-index: 999; }
        .content-area { padding: 30px; }
        
        .table-custom th { background-color: #f8f9fa; font-weight: 600; color: #495057; border-bottom: 2px solid #dee2e6; }
        .table-custom td { vertical-align: middle; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <h1 class="logo-text"><i class="fa-solid fa-mobile-screen-button"></i> TechZone</h1>
            <span class="badge bg-danger mt-1">Admin Panel</span>
        </div>
        <ul class="sidebar-menu">
            <li><a href="<?= URLROOT ?>/admin"><i class="fa-solid fa-gauge"></i> <span>Dashboard</span></a></li>
            <li><a href="<?= URLROOT ?>/admin/orders" class="active"><i class="fa-solid fa-cart-shopping"></i> <span>Đơn hàng</span></a></li>
            <li><a href="<?= URLROOT ?>/admin/products"><i class="fa-solid fa-box"></i> <span>Sản phẩm</span></a></li>
            <li><a href="<?= URLROOT ?>/admin/categories"><i class="fa-solid fa-layer-group"></i> <span>Danh mục</span></a></li>
            <li class="mt-4"><a href="<?= URLROOT ?>" target="_blank" class="text-secondary hover-danger"><i class="fa-solid fa-store"></i> <span>Xem cửa hàng</span></a></li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=d70018&color=fff" width="32" class="rounded-circle me-2">
                    <strong><?= $_SESSION['admin_name'] ?? 'Admin' ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item text-danger" href="<?= URLROOT ?>/admin/logout">Đăng xuất</a></li>
                </ul>
            </div>
        </header>

        <div class="content-area">
            <?php $order = $data['order']; ?>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="<?= URLROOT ?>/admin/orders" class="text-secondary text-decoration-none mb-2 d-inline-block"><i class="fa-solid fa-arrow-left me-1"></i> Quay lại danh sách</a>
                    <h1 class="h3 mb-0 text-gray-800 fw-bold">Chi tiết Đơn hàng #VD-<?= str_pad($order->id, 5, '0', STR_PAD_LEFT) ?></h1>
                </div>
                
                <form action="<?= URLROOT ?>/admin/order_update_status" method="POST" class="d-flex align-items-center gap-2 bg-white p-2 rounded shadow-sm border">
                    <input type="hidden" name="order_id" value="<?= $order->id ?>">
                    <span class="fw-bold text-muted small ms-2">Trạng thái:</span>
                    <select name="status" class="form-select form-select-sm" style="width: auto;">
                        <option value="pending" <?= $order->status=='pending'?'selected':'' ?>>Chờ xử lý</option>
                        <option value="processing" <?= $order->status=='processing'?'selected':'' ?>>Đang chuẩn bị</option>
                        <option value="shipped" <?= $order->status=='shipped'?'selected':'' ?>>Đang giao</option>
                        <option value="completed" <?= $order->status=='completed'?'selected':'' ?>>Hoàn thành</option>
                        <option value="cancelled" <?= $order->status=='cancelled'?'selected':'' ?>>Đã hủy</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                </form>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-header bg-white py-3 border-bottom fw-bold">
                            Thông tin Khách hàng
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><i class="fa-solid fa-user text-muted me-2" style="width: 20px;"></i> <strong><?= htmlspecialchars($order->customer_name) ?></strong></p>
                            <p class="mb-2"><i class="fa-solid fa-phone text-muted me-2" style="width: 20px;"></i> <?= htmlspecialchars($order->phone) ?></p>
                            <p class="mb-2"><i class="fa-solid fa-location-dot text-muted me-2" style="width: 20px;"></i> <?= htmlspecialchars($order->address) ?></p>
                            <p class="mb-0"><i class="fa-regular fa-clock text-muted me-2" style="width: 20px;"></i> <?= date('d/m/Y H:i', strtotime($order->created_at)) ?></p>
                        </div>
                    </div>
                    
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-white py-3 border-bottom fw-bold">Ghi chú của khách hàng</div>
                        <div class="card-body">
                            <?= empty($order->note) ? '<em class="text-muted">Không có ghi chú.</em>' : nl2br(htmlspecialchars($order->note)) ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-white py-3 border-bottom fw-bold">
                            Sản phẩm đã đặt
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom m-0 align-middle">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Sản phẩm</th>
                                            <th>Giá bán</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-end pe-4">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data['items'] as $item): ?>
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="<?= strpos($item->image, 'http') === 0 ? $item->image : URLROOT . '/assets/images/' . $item->image ?>" class="rounded border p-1" width="50" height="50" style="object-fit: contain;">
                                                    <span class="fw-bold"><?= htmlspecialchars($item->name) ?></span>
                                                </div>
                                            </td>
                                            <td><?= number_format($item->price, 0, ',', '.') ?>₫</td>
                                            <td class="text-center fw-bold"><?= $item->quantity ?></td>
                                            <td class="text-end pe-4 fw-bold text-danger"><?= number_format($item->price * $item->quantity, 0, ',', '.') ?>₫</td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-light">
                                            <td colspan="3" class="text-end fw-bold pt-3 pb-3">Tổng cộng:</td>
                                            <td class="text-end pe-4 fw-bold text-danger fs-5 pt-3 pb-3"><?= number_format($order->total_price, 0, ',', '.') ?>₫</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
