<?php
require_once './Model/area_kerja.php';

class AreaKerja
{
    private $model;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->model = new area_kerja();
    }

    public function index()
    {
        $areas = $this->model->getAll(); // ini penting!
        include './View/Area_Kerja/index.php';
    }



    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'size' => $_POST['size'],
                'quantity_of_trees' => $_POST['quantity_of_trees'],
                'type_of_soil' => $_POST['type_of_soil']
            ];

            if ($this->model->create($data)) {
                header("Location: ?action=area");
                exit;
            } else {
                echo "<script>alert('Gagal menambahkan area');</script>";
            }
        }

        include './View/Area_Kerja/create.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $id,
                'name' => $_POST['name'],
                'size' => $_POST['size'],
                'quantity_of_trees' => $_POST['quantity_of_trees'],
                'type_of_soil' => $_POST['type_of_soil']
            ];
            $this->model->update($data);
            header("Location: index.php?action=area");
            exit;
        } else {
            $area = $this->model->findById($id);
            include './View/Area_Kerja/edit.php';
        }
    }

    public function delete($id)
    {
        $deleted = $this->model->delete($id);
        if (!$deleted) {
            echo "<script>alert('❗ Area tidak dapat dihapus karena masih digunakan dalam jadwal kerja.'); window.location='index.php?action=area';</script>";
            return;
        }

        // Berhasil dihapus
        header("Location: index.php?action=area");
        exit;
    }
}
