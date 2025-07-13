<?php
require_once './Cores/Database7.php';

class seleksi_penempatan
{
    private $db;
    private $table = 'applications';

    public function __construct()
    {
        $this->db = new Database7;
    }

    public function getAllApplications()
    {
        $this->db->query("
        SELECT 
            a.*, 
            u.name AS user_name, 
            s.description AS schedule_desc,
            GROUP_CONCAT(r.name SEPARATOR ', ') AS skills
        FROM applications a
        JOIN users u ON a.user_id = u.id
        JOIN schedules s ON a.schedule_id = s.id
        LEFT JOIN user_roles ur ON ur.user_id = u.id
        LEFT JOIN roles r ON r.id = ur.role_id
        GROUP BY a.id
        ORDER BY a.created_at DESC
    ");
        return $this->db->resultSet();
    }


    public function getAppliedScheduleIds($user_id)
    {
        $sql = "SELECT schedule_id FROM applications WHERE user_id = :user_id";
        $this->db->query($sql);
        $this->db->bind('user_id', $user_id);
        return $this->db->resultSet();
    }


    public function apply($userId, $scheduleId)
    {
        $this->db->query("INSERT INTO $this->table (user_id, schedule_id) VALUES (:user_id, :schedule_id)");
        $this->db->bind('user_id', $userId);
        $this->db->bind('schedule_id', $scheduleId);
        return $this->db->execute();
    }

    public function updateStatus($id, $status)
    {
        $this->db->query("UPDATE $this->table SET status = :status WHERE id = :id");
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function findById($id)
    {
        $this->db->query("SELECT a.*, u.name AS user_name, s.description AS schedule_desc 
                      FROM applications a 
                      JOIN users u ON a.user_id = u.id 
                      JOIN schedules s ON a.schedule_id = s.id 
                      WHERE a.id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }


    public function getPengajuanSaya($user_id)
    {
        $sql = "
        SELECT 
            a.id, 
            a.schedule_id, 
            a.status, 
            j.start_day, 
            j.finish_day, 
            j.description, 
            area.name AS area_name
        FROM applications a
        JOIN schedules j ON a.schedule_id = j.id
        JOIN areas area ON j.area_id = area.id
        WHERE a.user_id = :user_id
        ORDER BY j.start_day DESC
    ";

        $this->db->query($sql);
        $this->db->bind('user_id', $user_id);
        return $this->db->resultSet();
    }
}
