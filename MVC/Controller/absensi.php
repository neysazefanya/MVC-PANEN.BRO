<?php
require_once './Model/absensi_model.php';

class Absensi
{
    private $model;

    public function __construct()
    {
        $this->model = new Absence();
    }

    public function formCheckIn()
    {
        include './View/Absensi/checkin.php';
    }

    public function processCheckIn()
    {
        $work_schedule_id = $_POST['work_schedule_id'] ?? null;
       

        if (!$work_schedule_id) {
            die('Work Schedule ID wajib diisi!');
        }

        $absence = new Absence();

        // Cek apakah sudah check-in hari ini
        if ($absence->hasCheckedInToday($work_schedule_id)) {
            header('Location: index.php?action=absensi-checkout-form&work_schedule_id=' . $work_schedule_id);
            exit;
        }

        // Lakukan check-in
        $absence->checkIn($work_schedule_id);

        header('Location: index.php?action=absensi-checkout-form&work_schedule_id=' . $work_schedule_id);
        exit;
    }



    public function formCheckOut()
    {
        $work_schedule_id = isset($_GET['work_schedule_id']) ? $_GET['work_schedule_id'] : null;

        if ($work_schedule_id === null) {
            echo "<h3 style='color:red'>❌ work_schedule_id belum dikirim di URL.</h3>";
            exit;
        }

        include './View/Absensi/checkout.php';
    }


    public function processCheckOut()
    {
        $work_schedule_id = $_POST['work_schedule_id'] ?? null;
        $notes            = $_POST['notes'] ?? '';
        $status_of_duty   = $_POST['status_of_duty'] ?? 0;
        $quantity         = $_POST['quantity'] ?? 0;

        if (!$work_schedule_id) {
            die('Work Schedule ID wajib diisi!');
        }

        $absence = new Absence();
        $absence->checkOut($work_schedule_id, $quantity, $status_of_duty, $notes);

        header("Location: index.php?action=jadwal-saya&success=checkout");
        exit;
    }
}
