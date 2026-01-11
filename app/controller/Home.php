<?php

class Home extends Controller
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

}

?>