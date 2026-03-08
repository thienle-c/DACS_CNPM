<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #fff;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            border-right: 1px solid #e9ecef;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            text-align: center;
        }
        
        .sidebar-header .logo-text {
            font-size: 24px;
            font-weight: 900;
            color: #d70018;
            margin: 0;
        }
        
        .sidebar-menu {
            padding: 15px 0;
            list-style: none;
            margin: 0;
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #495057;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .sidebar-menu li a:hover, .sidebar-menu li a.active {
            background: #fff5f5;
            color: #d70018;
            border-right: 3px solid #d70018;
        }
        
        .sidebar-menu li a i {
            width: 25px;
            font-size: 18px;
            margin-right: 10px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }
        
        /* Topbar */
        .topbar {
            background: #fff;
            height: 60px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            border-bottom: 1px solid #e9ecef;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .content-area {
            padding: 30px;
        }
        
        .dashboard-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .dashboard-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
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
            <li>
                <a href="<?= URLROOT ?>/admin" class="<?= rtrim($_GET['url'] ?? '', '/') == 'admin' ? 'active' : '' ?>">
                    <i class="fa-solid fa-gauge"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= URLROOT ?>/admin/orders" class="<?= strpos($_GET['url'] ?? '', 'admin/order') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-cart-shopping"></i> <span>Đơn hàng</span>
                </a>
            </li>
            <li>
                <a href="<?= URLROOT ?>/admin/products" class="<?= strpos($_GET['url'] ?? '', 'admin/product') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-box"></i> <span>Sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="<?= URLROOT ?>/admin/categories" class="<?= strpos($_GET['url'] ?? '', 'admin/categor') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-layer-group"></i> <span>Danh mục</span>
                </a>
            </li>
            <li class="mt-4">
                <a href="<?= URLROOT ?>" target="_blank" class="text-secondary hover-danger">
                    <i class="fa-solid fa-store"></i> <span>Xem cửa hàng</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        
        <!-- Topbar -->
        <header class="topbar">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=d70018&color=fff" alt="mdo" width="32" height="32" class="rounded-circle me-2">
                    <strong><?= $_SESSION['admin_name'] ?? 'Admin' ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="<?= URLROOT ?>/admin/logout">Đăng xuất</a></li>
                </ul>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-area">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800 fw-bold"><?= $data['title'] ?></h1>
            </div>

            <!-- DASHBOARD BLOCKS -->
            <div class="row g-4 mb-4">
                
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card border-start border-primary border-4">
                        <div>
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Đơn hàng (Tổng)</div>
                            <div class="h3 mb-0 fw-bold text-gray-800"><?= number_format(count($data['orders']), 0, ',', '.') ?></div>
                        </div>
                        <div class="icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-calendar fa-2x"></i>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card border-start border-success border-4">
                        <div>
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                Số lượng Sản phẩm</div>
                            <div class="h3 mb-0 fw-bold text-gray-800"><?= count($data['products']) ?></div>
                        </div>
                        <div class="icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card border-start border-info border-4">
                        <div>
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                Danh mục</div>
                            <div class="h3 mb-0 fw-bold text-gray-800"><?= count($data['categories']) ?></div>
                        </div>
                        <div class="icon bg-info bg-opacity-10 text-info">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">Đơn hàng gần đây</h6>
                    <a href="<?= URLROOT ?>/admin/orders" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle m-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Mã ĐH</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th class="text-end pe-4">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $recentOrders = array_slice($data['orders'], 0, 5);
                                    if(empty($recentOrders)):
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Chưa có đơn hàng nào</td>
                                </tr>
                                <?php else: foreach($recentOrders as $order): ?>
                                <tr>
                                    <td class="ps-4 fw-bold">#VD-<?= str_pad($order->id, 5, '0', STR_PAD_LEFT) ?></td>
                                    <td>
                                        <div class="fw-bold"><?= htmlspecialchars($order->customer_name) ?></div>
                                        <div class="small text-muted"><?= htmlspecialchars($order->phone) ?></div>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($order->created_at)) ?></td>
                                    <td class="fw-bold text-danger"><?= number_format($order->total_price, 0, ',', '.') ?>₫</td>
                                    <td>
                                        <?php 
                                            $badges = [
                                                'pending' => 'bg-warning text-dark',
                                                'processing' => 'bg-info text-white',
                                                'shipped' => 'bg-primary',
                                                'completed' => 'bg-success',
                                                'cancelled' => 'bg-danger'
                                            ];
                                            $labels = [
                                                'pending' => 'Chờ xử lý',
                                                'processing' => 'Đang chuẩn bị',
                                                'shipped' => 'Đang giao',
                                                'completed' => 'Hoàn thành',
                                                'cancelled' => 'Đã hủy'
                                            ];
                                        ?>
                                        <span class="badge <?= $badges[$order->status] ?>"><?= $labels[$order->status] ?></span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="<?= URLROOT ?>/admin/order_detail/<?= $order->id ?>" class="btn btn-sm btn-light border">
                                            <i class="fa-solid fa-eye text-primary"></i> Chi tiết
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
