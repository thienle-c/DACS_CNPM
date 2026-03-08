<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($data['title']) ? $data['title'] : SITENAME ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= URLROOT ?>/assets/css/style.css">
</head>
<body>

<!-- TOP HEADER -->
<div class="top-header">
  <div class="container">
    <div class="top-header-inner">
      <div class="top-header-links">
        <a href="<?= URLROOT ?>"><i class="fa-solid fa-location-dot"></i> Tìm cửa hàng</a>
        <span>|</span>
        <a href="<?= URLROOT ?>/order/lookup"><i class="fa-solid fa-clipboard-check"></i> Tra cứu đơn hàng</a>
        <span>|</span>
        <a href="<?= URLROOT ?>/warranty"><i class="fa-solid fa-wrench"></i> Trung tâm bảo hành</a>
      </div>
      <div class="top-header-links">
        <a href="#">Tải app <?= SITENAME ?></a>
        <span>|</span>
        <a href="#"><strong><i class="fa-solid fa-phone"></i> 1800.1060</strong> (Miễn phí • 8-21h)</a>
      </div>
    </div>
  </div>
</div>

<!-- MAIN HEADER -->
<header class="main-header">
  <div class="container">
    <div class="header-inner">
      <!-- Logo -->
      <a href="<?= URLROOT ?>" class="logo">
        <div class="logo-icon">
          <i class="fa-solid fa-mobile-screen-button text-dark"></i>
        </div>
        <div class="logo-text">
          <?= SITENAME ?>
          <span>Chính hãng · Giá tốt</span>
        </div>
      </a>

      <!-- Search -->
      <form action="<?= URLROOT ?>/product/search" method="GET" class="search-bar m-0">
        <input type="text" name="q" id="search-input" class="search-input" placeholder="Bạn tìm gì? iPhone, Samsung, Laptop..." autocomplete="off" required>
        <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>

      <!-- Actions -->
      <div class="header-actions">
        <!-- Replace old onclick with direct link to Cart Route -->
        <a href="<?= URLROOT ?>/cart" class="header-action-btn text-decoration-none">
          <div class="icon">
            <i class="fa-solid fa-cart-shopping fs-5"></i>
            <div class="cart-count" id="cart-count-header">
                <?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0 ?>
            </div>
          </div>
          <div class="label">Giỏ hàng</div>
        </a>

        <?php if(isset($_SESSION['user_id'])) : ?>
            <div class="dropdown">
                <a href="#" class="header-action-btn text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="icon"><i class="fa-solid fa-circle-user fs-5"></i></div>
                    <div class="label"><?= explode(' ', $_SESSION['user_name'])[0] ?></div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                    <li><a class="dropdown-item py-2" href="<?= URLROOT ?>/profile"><i class="fa-solid fa-user-gear me-2"></i> Tài khoản</a></li>
                    <li><a class="dropdown-item py-2" href="<?= URLROOT ?>/order/my_orders"><i class="fa-solid fa-box-open me-2"></i> Đơn hàng của tôi</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item py-2 text-danger" href="<?= URLROOT ?>/auth/logout"><i class="fa-solid fa-right-from-bracket me-2"></i> Đăng xuất</a></li>
                </ul>
            </div>
        <?php else : ?>
            <a href="<?= URLROOT ?>/auth/login" class="header-action-btn text-decoration-none">
                <div class="icon"><i class="fa-regular fa-user fs-5"></i></div>
                <div class="label">Đăng nhập</div>
            </a>
        <?php endif; ?>

        <?php if(isset($_SESSION['admin_id'])) : ?>
            <a href="<?= URLROOT ?>/admin" class="header-action-btn text-decoration-none text-danger">
                <div class="icon"><i class="fa-solid fa-user-shield fs-5"></i></div>
                <div class="label">Quản trị</div>
            </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>

<!-- NAVIGATION -->
<nav class="navbar navbar-expand-lg bg-white border-bottom p-0 sticky-top">
  <div class="container">
    <div class="nav-inner d-flex w-100 overflow-auto">
        <?php if(isset($data['categories'])) : ?>
            <?php foreach($data['categories'] as $cat) : ?>
                <a href="<?= URLROOT ?>/product/category/<?= $cat->slug ?>" class="nav-item text-decoration-none">
                    <span class="nav-icon"><?= $cat->icon ?></span>
                    <span class="nav-label"><?= $cat->name ?></span>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Fallback -->
            <a href="<?= URLROOT ?>/product" class="nav-item text-decoration-none">
                <span class="nav-icon"><i class="fa-solid fa-list mx-2"></i></span>
                <span class="nav-label">Tất cả sản phẩm</span>
            </a>
        <?php endif; ?>
    </div>
  </div>
</nav>

<!-- MAIN CONTENT -->
<main class="py-3">
    <!-- Notifications -->
    <div class="container">
      <?php if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible fade show">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php 
            unset($_SESSION['message']); 
            unset($_SESSION['msg_type']); 
        ?>
      <?php endif; ?>
    </div>
