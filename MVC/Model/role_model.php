<?php
require_once './Cores/Database7.php';

class role_model
{
    private $db;
    private $table = 'roles';

    public function __construct()
    {
        $this->db = new Database7;
    }

    // Ambil semua role dari tabel 'roles'
    public function getAll()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    // Tambahkan role baru
    public function create($data)
    {
        $this->db->query("INSERT INTO $this->table (name, daily_wage) VALUES (:name, :wage)");
        $this->db->bind('name', $data['name']);
        $this->db->bind('wage', $data['daily_wage']);
        return $this->db->execute();
    }

    // Hapus role
    public function delete($id)
    {
        $this->db->query("DELETE FROM $this->table WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function getByName($name)
{
    $this->db->query("SELECT * FROM roles WHERE name = :name LIMIT 1");
    $this->db->bind('name', $name);
    return $this->db->single();
}

}
