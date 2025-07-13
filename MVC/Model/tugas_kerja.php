<?php
require_once './Cores/Database7.php';

class tugas_kerja
{
    private $table = 'work_schedules';
    private $db;

    public function __construct()
    {
        $this->db = new Database7;
    }

    public function getAll()
    {
        $this->db->query("SELECT ws.*, u.name AS employee_name, s.description AS schedule_desc 
                          FROM work_schedules ws 
                          JOIN users u ON ws.employee_id = u.id 
                          JOIN schedules s ON ws.schedule_id = s.id");
        return $this->db->resultSet();
    }

    public function getAllSchedules()
    {
        $this->db->query("SELECT * FROM schedules");
        return $this->db->resultSet();
    }

    public function getAllEmployees()
    {
        $this->db->query("SELECT * FROM users WHERE role = 'karyawan'");
        return $this->db->resultSet();
    }

    public function assign($data)
    {
        $this->db->query("INSERT INTO work_schedules (schedule_id, employee_id, status, choice_of_role) 
                          VALUES (:schedule_id, :employee_id, :status, :role)");
        $this->db->bind('schedule_id', $data['schedule_id']);
        $this->db->bind('employee_id', $data['employee_id']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('role', $data['choice_of_role']);
        return $this->db->execute();
    }

    public function getByEmployeeId($employeeId)
    {
        $this->db->query("SELECT ws.*, s.start_day, s.finish_day, s.description, a.name AS area_name
                      FROM work_schedules ws
                      JOIN schedules s ON ws.schedule_id = s.id
                      JOIN areas a ON s.area_id = a.id
                      WHERE ws.employee_id = :id
                      ORDER BY s.start_day ASC");
        $this->db->bind('id', $employeeId);
        return $this->db->resultSet();
    }

    public function getByScheduleId($schedule_id)
{
    $this->db->query("SELECT * FROM work_schedules WHERE schedule_id = :id");
    $this->db->bind('id', $schedule_id);
    return $this->db->resultSet();
}

}
