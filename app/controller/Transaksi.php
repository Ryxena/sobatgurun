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


        if ($hasil === -1) {
            Flasher::setFlash('Gagal Booking', 'Anda sudah memesan paket ini sebelumnya (Cek Riwayat).', 'warning');
            header('Location: ' . BASE_URL . '/transaksi'); // Lempar ke riwayat dia
            exit;

        } elseif ($hasil === -2) {
            Flasher::setFlash('Mohon Maaf', 'Kuota paket ini baru saja habis.', 'danger');
            header('Location: ' . BASE_URL . '/paket');
            exit;

        } elseif ($hasil === false) {
            Flasher::setFlash('Gagal', 'Terjadi kesalahan sistem saat booking.', 'danger');
            header('Location: ' . BASE_URL . '/paket');
            exit;

        } else {
            Flasher::setFlash('Berhasil', 'Paket berhasil dibooking! Kuota telah diamankan.', 'success');
            // Redirect ke halaman bayar atau invoice
            header('Location: ' . BASE_URL . '/transaksi/bayar/' . $hasil); // Asumsi kirim invoice/id
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
        if ($this->model('Transaksi_model')->simpanPembayaran($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Konfirmasi pembayaran tercatat! Menunggu cek admin.', 'success');
        } else {
            Flasher::setFlash('Gagal', 'Gagal menyimpan data pembayaran.', 'danger');
        }

        header('Location: ' . BASE_URL . '/transaksi');
        exit;
    }
}