<?php

class Transaksi extends Controller
{

    public function __construct()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'jamaah') {
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Riwayat Transaksi Saya';
        $id_jamaah = $_SESSION['id_user'];

        $data['trx'] = $this->model('Transaksi_model')->getRiwayatJamaah($id_jamaah);

        $this->view('templates/header', $data);
        $this->view('transaksi/index', $data);
        $this->view('templates/footer');
    }

    public function konfirmasi($id_paket)
    {
        $data['title'] = 'Konfirmasi Pesanan';

        $data['paket'] = $this->model('Paket_model')->getPaketById($id_paket[0]);
        $data['user'] = $this->model('Jamaah_model')->getJamaahById($_SESSION['id_user']);

        if ($data['paket'] == false) {
            Flasher::setFlash('Gagal', 'Paket tidak ditemukan (Cek Model).', 'danger');
            header('Location: ' . BASE_URL . '/paket');
            exit;
        }

        if ($data['user'] == false) {
            Flasher::setFlash('Gagal', 'User tidak ditemukan.', 'danger');
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('transaksi/konfirmasi', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $hasil = $this->model('Transaksi_model')->tambahTransaksi($_POST);

        if (is_string($hasil)) {
            Flasher::setFlash('Berhasil', 'Booking berhasil! Silahkan lakukan pembayaran.', 'success');
            header('Location: ' . BASE_URL . '/transaksi');
            exit;
        } elseif ($hasil == -1) {
            Flasher::setFlash('Gagal', 'Anda sudah membooking paket ini sebelumnya.', 'warning');
            header('Location: ' . BASE_URL . '/paket');
            exit;
        } elseif ($hasil == -2) {
            Flasher::setFlash('Gagal', 'Kuota paket ini sudah habis.', 'danger');
            header('Location: ' . BASE_URL . '/paket');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Terjadi kesalahan saat memproses transaksi.', 'danger');
            header('Location: ' . BASE_URL . '/paket');
            exit;
        }
    }

    public function invoice($no_invoice)
    {
        $data['title'] = 'Invoice Pemesanan';
        $data['trx'] = $this->model('Transaksi_model')->getTransaksiByInvoice($no_invoice[0]);

        if (!$data['trx']) {
            Flasher::setFlash('Error', 'Invoice tidak ditemukan.', 'danger');
            header('Location: ' . BASE_URL . '/transaksi');
            exit;
        }

        if ($data['trx']['id_jamaah'] != $_SESSION['id_user']) {
            header('Location: ' . BASE_URL . '/transaksi');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('transaksi/invoice', $data);
        $this->view('templates/footer');
    }

    public function bayar($id_transaksi)
    {
        if (is_array($id_transaksi)) {
            $id_transaksi = $id_transaksi[0];
        }

        $data['title'] = 'Konfirmasi Pembayaran';

        $data['trx'] = $this->model('Transaksi_model')->getTransaksiById($id_transaksi);

        if (!$data['trx'] || $data['trx']['id_jamaah'] != $_SESSION['id_user']) {
            Flasher::setFlash('Gagal', 'Transaksi tidak valid.', 'danger');
            header('Location: ' . BASE_URL . '/transaksi');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('transaksi/bayar', $data);
        $this->view('templates/footer');
    }

    public function prosesBayar()
    {
        if ($_FILES['bukti_bayar']['error'] === 4) {
            Flasher::setFlash('Gagal', 'Bukti pembayaran wajib diupload', 'danger');
            header('Location: ' . BASE_URL . '/transaksi/bayar/' . $_POST['id_transaksi']);
            exit;
        }

        $id_transaksi = $_POST['id_transaksi'];

        $namaFile = $_FILES['bukti_bayar']['name'];
        $ukuranFile = $_FILES['bukti_bayar']['size'];
        $tmpName = $_FILES['bukti_bayar']['tmp_name'];

        $ekstensiValid = ['jpg', 'jpeg', 'png'];
        $ekstensi = explode('.', $namaFile);
        $ekstensi = strtolower(end($ekstensi));

        if (!in_array($ekstensi, $ekstensiValid)) {
            Flasher::setFlash('Gagal', 'File bukan gambar (jpg/png)!', 'danger');
            header('Location: ' . BASE_URL . '/transaksi/bayar/' . $id_transaksi);
            exit;
        }

        $namaFileBaru = uniqid() . '.' . $ekstensi;
        $tujuan = 'img/bukti/' . $namaFileBaru;

        if (move_uploaded_file($tmpName, $tujuan)) {

            // 3. Siapkan Data untuk Model
            $dataPembayaran = [
                'id_transaksi' => $id_transaksi,
                'jumlah_bayar' => $_POST['jumlah_bayar'],
                'tipe_pembayaran' => $_POST['tipe_pembayaran'],
                'bukti_bayar' => $namaFileBaru
            ];

            // 4. Simpan ke Database
            if ($this->model('Transaksi_model')->simpanPembayaran($dataPembayaran) > 0) {
                Flasher::setFlash('Berhasil', 'Bukti pembayaran dikirim. Menunggu verifikasi admin.', 'success');
                header('Location: ' . BASE_URL . '/transaksi');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'Menyimpan data pembayaran ke database.', 'danger');
                header('Location: ' . BASE_URL . '/transaksi');
                exit;
            }

        } else {
            Flasher::setFlash('Gagal', 'Gagal upload gambar ke folder.', 'danger');
            header('Location: ' . BASE_URL . '/transaksi/bayar/' . $id_transaksi);
            exit;
        }
    }
}