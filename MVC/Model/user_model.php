<?php
require_once './Cores/Database7.php';

class user_model
{
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database7;
    }

    public function register($data)
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

    public function login($username)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE username = :username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function updateProfile($id, $data)
    {
        $query = "UPDATE {$this->table}
              SET name = :name,
                  email = :email,
                  username = :username,
                  availability_time = :availability_time";

        // Tambahkan bagian update password jika field password ada dan tidak kosong
        if (!empty($data['password'])) {
            $query .= ", password = :password";
        }

        $query .= " WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('availability_time', $data['availability_time']);
        $this->db->bind('id', $id);

        if (!empty($data['password'])) {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $this->db->bind('password', $hashedPassword);
        }

        return $this->db->execute();
    }

    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function saveUserSkills($user_id, $skills)
{
    foreach ($skills as $role_id) {
        $this->db->query("INSERT INTO user_roles (user_id, role_id) VALUES (:uid, :rid)");
        $this->db->bind('uid', $user_id);
        $this->db->bind('rid', $role_id);
        $this->db->execute();
    }
}

}
