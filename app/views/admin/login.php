<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color:#1f1f1f; color:#f5f5f5;">
                <div class="card-header border-0 text-center py-4" style="background: linear-gradient(135deg, #212529, #343a40);">
                    <h4 class="fw-bold text-danger mb-0"><i class="fa-solid fa-user-shield me-2"></i>Administrator</h4>
                    <small class="text-white-50">Sobat Gurun Internal System</small>
                </div>

                <div class="card-body p-4">
                    <?php Flasher::flash(); ?>

                    <form action="<?= BASE_URL; ?>/auth/loginAdmin" method="post">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control bg-dark text-light border-secondary" name="username" placeholder="Masukkan username admin" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control bg-dark text-light border-secondary" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger fw-bold">Login Admin</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="<?= BASE_URL; ?>/auth" class="text-secondary small text-decoration-none">&larr; Kembali ke Login Jamaah</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>