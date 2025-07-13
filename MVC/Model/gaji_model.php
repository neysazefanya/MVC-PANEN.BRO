<?php
require_once './Cores/Database7.php';

class Gaji
{
    private $db;

    public function __construct()
    {
        $this->db = new Database7;
    }

    // Ambil semua data gaji
    public function getAll()
    {
        $this->db->query("SELECT w.*, u.name AS user_name, r.name AS role_name, r.daily_wage 
                          FROM wages w
                          JOIN users u ON w.user_id = u.id
                          JOIN roles r ON w.role_id = r.id
                          ORDER BY w.created_at DESC");
        return $this->db->resultSet();
    }

    // Generate gaji berdasarkan pekerjaan & role
    public function generate($user_id)
    {
        // Hitung jumlah hari kerja dari absences check-in
        $this->db->query("SELECT COUNT(*) AS total FROM absences a 
                      JOIN work_schedules ws ON ws.id = a.work_schedule_id 
                      WHERE ws.employee_id = :uid AND a.type = 'check-in'");
        $this->db->bind('uid', $user_id);
        $result = $this->db->single();
        $hari = $result['total'] ?? 0;

        // Ambil nama role user dari work_schedules (terbaru)
        $this->db->query("SELECT choice_of_role FROM work_schedules 
                      WHERE employee_id = :uid ORDER BY id DESC LIMIT 1");
        $this->db->bind('uid', $user_id);
        $row = $this->db->single();
        if (!$row) return false;
        $roleName = $row['choice_of_role'];

        // Ambil ID dan gaji harian dari roles
        $this->db->query("SELECT id, daily_wage FROM roles WHERE name = :name");
        $this->db->bind('name', $roleName);
        $roleData = $this->db->single();
        if (!$roleData) return false;

        $total = $hari * $roleData['daily_wage'];

        // Simpan ke tabel wages
        $this->db->query("INSERT INTO wages (user_id, role_id, days_worked, total_wage)
                      VALUES (:uid, :rid, :days, :total)");
        $this->db->bind('uid', $user_id);
        $this->db->bind('rid', $roleData['id']);
        $this->db->bind('days', $hari);
        $this->db->bind('total', $total);

        return $this->db->execute();
    }


    public function markPaid($id)
    {
        $this->db->query("UPDATE wages SET is_paid = 1 WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function getMyWages($user_id)
    {
        $this->db->query("SELECT w.*, r.name AS role_name, r.daily_wage 
                          FROM wages w
                          JOIN roles r ON w.role_id = r.id
                          WHERE w.user_id = :uid
                          ORDER BY w.created_at DESC");
        $this->db->bind('uid', $user_id);
        return $this->db->resultSet();
    }

    public function requestWithdrawal($id)
    {
        $this->db->query("UPDATE wages SET requested_by_employee = 1 WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function generateAll()
    {
        // Ambil semua kombinasi user + work_schedule yang ada absensinya (dan belum digaji)
        $this->db->query("
        SELECT DISTINCT ws.employee_id AS user_id, ws.id AS work_schedule_id
        FROM work_schedules ws
        JOIN absences a ON a.work_schedule_id = ws.id
        WHERE a.type = 'check-in'
        AND ws.id NOT IN (SELECT work_schedule_id FROM wages WHERE work_schedule_id IS NOT NULL)
    ");
        $list = $this->db->resultSet();

        foreach ($list as $item) {
            $this->generateBySchedule($item['user_id'], $item['work_schedule_id']);
        }
    }

    public function generateBySchedule($user_id, $schedule_id)
{
    // Hitung jumlah hari kerja dari absences check-in
    $this->db->query("SELECT COUNT(*) AS total FROM absences 
                      WHERE work_schedule_id = :sid AND type = 'check-in'");
    $this->db->bind('sid', $schedule_id);
    $result = $this->db->single();
    $hari = $result['total'] ?? 0;

    // Ambil choice_of_role dari work_schedule
    $this->db->query("SELECT choice_of_role FROM work_schedules WHERE id = :sid");
    $this->db->bind('sid', $schedule_id);
    $row = $this->db->single();
    if (!$row) return false;
    $roleName = $row['choice_of_role'];

    // Ambil info role
    $this->db->query("SELECT id, daily_wage FROM roles WHERE name = :name");
    $this->db->bind('name', $roleName);
    $roleData = $this->db->single();
    if (!$roleData) return false;

    $total = $hari * $roleData['daily_wage'];

    // Simpan ke wages
    $this->db->query("INSERT INTO wages (user_id, role_id, days_worked, total_wage, work_schedule_id)
                      VALUES (:uid, :rid, :days, :total, :sid)");
    $this->db->bind('uid', $user_id);
    $this->db->bind('rid', $roleData['id']);
    $this->db->bind('days', $hari);
    $this->db->bind('total', $total);
    $this->db->bind('sid', $schedule_id);

    return $this->db->execute();
}

}
