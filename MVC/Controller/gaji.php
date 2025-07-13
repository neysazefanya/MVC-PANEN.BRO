<?php
require_once './Model/gaji_model.php';

class GajiController
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->model = new Gaji;
    }

    public function index()
    {
        $gaji = $this->model->getAll();
        include './View/Gaji/index.php';
    }

    public function generateAll()
    {
        $this->model->generateAll();
        header('Location: index.php?action=gaji');
        exit;
    }



    public function tandaiDibayar()
    {
        if (isset($_GET['id'])) {
            $this->model->markPaid($_GET['id']);
        }
        header("Location: index.php?action=gaji");
        exit;
    }

    public function lihatGajiSaya()
    {
        $user_id = $_SESSION['user']['id'];
        $gajiSaya = $this->model->getMyWages($user_id);
        include './View/Gaji/gaji_saya.php';
    }

    public function ajukanPenarikan()
    {
        if (isset($_GET['id'])) {
            $this->model->requestWithdrawal($_GET['id']);
        }
        header("Location: index.php?action=gaji-saya");
        exit;
    }
}
