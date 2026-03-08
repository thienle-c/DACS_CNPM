<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-1">Đăng ký tài khoản</h2>
                        <p class="text-muted">Trở thành thành viên để nhận nhiều quà tặng và ưu đãi</p>
                    </div>

                    <form action="<?= URLROOT ?>/auth/register" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-600">Họ và tên</label>
                            <input type="text" name="name" class="form-control form-control-lg <?= (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['name']; ?>" placeholder="Nguyễn Văn A">
                            <span class="invalid-feedback"><?= $data['name_err']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-600">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg <?= (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['email']; ?>" placeholder="name@example.com">
                            <span class="invalid-feedback"><?= $data['email_err']; ?></span>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-600">Mật khẩu</label>
                                <input type="password" name="password" class="form-control form-control-lg <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['password']; ?>" placeholder="••••••••">
                                <span class="invalid-feedback"><?= $data['password_err']; ?></span>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-600">Xác nhận mật khẩu</label>
                                <input type="password" name="confirm_password" class="form-control form-control-lg <?= (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['confirm_password']; ?>" placeholder="••••••••">
                                <span class="invalid-feedback"><?= $data['confirm_password_err']; ?></span>
                            </div>
                        </div>
                        
                        <div class="mb-4 small text-muted">
                            Bằng cách nhấn đăng ký, bạn đồng ý với <a href="#" class="text-decoration-none">Điều khoản sử dụng</a> và <a href="#" class="text-decoration-none">Chính sách bảo mật</a>.
                        </div>

                        <button type="submit" class="btn btn-warning w-100 btn-lg fw-bold mb-3 rounded-pill py-3">ĐĂNG KÝ NGAY</button>
                    </form>

                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="mb-0 text-muted">Đã có tài khoản? <a href="<?= URLROOT ?>/auth/login" class="fw-bold text-decoration-none text-primary">Đăng nhập</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
