<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color:#1f1f1f; color:#f5f5f5;">
                <div class="card-header border-0 py-3" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="mb-0 fw-bold text-white"><i class="bi bi-wallet2 me-2"></i>Konfirmasi Pembayaran</h5>
                </div>

                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <small class="text-white-50">Total Harga Paket</small>
                        <h2 class="fw-bold" style="color:#d4af37;">
                            Rp <?= number_format($data['trx']['harga'], 0, ',', '.'); ?>
                        </h2>
                        <div class="badge bg-secondary mt-2"><?= $data['trx']['no_invoice']; ?></div>
                    </div>

                    <form action="<?= BASE_URL; ?>/transaksi/prosesBayar" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="id_transaksi" value="<?= $data['trx']['id_transaksi']; ?>">

                        <div class="mb-3">
                            <label class="form-label text-white-50">Tipe Pembayaran</label>
                            <select name="tipe_pembayaran" class="form-select bg-dark text-light border-secondary" id="tipe_bayar">
                                <option value="Lunas">Pelunasan (Full Payment)</option>
                                <option value="DP">Uang Muka (DP / Cicilan)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-white-50">Nominal Transfer</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary border-secondary text-light">Rp</span>
                                <input type="number"
                                       class="form-control bg-dark text-light border-secondary"
                                       name="jumlah_bayar"
                                       id="jumlah_bayar"
                                       value="<?= $data['trx']['harga']; ?>"
                                       required>
                            </div>
                            <div class="form-text text-white-50 small" id="info_nominal">Nominal sesuai total tagihan.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-white-50">Upload Bukti Transfer</label>
                            <input type="file"
                                   class="form-control bg-dark text-light border-secondary"
                                   name="bukti_bayar"
                                   accept=".jpg,.jpeg,.png"
                                   required>
                            <div class="form-text text-white-50 small">Format: JPG/PNG. Maks 2MB.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow">
                                <i class="bi bi-check-circle-fill me-2"></i> Kirim Bukti
                            </button>
                            <a href="<?= BASE_URL; ?>/transaksi" class="btn btn-outline-light rounded-pill">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Script Logika DP vs Lunas
    const selectTipe = document.getElementById('tipe_bayar');
    const inputJumlah = document.getElementById('jumlah_bayar');
    const infoNominal = document.getElementById('info_nominal');
    const hargaAsli = <?= $data['trx']['harga']; ?>;

    selectTipe.addEventListener('change', function() {
        if(this.value === 'Lunas') {
            // Mode Lunas: Kunci input di harga total
            inputJumlah.value = hargaAsli;
            inputJumlah.readOnly = true;
            infoNominal.innerText = "Nominal sesuai total tagihan.";
        } else {
            // Mode DP: Kosongkan dan izinkan user mengetik
            inputJumlah.value = '';
            inputJumlah.placeholder = 'Masukkan jumlah transfer...';
            inputJumlah.readOnly = false;
            infoNominal.innerText = "Masukkan nominal yang Anda transfer";
        }
    });
</script>