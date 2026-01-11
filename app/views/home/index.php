<table class="table table-hover mt-3" id="mytable">
    <thead class="table-light">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Paket</th>
            <th scope="col">Jenis</th>
            <th scope="col">Harga</th>
            <th scope="col">Kuota</th>
            <th scope="col">Tgl Berangkat</th>
            <th scope="col" class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data["paket"] as $paket) : ?>
            <tr>
                <th scope="row"><?= $i++; ?></th>

                <td><?= $paket["nama_paket"]; ?></td>

                <td>
                    <span class="badge bg-info text-dark"><?= $paket["jenis_paket"]; ?></span>
                </td>

                <td>Rp <?= number_format($paket["harga"], 0, ',', '.'); ?></td>

                <td><?= $paket["kuota"]; ?> Pax</td>

                <td><?= date('d M Y', strtotime($paket["tgl_berangkat"])); ?></td>

                <td class="text-center">
                    <a href="<?= BASE_URL; ?>/paket/ubah/<?= $paket['id_paket']; ?>" class="btn btn-sm btn-warning tampilModalUbah" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $paket['id_paket']; ?>">
                        <i class="bi bi-pencil-square"></i> Ubah
                    </a>

                    <a href="<?= BASE_URL; ?>/paket/hapus/<?= $paket['id_paket']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus paket ini?');">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="<?= BASE_URL; ?>/js/datatables.js"></script>

<script>
    $(document).ready(function() {
        new DataTable("#mytable", {
            columnDefs: [
                { orderable: false, targets: 6 }
            ],
        });
    });
</script>