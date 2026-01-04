<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Login Jamaah SobatGurun</h4>

                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">
                            <?php Flasher::flash(); ?>
                        </div>
                    </div>

                    <form action="<?= BASE_URL; ?>/auth/login" method="post">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Contoh: test@jamaah.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukan Password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Masuk Sekarang</button>
                        </div>
                    </form>

                </div>
                <div class="card-footer text-center">
                    <small>Belum punya akun? <a href="#">Daftar di sini</a></small>
                </div>
            </div>

        </div>
    </div>
</div>
