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

                <!-- HEADER -->
                <div class="card-header border-0 text-white" style="background: <?= $bg; ?>;">
                    <div class="text-center py-3">
                        <h2 class="card-title mb-1 fw-bold" style="font-size:1.8rem;">
                            Detail Paket Travel
                        </h2>
                        <div class="d-flex justify-content-center align-items-center gap-2 mt-1">
                            <span class="fs-5"><?= $data['paket']['nama_paket']; ?></span>
                            <span class="badge bg-dark bg-opacity-50 px-3 py-2 rounded-pill">
                                <?= $data['paket']['jenis_paket']; ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- BODY -->
                <div class="card-body" style="background-color:#1f1f1f;">
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item d-flex justify-content-between"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted">ID Paket</span>
                            <span class="fw-semibold"><?= $data['paket']['id_paket']; ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted">Nama Paket</span>
                            <span class="fw-semibold"><?= $data['paket']['nama_paket']; ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted">Jenis Paket</span>
                            <span class="fw-semibold"><?= $data['paket']['jenis_paket']; ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted">Harga</span>
                            <span class="fw-bold" style="color:#d4af37;">
                                Rp <?= number_format($data['paket']['harga'], 0, ',', '.'); ?>
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted">Kuota</span>
                            <span class="fw-semibold"><?= $data['paket']['kuota']; ?> orang</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted">Tanggal Berangkat</span>
                            <span class="fw-semibold"><?= $data['paket']['tgl_berangkat']; ?></span>
                        </li>

                        <li class="list-group-item"
                            style="background-color:#1f1f1f; color:#f5f5f5; border-color:#333;">
                            <span class="text-muted d-block mb-1">Deskripsi</span>
                            <div class="fw-normal" style="line-height:1.6;">
                                <?= nl2br($data['paket']['deskripsi']); ?>
                            </div>
                        </li>

                    </ul>
                </div>

                <!-- FOOTER -->
                <div class="card-footer d-flex justify-content-between align-items-center border-0"
                     style="background-color:#1f1f1f;">
                    <a href="<?= BASE_URL; ?>/paket" class="btn btn-outline-light btn-sm rounded-pill">
                        &larr; Kembali
                    </a>

                    <div>
                        <a href="<?= BASE_URL; ?>/paket/delete/<?= $data['paket']['id_paket']; ?>"
                           class="btn btn-outline-danger btn-sm rounded-pill me-2"
                           onclick="return confirm('Yakin ingin menghapus paket ini?');">
                            Hapus
                        </a>
                        <a href="<?= BASE_URL; ?>/paket"
                           class="btn btn-success btn-sm rounded-pill">
                            Kelola Paket
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
