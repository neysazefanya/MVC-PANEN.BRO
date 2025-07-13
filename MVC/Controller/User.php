<?php
require_once './Model/user_model.php';

class UserController
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new user_model();
    }

    // TAMPILKAN HALAMAN PROFILE
    public function index()
    {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $user = $this->model->getUserById($userId);

        if (!$user) {
            $_SESSION['error'] = "Data user tidak ditemukan.";
            header("Location: index.php?action=login");
            exit;
        }

        // Include halaman profile form
        include './View/karyawan/profile.php';
    }

    // UPDATE PROFILE
    public function updateProfile()
    {
        session_start();

        if (!isset($_SESSION['user']['id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $userId = $_SESSION['user']['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'username' => $_POST['username'] ?? '',
                'availability_time' => $_POST['availability_time'] ?? '',
                'password' => $_POST['password'] ?? ''
            ];

            if (empty($data['name']) || empty($data['email']) || empty($data['username'])) {
                $_SESSION['error'] = "Nama, Email, dan Username wajib diisi!";
                header("Location: index.php?action=profile");
                exit;
            }

            if ($this->model->updateProfile($userId, $data)) {
                $_SESSION['success'] = "Profil berhasil diperbarui.";
                $_SESSION['user']['name'] = $data['name'];
                header("Location: index.php?action=profile");
            } else {
                $_SESSION['error'] = "Gagal memperbarui profil.";
                header("Location: index.php?action=profile");
            }
        } else {
            header("Location: index.php?action=profile");
        }
    }
}
