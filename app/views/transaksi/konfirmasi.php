<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color:#1f1f1f; color:#f5f5f5;">

                <div class="card-header border-0 py-3" style="background: linear-gradient(135deg, #0f5132, #198754);">
                    <h4 class="mb-0 fw-bold text-white"><i class="bi bi-cart-check-fill me-2"></i>Konfirmasi Booking</h4>
                </div>

                <div class="card-body p-4">

                    <div class="alert alert-warning d-flex align-items-center mb-4 border-0 rounded-3" role="alert" style="background-color: #332701; color: #ffda6a;">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                        <div>
                            Mohon periksa kembali detail pesanan Anda sebelum melanjutkan.
                        </div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-3 text-center mb-3 mb-md-0">
                            <div class="rounded-circle p-4 d-inline-block shadow-sm" style="background-color: #2c2c2c;">
                                <i class="bi bi-airplane-engines-fill" style="font-size: 3rem; color: #198754;"></i>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h3 class="fw-bold mb-1"><?= $data['paket']['nama_paket']; ?></h3>
                            <span class="badge bg-success bg-opacity-75 mb-3 border border-success px-3 py-2 rounded-pill">
                                <?= $data['paket']['jenis_paket']; ?>
                            </span>

                            <div class="p-3 rounded-3" style="background-color: #2c2c2c;">
                                <table class="table table-borderless table-sm text-light mb-0" style="font-size: 0.95rem;">
                                    <tr>
                                        <td class="text-white-50" width="140">Tgl Keberangkatan</td>
                                        <td class="fw-bold">: <?= date('d F Y', strtotime($data['paket']['tgl_berangkat'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-white-50">Sisa Kuota</td>
                                        <td class="fw-bold">: <?= $data['paket']['kuota']; ?> Pax Available</td>
                                    </tr>
                                    <tr>
                                        <td class="text-white-50">Nama Pemesan</td>
                                        <td class="fw-bold">: <?= $data['user']['nama_lengkap']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-white-50">NIK / KTP</td>
                                        <td class="fw-bold">: <?= $data['user']['nik']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <hr class="border-secondary opacity-50">

                    <div class="d-flex justify-content-between align-items-center mb-4 p-4 rounded-3 shadow-sm" style="background-color: #252525;">
                        <div>
                            <span class="fs-6 text-white-50 d-block">Total Tagihan</span>
                            <small class="text-muted">Termasuk pajak & biaya admin</small>
                        </div>
                        <span class="display-6 fw-bold" style="color:#d4af37;">
                            Rp <?= number_format($data['paket']['harga'], 0, ',', '.'); ?>
                        </span>
                    </div>

                    <form action="<?= BASE_URL; ?>/transaksi/tambah" method="post">

                        <input type="hidden" name="id_paket" value="<?= $data['paket']['id_paket']; ?>">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg fw-bold shadow py-3 rounded-pill" onclick="return confirm('Data sudah benar? Lanjutkan booking?');">
                                Proses Booking Sekarang ➔
                            </button>
                            <a href="<?= BASE_URL; ?>/paket/detail/<?= $data['paket']['id_paket']; ?>" class="btn btn-outline-light rounded-pill py-2">
                                Batal & Kembali
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>