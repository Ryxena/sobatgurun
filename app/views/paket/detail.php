<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <?php
            $jenis = $data['paket']['jenis_paket'];
            $bg = 'linear-gradient(135deg, #2c2c2c, #1f1f1f)';

            if ($jenis === 'Haji') {
                $bg = 'linear-gradient(135deg, #0f5132, #198754)';
            } elseif ($jenis === 'Umroh') {
                $bg = 'linear-gradient(135deg, #1b4332, #40916c)';
            } elseif ($jenis === 'Wisata Halal') {
                $bg = 'linear-gradient(135deg, #c2a661, #e6cc80)';
            }
            ?>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden"
                 style="background-color:#1f1f1f; color:#f5f5f5;">

                <div class="card-header border-0 text-white" style="background: <?= $bg; ?>;">
                    <div class="text-center py-4">
                        <h2 class="card-title mb-2 fw-bold" style="font-size:1.8rem;">
                            Detail Paket Travel
                        </h2>
                        <div class="d-flex justify-content-center align-items-center gap-2 mt-1">
                            <span class="fs-5 fw-semibold"><?= $data['paket']['nama_paket']; ?></span>
                            <span class="badge bg-dark bg-opacity-50 px-3 py-2 rounded-pill border border-secondary">
                                <?= $data['paket']['jenis_paket']; ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4" style="background-color:#1f1f1f;">
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted"><i class="bi bi-tag-fill me-2"></i>Harga Paket</span>
                            <span class="fs-4 fw-bold" style="color:#d4af37;">
                                Rp <?= number_format($data['paket']['harga'], 0, ',', '.'); ?>
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted"><i class="bi bi-people-fill me-2"></i>Sisa Kuota</span>
                            <span class="fw-semibold badge bg-secondary fs-6">
                                <?= $data['paket']['kuota']; ?> Pax
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted"><i class="bi bi-calendar-event-fill me-2"></i>Keberangkatan</span>
                            <span class="fw-semibold">
                                <?= date('d F Y', strtotime($data['paket']['tgl_berangkat'])); ?>
                            </span>
                        </li>

                        <li class="list-group-item py-3"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted d-block mb-2"><i class="bi bi-card-text me-2"></i>Deskripsi & Fasilitas</span>
                            <div class="fw-normal text-white-50" style="line-height:1.6; text-align: justify;">
                                <?= nl2br($data['paket']['deskripsi']); ?>
                            </div>
                        </li>

                    </ul>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center border-0 p-4"
                     style="background-color:#252525;">

                    <a href="<?= BASE_URL; ?>/paket" class="btn btn-outline-light rounded-pill px-4">
                        &larr; Kembali
                    </a>

                    <div>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>

                            <a href="<?= BASE_URL; ?>/paket/hapus/<?= $data['paket']['id_paket']; ?>"
                               class="btn btn-outline-danger rounded-pill px-4"
                               onclick="return confirm('Yakin ingin menghapus paket ini?');">
                                <i class="bi bi-trash"></i> Hapus
                            </a>

                        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'jamaah') : ?>

                            <a href="<?= BASE_URL; ?>/booking/daftar/<?= $data['paket']['id_paket']; ?>"
                               class="btn btn-success rounded-pill px-4 fw-bold shadow">
                                Booking Sekarang
                            </a>

                        <?php else : ?>

                            <a href="<?= BASE_URL; ?>/auth"
                               class="btn btn-primary rounded-pill px-4">
                                Login untuk Pesan
                            </a>

                        <?php endif; ?>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>