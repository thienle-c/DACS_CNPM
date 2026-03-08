<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-1">Đăng nhập</h2>
                        <p class="text-muted">Đăng nhập để theo dõi đơn hàng và nhận ưu đãi</p>
                    </div>

                    <form action="<?= URLROOT ?>/auth/login" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-600">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg <?= (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['email']; ?>" placeholder="name@example.com">
                            <span class="invalid-feedback"><?= $data['email_err']; ?></span>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label fw-600">Mật khẩu</label>
                                <a href="#" class="small text-decoration-none text-primary">Quên mật khẩu?</a>
                            </div>
                            <input type="password" name="password" class="form-control form-control-lg <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['password']; ?>" placeholder="••••••••">
                            <span class="invalid-feedback"><?= $data['password_err']; ?></span>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 btn-lg fw-bold mb-3 rounded-pill py-3">ĐĂNG NHẬP</button>
                    </form>

                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="mb-0 text-muted">Bạn chưa có tài khoản? <a href="<?= URLROOT ?>/auth/register" class="fw-bold text-decoration-none text-primary">Đăng ký ngay</a></p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="<?= URLROOT ?>/admin/login" class="text-muted small text-decoration-none italic">Đăng nhập quyền quản trị viên</a>
            </div>
        </div>
    </div>
</div>
