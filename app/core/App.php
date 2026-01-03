<?php

class App
{
    // Controller default = 'Home', Method default = 'index'
    protected $controller = "Home";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        // CONTOH URL: public/mahasiswa/detail/5
        // $url[0] = Controller (mahasiswa)
        // $url[1] = Method (detail)
        // $url[2] = Params (5)

        $url = $this->parseURL();

        //Controller
        // Cek apakah ada file controller sesuai ketikan user di $url[0]?
        if (!empty($url) && file_exists("../app/controller/" . $url[0] . ".php")) {
            $this->controller = $url[0]; // Jika ada, pakai controller tersebut
            unset($url[0]); // Hapus dari list URL agar tidak mengganggu
        }
        // Panggil file controller-nya
        require_once "../app/controller/" . $this->controller . ".php";
        // Buat object baru (Instansiasi) -> $this->controller = new Mahasiswa();
        $this->controller = new $this->controller();

        //Method
        // Cek apakah user mengetik method di $url[1]?
        if (isset($url[1])) {
            // Cek apakah method tersebut ada di dalam controller?
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1]; // Jika ada, set method-nya
                unset($url[1]);
            }
        }

        //Params
        // Jika masih ada sisa di URL (misal angka '5'), itu adalah params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        //Run Controller.php
        // Panggil Controller, jalankan Method-nya, dan kirimkan Params-nya
        // Contoh: Mahasiswa->detail(5);
        call_user_func([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
