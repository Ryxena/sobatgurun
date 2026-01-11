<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Pendaftaran Jamaah Baru</h4>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">
                            <?php Flasher::flash(); ?>
                        </div>
                    </div>

                    <form action="<?= BASE_URL; ?>/auth/prosesRegister" method="post">

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3 text-muted">Informasi Akun</h5>
                                <div class="mb-3">
                                    <label>Email (Untuk Login)</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Ulangi Password</label>
                                    <input type="password" name="ulangi_password" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="mb-3 text-muted">Data Pribadi</h5>
                                <div class="mb-3">
                                    <label>NIK (KTP)</label>
                                    <input type="number" name="nik" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>No. HP (WhatsApp)</label>
                                    <input type="text" name="hp" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-success btn-lg">Daftar Sekarang</button>
                            <a href="<?= BASE_URL; ?>/auth" class="btn btn-outline-secondary">Sudah punya akun? Login</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>