<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="alert alert-success text-center shadow border-0 rounded-4 mb-4" style="background: linear-gradient(to right, #198754, #20c997); color: white;">
                <h4 class="fw-bold mt-2"><i class="bi bi-check-circle-fill"></i> Booking Berhasil!</h4>
                <p class="mb-2">Silakan selesaikan pembayaran agar kursi Anda aman.</p>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color:#fff; color:#333;">

                <div class="card-header bg-dark text-white p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">NO. INVOICE</small>
                        <h5 class="mb-0 fw-bold letter-spacing-1"><?= $data['trx']['no_invoice']; ?></h5>
                    </div>
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                        <?= $data['trx']['status_bayar']; ?>
                    </span>
                </div>

                <div class="card-body p-4">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <small class="text-muted fw-bold">PAKET TRAVEL</small>
                            <h4 class="fw-bold text-primary mb-1"><?= $data['trx']['nama_paket']; ?></h4>
                            <p class="text-secondary mb-0"><?= $data['trx']['jenis_paket']; ?></p>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <small class="text-muted fw-bold">TANGGAL TRANSAKSI</small>
                            <p class="fw-bold mb-0"><?= date('d F Y', strtotime($data['trx']['tgl_transaksi'])); ?></p>
                            <small><?= date('H:i', strtotime($data['trx']['tgl_transaksi'])); ?> WIB</small>
                        </div>
                    </div>

                    <div class="table-responsive bg-light p-3 rounded-3 mb-4">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td class="text-muted">Nama Jamaah</td>
                                <td class="fw-bold text-end"><?= $data['trx']['nama_lengkap']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">NIK</td>
                                <td class="fw-bold text-end"><?= $data['trx']['nik']; ?></td>
                            </tr>
                            <tr class="border-top">
                                <td class="pt-3 fw-bold">TOTAL TAGIHAN</td>
                                <td class="pt-3 fw-bold text-end fs-4 text-success">
                                    Rp <?= number_format($data['trx']['harga'], 0, ',', '.'); ?>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="alert alert-light border border-secondary border-opacity-25 rounded-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-bank2 fs-1 me-3 text-secondary"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Transfer Bank Syariah Indonesia (BSI)</h6>
                                <p class="mb-0 text-muted">No. Rekening: <b class="text-dark fs-5">7788-9900-11</b></p>
                                <small class="text-muted">a.n PT Sobat Gurun Travel</small>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4 d-print-none">
                        <a href="<?= BASE_URL; ?>/transaksi" class="btn btn-primary px-4 rounded-pill">
                            Lihat Riwayat Saya
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-secondary px-4 rounded-pill ms-2">
                            <i class="bi bi-printer"></i> Cetak
                        </button>
                    </div>

                </div>
                <div class="card-footer bg-light text-center py-3 border-top border-secondary border-opacity-10">
                    <small class="text-muted">Terima kasih telah mempercayakan perjalanan ibadah Anda bersama Sobat Gurun.</small>
                </div>
            </div>

        </div>
    </div>
</div>