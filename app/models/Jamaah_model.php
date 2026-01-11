<?php

class Jamaah_model
{
    private $db;

    private $table = 'jamaah';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getJamaahByEmail($email)
    {
        $this->db->query("select * from {$this->table} where email = :email");
        $this->db->bind("email", $email);
        return $this->db->single();
    }

    public function createJamaah($data)
    {
        $query = "INSERT INTO jamaah 
                    (email, password, nik, nama_lengkap, no_hp, alamat)
                VALUES
                    (:email, :password, :nik, :nama, :hp, :alamat)";

        $this->db->query($query);

        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('hp', $data['hp']);
        $this->db->bind('alamat', $data['alamat']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getJamaahById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_jamaah=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function updateDataJamaah($data)
    {
        if (empty($data['password'])) {
            $query = "UPDATE jamaah SET 
                    nama_lengkap = :nama,
                    nik = :nik,
                    no_paspor = :paspor,
                    no_hp = :hp,
                    email = :email,
                    alamat = :alamat
                  WHERE id_jamaah = :id";

            $this->db->query($query);
        } else {
            $query = "UPDATE jamaah SET 
                    nama_lengkap = :nama,
                    nik = :nik,
                    no_paspor = :paspor,
                    no_hp = :hp,
                    email = :email,
                    alamat = :alamat,
                    password = :pass
                  WHERE id_jamaah = :id";

            $this->db->query($query);

            $this->db->bind('pass', password_hash($data['password'], PASSWORD_DEFAULT));
        }

        $this->db->bind('nama', $data['nama_lengkap']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('paspor', $data['no_paspor']);
        $this->db->bind('hp', $data['no_hp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('id', $data['id_jamaah']);

        $this->db->execute();
        return $this->db->rowCount();
    }
}