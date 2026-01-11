<?php

class Profil extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['role'])) {
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }

        $data['title'] = 'Profil Jamaah';

        $data['user'] = $this->model('Jamaah_model')->getJamaahById($_SESSION['id_user']);

        $this->view('templates/header', $data);
        $this->view('profil/index', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if ($_POST['id_jamaah'] != $_SESSION['id_user']) {
            header('Location: ' . BASE_URL . '/home');
            exit;
        }

        if ($this->model('Jamaah_model')->updateDataJamaah($_POST) > 0) {

            $_SESSION['nama_user'] = $_POST['nama_lengkap'];

            Flasher::setFlash('Berhasil', 'Profil Anda telah diperbarui.', 'success');
            header('Location: ' . BASE_URL . '/profil');
            exit;
        } elseif ($this->model('Jamaah_model')->updateDataJamaah($_POST) == 0) {
            Flasher::setFlash('Info', 'Tidak ada perubahan data.', 'warning');
            header('Location: ' . BASE_URL . '/profil');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Terjadi kesalahan sistem.', 'danger');
            header('Location: ' . BASE_URL . '/profil');
            exit;
        }
    }
    public function getubah()
    {
        if ($_POST['id'] != $_SESSION['id_user']) {
            echo json_encode(null);
            return;
        }

        echo json_encode($this->model('Jamaah_model')->getJamaahById($_POST['id']));
    }
}