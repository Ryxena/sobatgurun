$(function() {

    // Tombol Tambah
    $('.tombolTambahData').on('click', function() {
        $('#formModalLabel').html('Tambah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Tambah Data');

        // Reset isi form
        $('#nama').val('');
        $('#nrp').val('');
        $('#email').val('');
        $('#jurusan').val('');
        $('#id').val('');

        // Kembalikan action form ke 'tambah'
        $('.modal-body form').attr('action', BASEURL + '/mahasiswa/tambah');
    });

    // Tombol Ubah
    $('.tampilModalUbah').on('click', function() {

        $('#formModalLabel').html('Ubah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Ubah Data');

        // FIX: Gunakan BASEURL agar dinamis
        $('.modal-body form').attr('action', BASEURL + '/mahasiswa/ubah');

        const id = $(this).data('id');

        $.ajax({
            // FIX: Gunakan BASEURL, jangan hardcode http://localhost...
            url: BASEURL + '/mahasiswa/getubah',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                // Pastikan ID selector inputmu sesuai dengan HTML modal
                $('#id').val(data.id_siswa); // Hidden Input ID
                $('#name').val(data.nama_lengkap);
                $('#tgl_daftar').val(data.tanggal_daftar);
                $('#kelas').val(data.kelas);
                $('#email').val(data.email);
                $('#whatsapp').val(data.whatsapp);
                $('#alamat').val(data.alamat);

                // Tambahan: Set jenis kelamin (Select Option)
                $('#gender').val(data.jenis_kelamin);
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX:", error);
                console.log(xhr.responseText); // Cek ini di console kalau error lagi
            }
        });
        
    });

});