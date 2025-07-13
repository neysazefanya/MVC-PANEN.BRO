<?php
require_once './Model/user_model.php';

class Auth
{

    private $model;
    private $db; // ← Tambahkan ini

    public function __construct()
    {
        $this->model = new user_model();
        $this->db = new Database7(); // ← Inisialisasi di sini saja
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function register()
    {
        require_once './Model/role_model.php';
        $roleModel = new role_model();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'role' => $_POST['role'],
                'availability_time' => $_POST['availability_time'] ?? null
            ];

            $result = $this->model->register($data);
            if ($result) {
                $this->db = new Database7();
                $this->db->query("SELECT id FROM users WHERE username = :username");
                $this->db->bind('username', $_POST['username']);
                $user = $this->db->single();
                $new_user_id = $user['id'] ?? null;

                if ($new_user_id && !empty($_POST['skills'])) {
                    foreach ($_POST['skills'] as $role_id) {
                        $this->db->query("INSERT INTO user_roles (user_id, role_id) VALUES (:uid, :rid)");
                        $this->db->bind('uid', $new_user_id);
                        $this->db->bind('rid', $role_id);
                        $this->db->execute();
                    }
                }

                echo "<script>alert('Registrasi berhasil');window.location='?action=login';</script>";
            }
        }

        $roles = $roleModel->getAll();
        include './View/Auth/register.php';
    }



    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->model->login($_POST['username']);
            if ($user && password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user'] = $user;
                if ($user['role'] === 'admin') {
                    header('Location: ./index.php?action=area');
                } else {
                    header('Location: ./index.php?action=jadwal-terbuka');
                }
                exit;
            } else {
                echo "<script>alert('Username atau Password salah');</script>";
            }
        }

        include './View/Auth/login.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: ?action=login');
    }
}
