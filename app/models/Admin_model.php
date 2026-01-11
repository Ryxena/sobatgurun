<?php

class Admin_model
{
    private $db;
    private $table = "admin";

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllAdmin()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->resultSet();
    }

    public function getAdminById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id_admin = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addAdmin($data)
    {
        $this->db->query("INSERT INTO {$this->table} (username, password, nama_petugas) VALUES (:username, :password, :nama_petugas)");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':nama_petugas', $data['nama_petugas']);
        $this->db->execute();
        return $this->db->rowcount();
    }

    public function deleteAdmin($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id_admin = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->rowcount();
    }

    public function updateAdmin($data)
    {
        $this->db->query("UPDATE {$this->table}
            SET 
                username = :username,
                password = :password,
                nama_petugas= :nama_petugas
            WHERE
                id_admin = :id_admin;
            ");
        $this->db->bind(':id_admin', $data['id_admin']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':nama_petugas', $data['nama_petugas']);
        
        $this->db->execute();

        return $this->db->rowcount();
    }

    public function getAdminByUsername($username) {
        $this->db->query("SELECT * FROM admin WHERE username = :user");
        $this->db->bind('user', $username);
        return $this->db->single();
    }

}

?>