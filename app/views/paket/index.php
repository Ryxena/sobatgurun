<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">

            <!-- HEADER -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 p-4 rounded-4 shadow"
                 style="background: radial-gradient(circle at top left, #0f5132, #198754); color:#f8f9fa;">
                <div>
                    <h3 class="mb-1 fw-bold">Daftar Paket Travel</h3>
                    <small class="opacity-75">Paket Haji • Umroh • Wisata Halal</small>
                </div>
                <button type="button"
                        class="btn btn-light btn-sm fw-semibold tombolTambahPaket"
                        data-bs-toggle="modal"
                        data-bs-target="#modalPaket">
                    + Tambah Paket
                </button>
            </div>

            <?php Flasher::flash(); ?>

            <!-- LIST PAKET -->
            <ul class="list-group border-0">
                <?php foreach ($data["paket"] as $p) : ?>
                    <?php
                    $badgeClass = 'bg-secondary';
                    $borderClass = 'border-secondary';
                    if ($p["jenis_paket"] === 'Haji') {
                        $badgeClass = 'bg-success';
                        $borderClass = 'border-success';
                    } elseif ($p["jenis_paket"] === 'Umroh') {
                        $badgeClass = 'bg-primary';
                        $borderClass = 'border-primary';
                    } elseif ($p["jenis_paket"] === 'Wisata Halal') {
                        $badgeClass = 'bg-warning text-dark';
                        $borderClass = 'border-warning';
                    }
                    ?>
                    <li class="list-group-item mb-3 rounded-4 border <?= $borderClass; ?> shadow-sm"
                        style="background:#1f1f1f; color:#f5f5f5;">
                        
                        <div class="row g-3 align-items-center">

                            <!-- INFO -->
                            <div class="col-12 col-md-8">
                                <h5 class="mb-1 fw-semibold">
                                    <?= $p["nama_paket"]; ?>
                                    <span class="badge <?= $badgeClass; ?> ms-2 px-3 py-1">
                                        <?= $p["jenis_paket"]; ?>
                                    </span>
                                </h5>

                                <div class="small text-muted mb-1">
                                    Kuota <?= $p["kuota"]; ?> orang •
                                    <?= $p["tgl_berangkat"]; ?>
                                </div>

                                <div class="fw-bold fs-6" style="color:#d4af37;">
                                    Rp <?= number_format($p["harga"], 0, ',', '.'); ?>
                                </div>
                            </div>

                            <!-- AKSI -->
                            <div class="col-12 col-md-4">
                                <div class="d-flex flex-column flex-md-row gap-2 justify-content-md-end">

                                    <a href="<?= BASE_URL ?>/paket/detail/<?= $p["id_paket"] ?>"
                                    class="btn btn-outline-light btn-sm px-3 w-100 w-md-auto">
                                        Detail
                                    </a>

                                    <button class="btn btn-outline-success btn-sm px-3 w-100 w-md-auto tampilModalUbahPaket"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalPaket"
                                            data-id="<?= $p["id_paket"] ?>">
                                        Ubah
                                    </button>

                                    <a href="<?= BASE_URL ?>/paket/delete/<?= $p["id_paket"] ?>"
                                    class="btn btn-outline-danger btn-sm px-3 w-100 w-md-auto"
                                    onclick="return confirm('Yakin hapus paket ini?');">
                                        Hapus
                                    </a>

                                </div>
                            </div>

                        </div>
                    </li>

                <?php endforeach; ?>
            </ul>

        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modalPaket" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg"
             style="background:#1f1f1f; color:#f5f5f5;">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="formModalLabelPaket">Tambah Paket Travel</h5>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="<?= BASE_URL; ?>/paket/tambah" method="post" class="row g-3">
                    <input type="hidden" name="id_paket" id="id_paket">

                    <div class="col-md-6">
                        <label class="form-label">Nama Paket</label>
                        <input type="text" name="nama_paket" id="nama_paket"
                               class="form-control bg-dark text-light border-0">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jenis Paket</label>
                        <select name="jenis_paket" id="jenis_paket"
                                class="form-select bg-dark text-light border-0">
                            <option value="Haji">Haji</option>
                            <option value="Umroh">Umroh</option>
                            <option value="Wisata Halal">Wisata Halal</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" id="harga"
                               class="form-control bg-dark text-light border-0">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kuota</label>
                        <input type="number" name="kuota" id="kuota"
                               class="form-control bg-dark text-light border-0">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tanggal Berangkat</label>
                        <input type="date" name="tgl_berangkat" id="tgl_berangkat"
                               class="form-control bg-dark text-light border-0">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                                  class="form-control bg-dark text-light border-0"></textarea>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-light"
                                data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-success">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="<?= BASE_URL; ?>/js/jquery.js"></script>
<script>
    const BASEURL = '<?= BASE_URL; ?>';
</script>
<script src="<?= BASE_URL; ?>/js/script.js"></script>
