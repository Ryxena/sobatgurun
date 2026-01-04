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
}