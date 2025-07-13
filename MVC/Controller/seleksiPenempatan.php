<?php
require_once './Model/seleksi_penempatan.php';
require_once './Model/role_model.php';
require_once './Model/tugas_kerja.php'; // untuk memasukkan ke work_schedules

class SeleksiPenempatan
{
    private $model;
    private $workModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new seleksi_penempatan();
        $this->workModel = new tugas_kerja();
    }

    // Admin: lihat semua pengajuan
    public function index()
    {
        $pengajuan = $this->model->getAllApplications();
        include './View/Seleksi_Penempatan/index.php';
    }

    // Admin: update status (terima/tolak)
    public function updateStatus($id, $status)
    {
        $app = $this->model->findById($id);
        if (!$app) return;

        $this->model->updateStatus($id, $status);

        // Jika accepted, masukkan ke work_schedules
        if ($status === 'accepted') {
            $this->workModel->assign([
                'schedule_id' => $app['schedule_id'],
                'employee_id' => $app['user_id'],
                'status' => 'diterima',
                'choice_of_role' => 'Belum ditentukan'
            ]);
        }

        header('Location: index.php?action=seleksi');
        exit;
    }

    // Karyawan: ajukan diri
    public function apply()
    {
        if (!isset($_GET['schedule_id'])) {
            die("Schedule ID is missing.");
        }

        $schedule_id = intval($_GET['schedule_id']);
        $user_id = $_SESSION['user']['id'];

        $model = new seleksi_penempatan();
        $model->apply($user_id, $schedule_id);

        header("Location: index.php?action=jadwal-terbuka");
        exit;
    }

    public function pengajuanSaya()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        $pengajuanSaya = $this->model->getPengajuanSaya($user_id);

        include './View/Seleksi_Penempatan/status-pengajuan.php';
    }

    public function assign($id)
    {
        $app = $this->model->findById($id);
        if (!$app || $app['status'] !== 'pending') {
            echo "Pengajuan tidak ditemukan atau sudah diproses.";
            return;
        }

        require_once './Model/role_model.php';
        $roleModel = new role_model();
        $roles = $roleModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $roleDipilih = $_POST['role'];

            // update status pengajuan
            $this->model->updateStatus($id, 'accepted');

            // masukkan ke tabel work_schedules dengan role
            $this->workModel->assign([
                'schedule_id' => $app['schedule_id'],
                'employee_id' => $app['user_id'],
                'status' => 'diterima',
                'choice_of_role' => $roleDipilih
            ]);

            header('Location: index.php?action=seleksi');
            exit;
        }

        include './View/Seleksi_Penempatan/assignRole.php';
    }
}
