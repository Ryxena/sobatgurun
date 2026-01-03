<?php

class Mahasiswa extends Controller
{
    /**
     * 1. METHOD INDEX (Halaman Utama)
     * URL: /mahasiswa/index atau /mahasiswa
     * Fungsi: Menampilkan daftar tabel semua mahasiswa.
     */
    public function index()
    {
        // 1. Set Judul Halaman
        $data['title'] = "Daftar Mahasiswa";

        // 2. Minta Data ke (Model)
        $data["mahasiswa"] = $this->model("Siswa_model")->getAllMahasiswa();

        // 3. Panggil View
        // Kita tumpuk 3 file view agar halaman lengkap (Header + Isi + Footer)
        $this->view("templates/header", $data);
        $this->view("mahasiswa/index", $data);
        $this->view("templates/footer");
    }

    /**
     * 2. METHOD TAMBAH (Proses Input)
     * URL: /mahasiswa/tambah (Dikirim via POST Form)
     * Fungsi: Menerima data baru dari form dan mengirimnya ke database.
     */
    public function tambah()
    {
        // Cek apakah Model berhasil menambahkan baris baru (> 0)
        if ($this->model("Siswa_model")->addMahasiswa($_POST) > 0) {
            // Jika Berhasil: Pasang pesan sukses (Flasher)
            Flasher::setFlash("Data Mahasiswa", "berhasil ditambahkan", "success");
            // Redirect user kembali ke halaman index
            header('Location: ' . BASE_URL . '/mahasiswa');
            exit;
        } else {
            // Jika Gagal: Pasang pesan error
            Flasher::setFlash("Data Mahasiswa", "gagal ditambahkan", "danger");
            header('Location: ' . BASE_URL . '/mahasiswa');
            exit;
        }
    }

    /**
     * 3. METHOD UBAH/UPDATE (Proses Edit)
     * URL: /mahasiswa/ubah (Dikirim via POST Form)
     * Fungsi: Menyimpan perubahan data mahasiswa yang sudah diedit.
     */
    public function ubah()
    {
        if ($this->model("Siswa_model")->updateMahasiswa($_POST) > 0) {
            Flasher::setFlash("Data Mahasiswa", "berhasil diubah", "success");
            header('Location: ' . BASE_URL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash("Data Mahasiswa", "gagal diubah", "danger");
            header('Location: ' . BASE_URL . '/mahasiswa');
            exit;
        }
    }

    /**
     * 4. METHOD DETAIL (Halaman Profil)
     * URL: /mahasiswa/detail/5
     * Fungsi: Menampilkan info lengkap satu mahasiswa saja.
     * Note: $id diterima dalam bentuk Array (karena struktur App.php), jadi pakai $id[0].
     */
    public function detail($id)
    {
        $data['title'] = "Detail Mahasiswa";

        // Ambil data spesifik berdasarkan ID ($id[0])
        $data = $this->model("Siswa_model")->getMahasiswaById($id[0]);
        $this->view("templates/header", $data);
        $this->view("mahasiswa/detail", $data);
        $this->view("templates/footer");
    }

    /**
     * 5. METHOD DELETE (Hapus Data)
     * URL: /mahasiswa/delete/5
     * Fungsi: Menghapus satu mahasiswa dari database.
     */
    public function delete($id)
    {
        if ($this->model("Siswa_model")->deleteMahasiswa($id[0]) > 0) {
            Flasher::setFlash("Data Mahasiswa", "berhasil dihapus", "success");
            header('Location: ' . BASE_URL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash("Data Mahasiswa", "gagal dihapus", "danger");
            header('Location: ' . BASE_URL . '/mahasiswa');
            exit;
        }
    }

    /**
     * 6. METHOD GET UBAH (API untuk Modal Edit)
     * URL: /mahasiswa/getubah (Via AJAX Request)
     * Fungsi: Mengambil data JSON untuk mengisi form edit secara otomatis.
     */
    public function getubah()
    {
        // Mengembalikan data dalam format JSON (bukan HTML)
        echo json_encode($this->model('Siswa_model')->getMahasiswaById($_POST['id']));
    }
}