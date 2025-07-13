<?php
require_once './Model/role_model.php';

class Role
{
    private $model;

    public function __construct()
    {
        $this->model = new Role_Model;
    }

    public function index()
    {
        $roles = $this->model->getAll();
        include './View/Role/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'daily_wage' => $_POST['daily_wage']
            ];
            $this->model->create($data);
            header("Location: index.php?action=role");
            exit;
        }
        include './View/Role/create.php';
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header("Location: index.php?action=role");
        exit;
    }
}
