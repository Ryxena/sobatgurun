<?php

class Paket_model
{
    private $db;
    private $table = 'paket_travel';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPaket()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getPaketById($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_paket = :id_paket");
        $this->db->bind('id_paket', $id);
        return $this->db->single();
    }

    public function addPaket($data)
    {
        $query = "INSERT INTO " . $this->table . "
                  (nama_paket, jenis_paket, harga, kuota, tgl_berangkat, deskripsi)
                  VALUES
                  (:nama_paket, :jenis_paket, :harga, :kuota, :tgl_berangkat, :deskripsi)";

        $this->db->query($query);
        $this->db->bind('nama_paket', $data['nama_paket']);
        $this->db->bind('jenis_paket', $data['jenis_paket']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('kuota', $data['kuota']);
        $this->db->bind('tgl_berangkat', $data['tgl_berangkat']);
        $this->db->bind('deskripsi', $data['deskripsi']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePaket($data)
    {
        $query = "UPDATE " . $this->table . " SET
                    nama_paket = :nama_paket,
                    jenis_paket = :jenis_paket,
                    harga = :harga,
                    kuota = :kuota,
                    tgl_berangkat = :tgl_berangkat,
                    deskripsi = :deskripsi
                  WHERE id_paket = :id_paket";

        $this->db->query($query);
        $this->db->bind('id_paket', $data['id_paket']);
        $this->db->bind('nama_paket', $data['nama_paket']);
        $this->db->bind('jenis_paket', $data['jenis_paket']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('kuota', $data['kuota']);
        $this->db->bind('tgl_berangkat', $data['tgl_berangkat']);
        $this->db->bind('deskripsi', $data['deskripsi']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deletePaket($id)
    {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_paket = :id_paket");
        $this->db->bind('id_paket', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
