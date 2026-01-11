<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-warning"><i class="fa-solid fa-user-tie me-2"></i>Dashboard Admin</h3>
        <div class="text-white-50">Kelola pesanan masuk</div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php Flasher::flash(); ?>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color:#1f1f1f;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 align-middle">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th class="ps-4">No Invoice</th>
                                    <th>Jamaah</th>
                                    <th>Paket</th>
                                    <th>Metode/Bukti</th>
                                    <th>Status</th>
                                    <th class="text-center pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['trx'] as $row) : ?>
                                <tr>
                                    <td class="ps-4 font-monospace small"><?= $row['no_invoice']; ?></td>
                                    <td>
                                        <div class="fw-bold"><?= $row['nama_lengkap']; ?></div>
                                        <small class="text-muted"><?= date('d M Y', strtotime($row['tgl_transaksi'])); ?></small>
                                    </td>
                                    <td><?= $row['nama_paket']; ?></td>
                                    <td>
                                        <?php if($row['bukti_bayar']) : ?>
                                            <span class="badge bg-info text-dark"><?= $row['bukti_bayar']; ?></span><br>
                                            <small>Rp <?= number_format($row['jumlah_bayar'],0,',','.'); ?></small>
                                        <?php else : ?>
                                            <span class="text-muted small">- Belum Bayar -</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($row['status_bayar'] == 'Lunas'): ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php elseif($row['status_bayar'] == 'Verifikasi'): ?>
                                            <span class="badge bg-warning text-dark">Perlu Cek</span>
                                        <?php elseif($row['status_bayar'] == 'Gagal'): ?>
                                            <span class="badge bg-danger">Ditolak</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center pe-4">
                                        <?php if($row['status_bayar'] == 'Verifikasi'): ?>
                                            <a href="<?= BASE_URL; ?>/admin/verifikasi/<?= $row['id_transaksi']; ?>"
                                               class="btn btn-sm btn-success rounded-pill px-3"
                                               onclick="return confirm('Validasi pembayaran ini?');">
                                               <i class="fa-solid fa-check"></i> Terima
                                            </a>
                                            <a href="<?= BASE_URL; ?>/admin/tolak/<?= $row['id_transaksi']; ?>"
                                               class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                               onclick="return confirm('Tolak pembayaran ini?');">
                                               <i class="fa-solid fa-times"></i>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted small"><i class="fa-solid fa-lock"></i></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>