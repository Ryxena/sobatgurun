<?php
class Auth extends Controller {

    public function index() {
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'jamaah') {
            header('Location: ' . BASE_URL . '/home');
            exit;
        }

        $data['title'] = 'Login Jamaah';
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

    public function register() {
        if (isset($_SESSION['role'])) {
            header('Location: ' . BASE_URL . '/home');
            exit;
        }

        $data['title'] = 'Daftar Akun Baru';
        $this->view('templates/header', $data);
        $this->view('auth/register', $data);
        $this->view('templates/footer');
    }

    public function prosesRegister() {
        $cekEmail = $this->model('Jamaah_model')->getJamaahByEmail($_POST['email']);

        if ($cekEmail) {
            Flasher::setFlash('Gagal', 'Email sudah terdaftar!', 'danger');
            header('Location: ' . BASE_URL . '/auth/register');
            exit;
        }

        if ($_POST['password'] !== $_POST['ulangi_password']) {
            Flasher::setFlash('Gagal', 'Password tidak sama!', 'danger');
            header('Location: ' . BASE_URL . '/auth/register');
            exit;
        }

        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($this->model('Jamaah_model')->createJamaah($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Akun dibuat. Silakan Login.', 'success');
            header('Location: ' . BASE_URL . '/auth');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Terjadi kesalahan sistem.', 'danger');
            header('Location: ' . BASE_URL . '/auth/register');
            exit;
        }
    }
}