<?php
class Auth extends Controller {

    public function index() {
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'jamaah') {
            header('Location: ' . BASE_URL . '/home');
            exit;
        }

        $data['judul'] = 'Login Jamaah';
        $this->view('templates/header', $data);
        $this->view('auth/login', $data);
        $this->view('templates/footer');
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->model('Jamaah_model')->getJamaahByEmail($email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['role'] = 'jamaah';
                $_SESSION['id_user'] = $user['id_jamaah'];
                $_SESSION['nama'] = $user['nama_lengkap'];

                header('Location: ' . BASE_URL . '/home');
                exit;
            } else {
                Flasher::setFlash('Login', 'Gagal (Password Salah)', 'danger');
                header('Location: ' . BASE_URL . '/auth');
                exit;
            }
        } else {
            Flasher::setFlash('Login', 'Gagal (Email tidak ditemukan)', 'danger');
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }
    }

    public function logout() {
        session_destroy();
        session_unset();
        header('Location: ' . BASE_URL . '/auth');
        exit;
    }
}