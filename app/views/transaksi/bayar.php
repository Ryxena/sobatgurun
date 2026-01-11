<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color:#1f1f1f; color:#f5f5f5;">
                <div class="card-header border-0 py-3" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="mb-0 fw-bold text-white"><i class="bi bi-wallet2 me-2"></i>Konfirmasi Pembayaran</h5>
                </div>

                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <small class="text-white-50">Total Tagihan Paket</small>
                        <h2 class="fw-bold" style="color:#d4af37;">
                            Rp <?= number_format($data['trx']['harga'], 0, ',', '.'); ?>
                        </h2>
                    </div>

                    <form action="<?= BASE_URL; ?>/transaksi/prosesBayar" method="post">

                        <input type="hidden" name="id_transaksi" value="<?= $data['trx']['id_transaksi']; ?>">

                        <div class="mb-3">
                            <label class="form-label text-white-50">Tipe Pembayaran</label>
                            <select name="tipe_pembayaran" class="form-select bg-dark text-light border-secondary" id="tipe_bayar">
                                <option value="Lunas">Pelunasan (Full Payment)</option>
                                <option value="Cicilan">Cicilan (Sebagian)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-white-50">Nominal yang Dibayarkan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary border-secondary text-light">Rp</span>
                                <input type="number"
                                       class="form-control bg-dark text-light border-secondary"
                                       name="jumlah_bayar"
                                       id="jumlah_bayar"
                                       value="<?= $data['trx']['harga']; ?>"
                                       required>
                            </div>
                            <div class="form-text text-white-50">Pastikan nominal sesuai dengan yang Anda transfer.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow">
                                <i class="bi bi-check-circle-fill me-2"></i> Konfirmasi Bayar
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
    const selectTipe = document.getElementById('tipe_bayar');
    const inputJumlah = document.getElementById('jumlah_bayar');
    const hargaAsli = <?= $data['trx']['harga']; ?>;

    selectTipe.addEventListener('change', function() {
        if(this.value === 'Lunas') {
            inputJumlah.value = hargaAsli;
        } else {
            inputJumlah.value = '';
            inputJumlah.placeholder = 'Masukkan nominal cicilan';
            inputJumlah.readOnly = false;
        }
    });
</script>