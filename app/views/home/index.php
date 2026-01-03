<table class="table mt-3" id="mytable">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Nama</th>
        <th scope="col">Kelas</th>
        <th scope="col">Email</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data["mahasiswa"] as $siswa) : ?>
        <tr>
            <th scope="row"><?= $siswa["id_siswa"] ?></th>
            <td><?= $siswa["nama_lengkap"] ?></td>
            <td><?= $siswa["kelas"] ?></td>
            <td><?= $siswa["email"] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script src="<?= BASE_URL; ?>/js/datatables.js"></script>
<script>
    new DataTable("#mytable")
</script>