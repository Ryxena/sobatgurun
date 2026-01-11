<?php

class Profil extends Controller {
    public function index() {
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
}