<?php

class Controller
{
    // Dipanggil dengan: $this->view('nama_folder/nama_file', $data);
    // $view adalah alamat file PHP di folder 'views'
    // $data adalah informasi yang mau ditampilkan (misal: Nama Mahasiswa)
    public function view($view, $data = [])
    {
        require_once "../app/views/" . $view . ".php";
    }

    // Dipanggil dengan: $this->model('Nama_Model');
    public function model($model)
    {
        // Cari file modelnya di folder 'models'
        require_once "../app/models/" . $model . ".php";
        // Kembalikan sebagai object yang siap pakai
        // Contoh: return new Mahasiswa_model();
        return new $model;

    }
}

?>