<div class="container mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-warning shadow-lg" style="background: #1a1a1a; border-radius: 20px;">
                <div class="card-body p-5 text-center text-white">
                    <div class="mb-4">
                        <i class="fa-solid fa-circle-user fa-6x text-warning"></i>
                    </div>
                    
                    <h2 class="fw-bold mb-1 text-gold"><?= $data['user']['nama_lengkap']; ?></h2>
                    <p class="text-muted mb-4">Jamaah Sobat Gurun Travel</p>
                    
                    <div class="text-start bg-dark p-4 rounded-4 border border-secondary border-opacity-25">
                        <div class="mb-3">
                            <label class="small text-warning opacity-75">ID Jamaah</label>
                            <p class="mb-0 fw-bold">#SG-<?= str_pad($data['user']['id_jamaah'], 4, '0', STR_PAD_LEFT); ?></p>
                        </div>
                        <div class="mb-3">
                            <label class="small text-warning opacity-75">Alamat Email</label>
                            <p class="mb-0 fw-bold"><?= $data['user']['email']; ?></p>
                        </div>
                        <div class="mb-0">
                            <label class="small text-warning opacity-75">Status Akun</label>
                            <p class="mb-0"><span class="badge bg-success">Verified Account</span></p>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <a href="<?= BASE_URL; ?>/home" class="btn btn-warning fw-bold py-2">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>