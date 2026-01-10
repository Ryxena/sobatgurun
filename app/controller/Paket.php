<?php

class Paket extends Controller
{
    // 1. HALAMAN UTAMA: /paket
    public function index()
    {
        $data['title'] = 'Daftar Paket Travel';
        // Ambil semua data paket
        $data['paket'] = $this->model('Paket_model')->getAllPaket();

        // Tumpuk header, isi, footer
        $this->view('templates/header', $data);
        $this->view('paket/index', $data);
        $this->view('templates/footer');
    }

    // 2. TAMBAH: /paket/tambah (POST)
    public function tambah()
    {
        if ($this->model('Paket_model')->addPaket($_POST) > 0) {
            Flasher::setFlash('Data Paket', 'berhasil ditambahkan', 'success');
            header('Location: ' . BASE_URL . '/paket');
            exit;
        } else {
            Flasher::setFlash('Data Paket', 'gagal ditambahkan', 'danger');
            header('Location: ' . BASE_URL . '/paket');
            exit;
        }
    }

    // 3. UBAH: /paket/ubah (POST)
    public function ubah()
    {
        if ($this->model('Paket_model')->updatePaket($_POST) > 0) {
            Flasher::setFlash('Data Paket', 'berhasil diubah', 'success');
            header('Location: ' . BASE_URL . '/paket');
            exit;
        } else {
            Flasher::setFlash('Data Paket', 'gagal diubah', 'danger');
            header('Location: ' . BASE_URL . '/paket');
            exit;
        }
    }

    // 4. DETAIL: /paket/detail/{id}
    public function detail($id)
    {
        $data['title'] = 'Detail Paket Travel';
        $data['paket'] = $this->model('Paket_model')->getPaketById($id[0]);

        $this->view('templates/header', $data);
        $this->view('paket/detail', $data);
        $this->view('templates/footer');
    }

    // 5. DELETE: /paket/delete/{id}
    public function delete($id)
    {
        if ($this->model('Paket_model')->deletePaket($id[0]) > 0) {
            Flasher::setFlash('Data Paket', 'berhasil dihapus', 'success');
            header('Location: ' . BASE_URL . '/paket');
            exit;
        } else {
            Flasher::setFlash('Data Paket', 'gagal dihapus', 'danger');
            header('Location: ' . BASE_URL . '/paket');
            exit;
        }
    }

    // 6. GET UBAH (AJAX): /paket/getubah
    public function getubah()
    {
        echo json_encode($this->model('Paket_model')->getPaketById($_POST['id']));
    }
}
