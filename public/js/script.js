$(function () {
  // ==========================
  // Mahasiswa (ASLI, JANGAN DIUBAH)
  // ==========================

  // Tombol Tambah Mahasiswa
  $(".tombolTambahData").on("click", function () {
    $("#exampleModalLabel").html("Tambah Siswa");
    $(".modal-footer button[type=submit]").html("Insert");

    // Reset isi form
    $("#id").val("");
    $("#name").val("");
    $("#tgl_daftar").val($("#tgl_daftar").attr("value")); // biar balik ke default hari ini
    $("#kelas").val("");
    $("#email").val("");
    $("#whatsapp").val("");
    $("#alamat").val("");
    $("#gender").val("Laki laki");

    // Kembalikan action form ke 'tambah'
    $(".modal-body form").attr("action", BASEURL + "/mahasiswa/tambah");
  });

  // Tombol Ubah Mahasiswa
  $(".tampilModalUbah").on("click", function () {
    $("#exampleModalLabel").html("Ubah Siswa");
    $(".modal-footer button[type=submit]").html("Ubah Data");

    // FIX: Gunakan BASEURL agar dinamis
    $(".modal-body form").attr("action", BASEURL + "/mahasiswa/ubah");

    const id = $(this).data("id");

    $.ajax({
      // FIX: Gunakan BASEURL, jangan hardcode http://localhost...
      url: BASEURL + "/mahasiswa/getubah",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        // Pastikan ID selector inputmu sesuai dengan HTML modal
        $("#id").val(data.id_siswa); // Hidden Input ID
        $("#name").val(data.nama_lengkap);
        $("#tgl_daftar").val(data.tanggal_daftar);
        $("#kelas").val(data.kelas);
        $("#email").val(data.email);
        $("#whatsapp").val(data.whatsapp);
        $("#alamat").val(data.alamat);
        // Tambahan: Set jenis kelamin (Select Option)
        $("#gender").val(data.jenis_kelamin);
      },
      error: function (xhr, status, error) {
        console.error("Error AJAX:", error);
        console.log(xhr.responseText); // Cek ini di console kalau error lagi
      },
    });
  });

  // Tombol Tambah Paket
  $(".tombolTambahPaket").on("click", function () {
    $("#exampleModalLabelPaket").html("Tambah Paket Travel");
    $("#modalPaket .modal-footer button[type=submit]").html("Insert");

    // Reset isi form paket
    $("#id_paket").val("");
    $("#nama_paket").val("");
    $("#jenis_paket").val("Haji");
    $("#harga").val("");
    $("#kuota").val("");
    $("#tgl_berangkat").val("");
    $("#deskripsi").val("");

    // Set action ke tambah paket
    $("#modalPaket .modal-body form").attr("action", BASEURL + "/paket/tambah");
  });

  // Tombol Ubah Paket
  $(".tampilModalUbahPaket").on("click", function () {
    $("#exampleModalLabelPaket").html("Ubah Paket Travel");
    $("#modalPaket .modal-footer button[type=submit]").html("Ubah Data");

    // Set action ke ubah paket
    $("#modalPaket .modal-body form").attr("action", BASEURL + "/paket/ubah");

    const id = $(this).data("id");

    $.ajax({
      url: BASEURL + "/paket/getubah",
      data: { id: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#id_paket").val(data.id_paket);
        $("#nama_paket").val(data.nama_paket);
        $("#jenis_paket").val(data.jenis_paket);
        $("#harga").val(data.harga);
        $("#kuota").val(data.kuota);
        $("#tgl_berangkat").val(data.tgl_berangkat);
        $("#deskripsi").val(data.deskripsi);
      },
      error: function (xhr, status, error) {
        console.error("Error AJAX Paket:", error);
        console.log(xhr.responseText);
      },
    });
  });
});
