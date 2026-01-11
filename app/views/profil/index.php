<div class="container mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php Flasher::flash(); ?>

            <div class="card border-warning shadow-lg" style="background: #1a1a1a; border-radius: 20px;">
                <div class="card-body p-5 text-center text-white">
                    <div class="mb-4">
                        <i class="fa-solid fa-circle-user fa-6x text-warning"></i>
                    </div>

                    <h2 class="fw-bold mb-1 text-gold"><?= $data['user']['nama_lengkap']; ?></h2>
                    <p class="text-muted mb-4">Jamaah Sobat Gurun Travel</p>

                    <div class="text-start bg-dark p-4 rounded-4 border border-secondary border-opacity-25">
                        <div class="row mb-2">
                            <div class="col-6"><small class="text-warning opacity-75">NIK</small></div>
                            <div class="col-6 text-end fw-bold"><?= $data['user']['nik'] ? $data['user']['nik'] : '-'; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small class="text-warning opacity-75">No. Paspor</small></div>
                            <div class="col-6 text-end fw-bold"><?= $data['user']['no_paspor'] ? $data['user']['no_paspor'] : '-'; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small class="text-warning opacity-75">Email</small></div>
                            <div class="col-6 text-end small"><?= $data['user']['email']; ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6"><small class="text-warning opacity-75">No. HP</small></div>
                            <div class="col-6 text-end fw-bold"><?= $data['user']['no_hp']; ?></div>
                        </div>
                        <div class="mt-3">
                            <small class="text-warning opacity-75">Alamat</small>
                            <p class="mb-0 small text-white-50"><?= $data['user']['alamat']; ?></p>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="button"
                                class="btn btn-outline-light fw-bold py-2 tampilModalUbahProfil"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditProfil"
                                data-id="<?= $data['user']['id_jamaah']; ?>">
                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profil Lengkap
                        </button>

                        <a href="<?= BASE_URL; ?>/home" class="btn btn-warning fw-bold py-2 text-dark">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditProfil" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="background:#1f1f1f; color:#f5f5f5;">

            <div class="modal-header border-0 py-3" style="background: linear-gradient(135deg, #d4af37, #b8860b);">
                <h5 class="modal-title fw-bold text-dark"><i class="fa-solid fa-address-card me-2"></i>Update Biodata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <form action="<?= BASE_URL; ?>/profil/update" method="post">

                    <input type="hidden" name="id_jamaah" id="id_jamaah">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6 class="text-warning mb-3 border-bottom border-secondary pb-2">Identitas</h6>

                            <div class="mb-3">
                                <label class="form-label text-white-50 small">Nama Lengkap</label>
                                <input type="text" class="form-control bg-dark text-light border-secondary"
                                       name="nama_lengkap" id="nama_lengkap" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white-50 small">NIK (KTP)</label>
                                <input type="number" class="form-control bg-dark text-light border-secondary"
                                       name="nik" id="nik" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white-50 small">Nomor Paspor</label>
                                <input type="text" class="form-control bg-dark text-light border-secondary"
                                       name="no_paspor" id="nomor_paspor">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-warning mb-3 border-bottom border-secondary pb-2">Kontak</h6>

                            <div class="mb-3">
                                <label class="form-label text-white-50 small">Email</label>
                                <input type="email" class="form-control bg-dark text-light border-secondary"
                                       name="email" id="email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white-50 small">No. HP / WA</label>
                                <input type="number" class="form-control bg-dark text-light border-secondary"
                                       name="no_hp" id="no_hp" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white-50 small">Password Baru</label>
                                <input type="password" class="form-control bg-dark text-light border-secondary"
                                       name="password" id="password" placeholder="(Opsional)">
                                <div class="form-text text-white-50 small">Kosongkan jika tidak ganti password.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-white-50 small">Alamat Lengkap</label>
                            <textarea class="form-control bg-dark text-light border-secondary"
                                      name="alamat" id="alamat" rows="2" required></textarea>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-warning fw-bold text-dark">Simpan Perubahan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>