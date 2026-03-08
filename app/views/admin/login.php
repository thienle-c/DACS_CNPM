<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f4f6f9; }
        .login-box {
            width: 400px;
            margin: 100px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .login-logo { text-align: center; margin-bottom: 25px; }
        .login-logo i { font-size: 40px; color: #d70018; }
        .login-logo h3 { font-weight: 700; margin-top: 10px; }
    </style>
</head>
<body>

<div class="login-box">
    <div class="login-logo">
        <i class="fa-solid fa-user-shield"></i>
        <h3>Admin TechZone</h3>
    </div>
    
    <?php if(!empty($data['error'])): ?>
        <div class="alert alert-danger text-center"><?= $data['error'] ?></div>
    <?php endif; ?>

    <form action="<?= URLROOT ?>/admin/login" method="POST">
        <div class="mb-3">
            <label class="form-label fw-bold">Tài khoản</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Mật khẩu</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-danger w-100 fw-bold py-2">Đăng nhập</button>
        <div class="text-center mt-3">
            <a href="<?= URLROOT ?>" class="text-decoration-none text-secondary"><i class="fa-solid fa-arrow-left me-1"></i>Về trang thương mại</a>
        </div>
    </form>
</div>

</body>
</html>
