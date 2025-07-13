<?php
require_once './Cores/Database7.php';

class karyawan_model
{
    private $db;
    private $table = 'users';

    public function __construct()
    {
        $this->db = new Database7;
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM $this->table ORDER BY role ASC, name ASC");
        return $this->db->resultSet();
    }

    public function getAllAdmins()
    {
        $this->db->query("SELECT * FROM users WHERE role = 'admin' ORDER BY name ASC");
        return $this->db->resultSet();
    }

    public function getAllKaryawans()
    {
        $this->db->query("SELECT * FROM users WHERE role = 'karyawan' ORDER BY name ASC");
        return $this->db->resultSet();
    }

    public function register2($data)
    {
        $query = "INSERT INTO {$this->table} (name, email, username, password, role, availability_time)
                  VALUES (:name, :email, :username, :password, :role, :availability_time)";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('role', $data['role']);
        $this->db->bind('availability_time', $data['availability_time']);
        return $this->db->execute();
    }

    public function deleteKaryawanById($id)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function getKaryawanById($id)
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function updateKaryawan($data)
    {
        $this->db->query("UPDATE users SET name = :name, email = :email, username = :username, availability_time = :availability_time WHERE id = :id");
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('availability_time', $data['availability_time']);
        $this->db->bind('id', $data['id']);
        return $this->db->execute();
    }
}
