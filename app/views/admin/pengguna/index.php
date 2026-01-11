<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-danger"><i class="fa-solid fa-users-gear me-2"></i>Kelola Admin</h3>

        <button type="button" class="btn btn-outline-warning rounded-pill px-4 shadow-sm tombolTambahAdmin"
                data-bs-toggle="modal" data-bs-target="#modalAdmin">
            <i class="fa-solid fa-plus me-1"></i> Tambah Admin
        </button>
    </div>

    <div class="row">
        <div class="col-12">
            <?php Flasher::flash(); ?>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background-color:#1f1f1f; color:#f5f5f5;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0 align-middle">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th class="ps-4" width="5%">No</th>
                                    <th>Nama Petugas</th>
                                    <th>Username</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center pe-4" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($data['admin'] as $row) : ?>
                                <tr>
                                    <td class="ps-4"><?= $no++; ?></td>
                                    <td class="fw-bold"><?= $row['nama_petugas']; ?></td>
                                    <td class="font-monospace text-warning"><?= $row['username']; ?></td>
                                    <td class="text-center">
                                        <?php if($row['id_admin'] == 1) : ?>
                                            <span class="badge bg-danger rounded-pill">SUPER ADMIN</span>
                                        <?php else : ?>
                                            <span class="badge bg-secondary rounded-pill">Admin Biasa</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center pe-4">

                                        <a href="#" class="btn btn-sm btn-primary rounded-circle shadow-sm me-1 tampilModalUbahAdmin"
                                           data-bs-toggle="modal"
                                           data-bs-target="#modalAdmin"
                                           data-id="<?= $row['id_admin']; ?>"
                                           title="Edit Data">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <?php if($row['id_admin'] != 1) : ?>
                                            <a href="<?= BASE_URL; ?>/admin/delete/<?= $row['id_admin']; ?>"
                                               class="btn btn-sm btn-danger rounded-circle shadow-sm"
                                               onclick="return confirm('Yakin ingin menghapus admin ini?');"
                                               title="Hapus Admin">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        <?php else : ?>
                                            <button class="btn btn-sm btn-secondary rounded-circle" disabled>
                                                <i class="fa-solid fa-lock"></i>
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

<div class="modal fade" id="modalAdmin" tabindex="-1" aria-labelledby="judulModalAdmin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="background:#1f1f1f; color:#f5f5f5;">

            <div class="modal-header border-0 py-3" style="background: linear-gradient(135deg, #dc3545, #a71d2a);">
                <h5 class="modal-title fw-bold text-white" id="judulModalAdmin">Tambah Admin Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form action="<?= BASE_URL; ?>/admin/tambah" method="post">

                    <input type="hidden" name="id_admin" id="id_admin">

                    <div class="mb-3">
                        <label class="form-label text-white-50">Nama Petugas</label>
                        <input type="text" class="form-control bg-dark text-light border-secondary"
                               name="nama_petugas" id="nama_petugas" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white-50">Username</label>
                        <input type="text" class="form-control bg-dark text-light border-secondary"
                               name="username" id="username" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-white-50">Password</label>
                        <input type="password" class="form-control bg-dark text-light border-secondary"
                               name="password" id="password" placeholder="Minimal 6 karakter">
                        <div id="passwordHelp" class="form-text text-muted d-none">Kosongkan jika tidak ingin mengubah password.</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-outline-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Simpan Data</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>