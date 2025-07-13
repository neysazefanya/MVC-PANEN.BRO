<?php
require_once './Model/tugas_kerja.php';

class TugasKerja
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new tugas_kerja();
    }

    public function index()
    {
        $penugasan = $this->model->getAll();
        include './View/Tugas_Kerja/index.php';
    }

    public function create()
    {
        $schedules = $this->model->getAllSchedules();
        $employees = $this->model->getAllEmployees();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'schedule_id' => $_POST['schedule_id'],
                'employee_id' => $_POST['employee_id'],
                'status' => $_POST['status'],
                'choice_of_role' => $_POST['choice_of_role']
            ];
            $this->model->assign($data);
            header('Location: index.php?action=tugas');
            exit;
        }

        include './View/Tugas_Kerja/create.php';
    }

    public function jadwalSaya()
    {
        $id = $_SESSION['user']['id'];
        $jadwalsaya = $this->model->getByEmployeeId($id);
        include './View/Tugas_Kerja/jadwal_saya.php';
    }
}
