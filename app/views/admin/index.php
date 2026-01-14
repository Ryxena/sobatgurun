<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-warning mb-1"><i class="fa-solid fa-user-tie me-2"></i>Dashboard Admin</h3>
            <div class="text-white-50 small">Kelola pesanan dan validasi bukti bayar</div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php Flasher::flash(); ?>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color:#1f1f1f;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 align-middle">
                            <thead class="bg-secondary text-white small text-uppercase">
                            <tr>
                                <th class="ps-4 py-3">Invoice</th>
                                <th>Jamaah</th>
                                <th>Paket</th>
                                <th>Nominal Bayar</th>
                                <th class="text-center">Status</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data['trx'] as $row) : ?>
                                <tr>
                                    <td class="ps-4 font-monospace text-warning"><?= $row['no_invoice']; ?></td>
                                    <td>
                                        <div class="fw-bold"><?= $row['nama_lengkap']; ?></div>
                                        <small class="text-white-50"><?= date('d M Y', strtotime($row['tgl_transaksi'])); ?></small>
                                    </td>
                                    <td>
                                        <span class="badge border border-secondary text-white-50"><?= $row['nama_paket']; ?></span>
                                    </td>
                                    <td>
                                        <div class="fw-bold">
                                            Rp <?= number_format($row['jumlah_bayar'] ?? 0, 0, ',', '.'); ?></div>
                                        <?php if (!empty($row['bukti_bayar'])): ?>
                                            <small class="text-success"><i class="fa-solid fa-image me-1"></i>Bukti Ada</small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $badges = [
                                                'Lunas' => 'bg-success',
                                                'DP' => 'bg-info text-dark',
                                                'Verifikasi' => 'bg-warning text-dark',
                                                'Batal' => 'bg-danger',
                                                'Menunggu Pembayaran' => 'bg-secondary'
                                        ];
                                        $bg = $badges[$row['status_bayar']] ?? 'bg-secondary';
                                        ?>
                                        <span class="badge rounded-pill <?= $bg; ?> px-3"><?= $row['status_bayar']; ?></span>
                                    </td>
                                    <td class="text-center pe-4">
                                        <?php if (in_array($row['status_bayar'], ['Verifikasi', 'DP', 'Lunas'])): ?>
                                            <button type="button"
                                                    class="btn btn-sm btn-primary rounded-pill px-3 btn-detail"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalVerifikasi"
                                                    data-id="<?= $row['id_transaksi']; ?>"
                                                    data-invoice="<?= $row['no_invoice']; ?>"
                                                    data-nama="<?= $row['nama_lengkap']; ?>"
                                                    data-nominal="Rp <?= number_format($row['jumlah_bayar'] ?? 0, 0, ',', '.'); ?>"
                                                    data-bukti="<?= $row['bukti_bayar']; ?>">
                                                <i class="fa-solid fa-eye me-1"></i> Detail
                                            </button>
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

<div class="modal fade" id="modalVerifikasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-receipt me-2 text-warning"></i>Cek Pembayaran</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?= BASE_URL; ?>/admin/prosesVerifikasi" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_transaksi" id="modal_id">

                    <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                        <div>
                            <small class="text-muted d-block">Nama Jamaah</small>
                            <span class="fw-bold text-dark" id="modal_nama">-</span>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">Nominal Transfer</small>
                            <span class="fw-bold text-success fs-5" id="modal_nominal">Rp 0</span>
                        </div>
                    </div>

                    <div class="text-center mb-3 p-2 bg-dark rounded-3 position-relative">
                        <small class="text-white-50 d-block mb-2 text-start">Bukti Transfer (Klik untuk
                            perbesar):</small>

                        <img id="modal_img"
                             src=""
                             class="img-fluid rounded border border-secondary"
                             style="max-height: 250px; display: none; margin: 0 auto; cursor: zoom-in;"
                             alt="Bukti Transfer"
                             title="Klik untuk memperbesar">

                        <div id="modal_no_img" class="text-white-50 py-4" style="display: none;">
                            <i class="fa-solid fa-image-slash fs-1 mb-2"></i><br>Tidak ada bukti gambar valid
                        </div>
                    </div>

                    <div style="background-color:#212529;" class="card border-0 shadow-sm mb-3">
                        <div class="card-body p-3">
                            <label class="form-label fw-bold small text-muted">Keputusan Admin</label>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="status_aksi" id="aksi_lunas"
                                       value="Lunas" checked>
                                <label class="form-check-label fw-bold text-success" for="aksi_lunas">
                                    <i class="fa-solid fa-check-double me-1"></i> Terima & Set LUNAS
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="status_aksi" id="aksi_dp" value="DP">
                                <label class="form-check-label fw-bold text-info" for="aksi_dp">
                                    <i class="fa-solid fa-hourglass-half me-1"></i> Terima sebagai DP
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_aksi" id="aksi_tolak"
                                       value="Batal">
                                <label class="form-check-label fw-bold text-danger" for="aksi_tolak">
                                    <i class="fa-solid fa-xmark me-1"></i> Tolak / Invalid
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-1">
                        <label for="keterangan_admin" class="form-label fw-bold small text-muted">Keterangan / Catatan
                            Admin</label>
                        <textarea class="form-control"
                                  name="keterangan_admin"
                                  id="keterangan_admin"
                                  rows="2"
                                  placeholder="Contoh: Bukti buram, kurang bayar."></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Tutup</button>
                    <?php if (in_array($row['status_bayar'], ['Verifikasi', 'DP', 'Lunas'])): ?>
                    <?php else: ?>
                        <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">Simpan Keputusan</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btns = document.querySelectorAll('.btn-detail');
        const modalId = document.getElementById('modal_id');
        const modalNama = document.getElementById('modal_nama');
        const modalNominal = document.getElementById('modal_nominal');
        const modalImg = document.getElementById('modal_img');
        const modalNoImg = document.getElementById('modal_no_img');

        btns.forEach(btn => {
            btn.addEventListener('click', function () {
                modalId.value = this.dataset.id;
                modalNama.textContent = this.dataset.nama;
                modalNominal.textContent = this.dataset.nominal;

                const bukti = this.dataset.bukti;

                if (bukti && (bukti.includes('.jpg') || bukti.includes('.png') || bukti.includes('.jpeg'))) {
                    modalImg.src = '<?= BASE_URL; ?>/img/bukti/' + bukti;
                    modalImg.style.display = 'block';
                    modalNoImg.style.display = 'none';
                } else {
                    modalImg.style.display = 'none';
                    modalNoImg.style.display = 'block';
                }
            });
        });
        modalImg.addEventListener('click', function () {
            if (this.style.display !== 'none') {
                Swal.fire({
                    imageUrl: this.src,
                    imageAlt: 'Bukti Pembayaran Full',
                    width: '1000px',
                    imageWidth: '100%',
                    imageHeight: 'auto',
                    padding: '1em',
                    background: '#212529',
                    showConfirmButton: true,
                    confirmButtonText: 'Tutup',
                    customClass: {
                        confirmButton: 'btn rounded-pill'
                    },
                    confirmButtonColor: '#bb2d3b',
                    showCloseButton: true,
                    backdrop: `rgba(0, 0, 0, 0.8)` // Gelapkan background belakang
                });
            }
        });
    });
</script>