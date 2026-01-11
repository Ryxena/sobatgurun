<?php
class Auth extends Controller {

    public function index() {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin') {
                header('Location: ' . BASE_URL . '/admin/transaksi');
            } else {
                header('Location: ' . BASE_URL . '/admin');
            }
            exit;
        }

        $data['title'] = 'Login Sistem';
        $this->view('templates/header', $data);
        $this->view('auth/login', $data);
        $this->view('templates/footer');
    }

    public function login() {
        $identifier = $_POST['email'];
        $password   = $_POST['password'];

        $admin = $this->model('Admin_model')->getAdminByUsername($identifier);

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                $_SESSION['role']      = 'admin';
                $_SESSION['id_user']   = $admin['id_admin'];
                $_SESSION['nama_user'] = $admin['nama_petugas'];

                header('Location: ' . BASE_URL . '/paket');
                exit;
            } else {
                Flasher::setFlash('Login Gagal', 'Password Admin salah.', 'danger');
                header('Location: ' . BASE_URL . '/auth');
                exit;
            }
        }

        $jamaah = $this->model('Jamaah_model')->getJamaahByEmail($identifier);

        if ($jamaah) {
            if (password_verify($password, $jamaah['password'])) {
                $_SESSION['role']      = 'jamaah';
                $_SESSION['id_user']   = $jamaah['id_jamaah'];
                $_SESSION['nama_user'] = $jamaah['nama_lengkap'];

                header('Location: ' . BASE_URL . '/home');
                exit;
            } else {
                Flasher::setFlash('Login Gagal', 'Password salah.', 'danger');
                header('Location: ' . BASE_URL . '/auth');
                exit;
            }
        }

        Flasher::setFlash('Login Gagal', 'Akun tidak ditemukan.', 'danger');
        header('Location: ' . BASE_URL . '/auth');
        exit;
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

        $data['title'] = 'Daftar Akun Jamaah';
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
            Flasher::setFlash('Gagal', 'Password konfirmasi tidak sama!', 'danger');
            header('Location: ' . BASE_URL . '/auth/register');
            exit;
        }

        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($this->model('Jamaah_model')->createJamaah($_POST) > 0) {
            Flasher::setFlash('Berhasil', 'Akun jamaah dibuat. Silakan Login.', 'success');
            header('Location: ' . BASE_URL . '/auth');
            exit;
        } else {
            Flasher::setFlash('Gagal', 'Terjadi kesalahan sistem.', 'danger');
            header('Location: ' . BASE_URL . '/auth/register');
            exit;
        }
    }

    public function admin() {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin') {
                header('Location: ' . BASE_URL . '/admin/transaksi');
            } else {
                header('Location: ' . BASE_URL . '/home');
            }
            exit;
        }

        $data['title'] = 'Login Administrator';
        $this->view('templates/header', $data);
        $this->view('admin/login', $data);
        $this->view('templates/footer');
    }

    public function loginAdmin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $admin = $this->model('Admin_model')->getAdminByUsername($username);

        if ($admin && password_verify($password, $admin['password'])) {

            $_SESSION['role'] = 'admin';
            $_SESSION['id_user'] = $admin['id_admin'];
            $_SESSION['nama_user'] = $admin['nama_petugas'];

            header('Location: ' . BASE_URL . '/admin/transaksi');
            exit;

        } else {
            Flasher::setFlash('Gagal', 'Username atau Password Salah', 'danger');
            header('Location: ' . BASE_URL . '/auth/admin');
            exit;
        }
    }
}