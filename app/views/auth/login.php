<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="mb-3">
                <?php Flasher::flash(); ?>
            </div>

            <div class="card border-warning shadow-lg overflow-hidden" style="background: #1a1a1a; border-radius: 20px;">
                <div class="card-header border-0 bg-warning text-dark text-center py-4">
                    <h3 class="fw-bold mb-0">LOGIN JAMAAH</h3>
                    <small class="fw-semibold">Sobat Gurun Travel</small>
                </div>

                <div class="card-body p-5">
                    <form action="<?= BASE_URL; ?>/auth/login" method="post">
                        <div class="mb-4">
                            <label for="email" class="form-label text-warning small fw-bold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-warning"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control bg-dark border-secondary text-white" 
                                    id="email" name="email" placeholder="Contoh: test@jamaah.com" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-warning small fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-warning"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control bg-dark border-secondary text-white" 
                                    id="password" name="password" placeholder="Masukkan Password" required>
                            </div>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-warning fw-bold py-2 shadow">
                                <i class="fa-solid fa-sign-in-alt me-2"></i>Masuk Sekarang
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-white-50 small">Belum punya akun? 
                            <a href="<?= BASE_URL; ?>/auth/register" class="text-warning fw-bold text-decoration-none">Daftar di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>