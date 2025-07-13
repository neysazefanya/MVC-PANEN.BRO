<?php
require_once './Model/karyawan_model.php';

class Karyawan
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new karyawan_model();
    }

    public function index()
    {
        $admins = $this->model->getAllAdmins();
        $karyawans = $this->model->getAllKaryawans();
        include './View/karyawan/index.php';
    }

    public function register2()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'role' => $_POST['role'],
                'availability_time' => $_POST['availability_time'] ?? null
            ];

            $result = $this->model->register2($data);

            if ($result) {
                echo "<script>alert('Registrasi berhasil'); window.location='?action=karyawan';</script>";
                exit;
            } else {
                echo "<script>alert('Registrasi gagal');</script>";
            }
        }

        // Tampilkan halaman form hanya jika bukan POST atau jika gagal
        include './View/karyawan/create.php';
    }

    public function deleteKaryawan()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $this->model->deleteKaryawanById($id);
            if ($result) {
                echo "<script>alert('Karyawan berhasil dihapus'); window.location='index.php?action=karyawan';</script>";
            } else {
                echo "<script>alert('Gagal menghapus karyawan');</script>";
            }
        }
    }

    public function editKaryawan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'username' => $_POST['username'],
                'availability_time' => $_POST['availability_time'],
            ];
            $this->model->updateKaryawan($data);
            echo "<script>alert('Data berhasil diubah'); window.location='index.php?action=karyawan';</script>";
        } else {
            $id = $_GET['id'];
            $karyawan = $this->model->getKaryawanById($id);
            include './View/karyawan/edit.php';
        }
    }
}
