<?php

class Admin extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['role'])) {
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }

        if ($_SESSION['role'] != 'admin') {
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }

    public function transaksi()
    {
        $data['title'] = 'Kelola Transaksi';

        $data['trx'] = $this->model('Transaksi_model')->getAllTransaksi();

        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    public function prosesVerifikasi()
    {
        if ($this->model('Transaksi_model')->prosesVerifikasi($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Status transaksi diperbarui', 'success');
        } else {
            Flasher::setFlash('Gagal', 'Memperbarui status transaksi', 'danger');
        }
        header('Location: ' . BASE_URL . '/admin/transaksi');
        exit;
    }

    /**
     * 1. METHOD INDEX (Halaman Utama)
     * URL: /mahasiswa/index atau /mahasiswa
     * Fungsi: Menampilkan daftar tabel semua mahasiswa.
     */
    public function index()
    {
        // 1. Set Judul Halaman
        $data['title'] = "Daftar Admin";

        // 2. Minta Data ke (Model)
        $data["admin"] = $this->model("Admin_model")->getAlladmin();

        // 3. Panggil View
        // Kita tumpuk 3 file view agar halaman lengkap (Header + Isi + Footer)
        $this->view("templates/header", $data);
        $this->view("admin/pengguna/index", $data);
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
        if ($this->model("Admin_model")->addadmin($_POST) > 0) {
            // Jika Berhasil: Pasang pesan sukses (Flasher)
            Flasher::setFlash("Data Admin", "berhasil ditambahkan", "success");
            // Redirect user kembali ke halaman index
            header('Location: ' . BASE_URL . '/admin/pengguna');
            exit;
        } else {
            // Jika Gagal: Pasang pesan error
            Flasher::setFlash("Data Admin", "gagal ditambahkan", "danger");
            header('Location: ' . BASE_URL . '/admin/pengguna');
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
        if ($this->model("Admin_model")->updateAdmin($_POST) > 0) {
            Flasher::setFlash("Data Admin", "berhasil diubah", "success");
            header('Location: ' . BASE_URL . '/admin/pengguna');
            exit;
        } else {
            Flasher::setFlash("Data Admin", "gagal diubah", "danger");
            header('Location: ' . BASE_URL . '/admin/pengguna');
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
        $data = $this->model("Admin_model")->getMahasiswaById($id[0]);
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
        if ($id[0] == 1) {
            Flasher::setFlash('Gagal', 'Super Admin tidak boleh dihapus!', 'danger');
            header('Location: ' . BASE_URL . '/admin/pengguna');
            exit;
        }
        if ($this->model("Admin_model")->deleteadmin($id[0]) > 0) {
            Flasher::setFlash("Data Admin", "berhasil dihapus", "success");
            header('Location: ' . BASE_URL . '/admin/pengguna');
            exit;
        } else {
            Flasher::setFlash("Data Admin", "gagal dihapus", "danger");
            header('Location: ' . BASE_URL . '/admin/pengguna');
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
        echo json_encode($this->model('admin_model')->getadminById($_POST['id']));
    }
}