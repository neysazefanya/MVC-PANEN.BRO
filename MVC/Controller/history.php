<?php
require_once './Model/history_model.php';
require_once './Model/gaji_model.php';

class RiwayatController
{
    private $model;
    private $gajiModel;

    public function __construct()
    {
        $this->model = new History();
        $this->gajiModel = new Gaji();
    }

    public function index()
    {
        $riwayats = $this->model->getAll();
        include './View/History/index.php';
    }

    public function arsipkan($work_schedule_id)
    {
        // Hitung kehadiran
        $this->gajiModel->generateBySchedule($_GET['user_id'], $work_schedule_id);

        // Simpan ke history
        $data = [
            'user_id' => $_GET['user_id'],
            'schedule_id' => $_GET['schedule_id'],
            'work_schedule_id' => $work_schedule_id,
            'days_worked' => $_GET['days_worked'],
            'total_wage' => $_GET['total_wage'],
            'description' => $_GET['description'] ?? '-'
        ];
        $this->model->insert($data);

        // Optional: hapus absensi
        $this->model->clearRelatedData($work_schedule_id);

        header("Location: index.php?action=riwayat");
        exit;
    }

    public function riwayatSaya()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $userId = $_SESSION['user']['id'];
        require_once './Model/history_model.php';
        $history = new History();

        $riwayats = $history->getByUser($userId);

        include './View/History/riwayat_saya.php';
    }
}
