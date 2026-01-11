<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-success"><i class="bi bi-clock-history me-2"></i>Riwayat Transaksi</h3>
                <a href="<?= BASE_URL; ?>/paket" class="btn btn-outline-success rounded-pill">
                    + Booking Paket Lain
                </a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <?php Flasher::flash(); ?>
                </div>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-dark text-white">
                            <tr>
                                <th class="py-3 ps-4">Invoice / Paket</th>
                                <th class="py-3">Tgl Transaksi</th>
                                <th class="py-3">Total Harga</th>
                                <th class="py-3">Status Pembayaran</th>
                                <th class="py-3 text-center pe-4">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (empty($data['trx'])) : ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                                            Belum ada riwayat transaksi.<br>
                                            <a href="<?= BASE_URL; ?>/paket"
                                               class="text-success text-decoration-none fw-bold">Cari Paket Sekarang</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($data['trx'] as $row) : ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-white"><?= $row['no_invoice']; ?></div>
                                        <small class="text-success fw-semibold"><?= $row['nama_paket']; ?></small>
                                    </td>

                                    <td>
                                        <?= date('d M Y', strtotime($row['tgl_transaksi'])); ?>
                                    </td>

                                    <td class="fw-bold text-secondary">
                                        Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                                    </td>

                                    <td>
                                        <?php if ($row['status_bayar'] == 'Menunggu Pembayaran') : ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-pill">
                                                Belum Bayar
                                            </span>
                                        <?php elseif ($row['status_bayar'] == 'Verifikasi') : ?>
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-3 py-2 rounded-pill">
                                                Sedang Dicek
                                            </span>
                                        <?php elseif ($row['status_bayar'] == 'Lunas') : ?>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2 rounded-pill">
                                                Lunas / Valid
                                            </span>
                                        <?php elseif ($row['status_bayar'] == 'Batal') : ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2 rounded-pill">
                                                Di batalkan
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center pe-4">

                                        <?php if ($row['status_bayar'] == 'Menunggu Pembayaran') : ?>
                                            <a href="<?= BASE_URL; ?>/transaksi/bayar/<?= $row['id_transaksi']; ?>"
                                               class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                                <i class="bi bi-credit-card-2-back me-1"></i> Bayar
                                            </a>
                                        <?php elseif ($row['status_bayar'] == 'Lunas') : ?>
                                            <a href="<?= BASE_URL; ?>/transaksi/invoice/<?= $row['no_invoice']; ?>"
                                               class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                <i class="bi bi-file-earmark-text me-1"></i> Invoice
                                            </a>
                                        <?php elseif ($row['status_bayar'] == 'Batal') : ?>
                                            <button class="btn btn-sm btn-danger rounded-pill px-3" disabled>
                                                <i class="bi bi-hourglass-split"></i> Dibatalkan
                                            </button>
                                        <?php else : ?>
                                            <button class="btn btn-sm btn-secondary rounded-pill px-3" disabled>
                                                <i class="bi bi-hourglass-split"></i> Diproses
                                            </button>
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