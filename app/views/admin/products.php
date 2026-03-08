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
        
        /* Table Styles */
        .table-custom th { background-color: #f8f9fa; font-weight: 600; color: #495057; border-bottom: 2px solid #dee2e6; }
        .table-custom td { vertical-align: middle; }
        .img-thumbnail-custom { width: 50px; height: 50px; object-fit: contain; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h1 class="logo-text"><i class="fa-solid fa-mobile-screen-button"></i> TechZone</h1>
            <span class="badge bg-danger mt-1">Admin Panel</span>
        </div>
        <ul class="sidebar-menu">
            <li><a href="<?= URLROOT ?>/admin"><i class="fa-solid fa-gauge"></i> <span>Dashboard</span></a></li>
            <li><a href="<?= URLROOT ?>/admin/orders"><i class="fa-solid fa-cart-shopping"></i> <span>Đơn hàng</span></a></li>
            <li><a href="<?= URLROOT ?>/admin/products" class="active"><i class="fa-solid fa-box"></i> <span>Sản phẩm</span></a></li>
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800 fw-bold"><?= $data['title'] ?></h1>
                <a href="#" class="btn btn-danger"><i class="fa-solid fa-plus me-1"></i>Thêm sản phẩm</a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom m-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">ID</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Giá bán</th>
                                    <th>Nổi bật / FS</th>
                                    <th class="text-end pe-4">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['products'] as $product): ?>
                                <tr>
                                    <td class="ps-4">#<?= $product->id ?></td>
                                    <td>
                                        <img src="<?= strpos($product->image, 'http') === 0 ? $product->image : URLROOT . '/assets/images/' . $product->image ?>" class="img-thumbnail img-thumbnail-custom border">
                                    </td>
                                    <td class="fw-bold text-dark" style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($product->name) ?>">
                                        <?= htmlspecialchars($product->name) ?>
                                    </td>
                                    <td><span class="badge bg-secondary"><?= $product->category_name ?></span></td>
                                    <td class="fw-bold text-danger"><?= number_format($product->sale_price ?: $product->price, 0, ',', '.') ?>₫</td>
                                    <td>
                                        <?php if($product->is_featured): ?><span class="badge bg-primary me-1">Nổi bật</span><?php endif; ?>
                                        <?php if($product->is_flash_sale): ?><span class="badge bg-warning text-dark">Flash Sale</span><?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="#" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-sm btn-outline-danger ms-1" onclick="return confirm('Xóa sản phẩm này?')"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
