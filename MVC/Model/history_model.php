<?php
require_once './Cores/Database7.php';

class History
{
    private $db;

    public function __construct()
    {
        $this->db = new Database7;
    }

    public function getAll()
    {
        $this->db->query("
        SELECT h.*, u.name AS user_name, s.description AS schedule_desc
        FROM histories h
        JOIN users u ON h.user_id = u.id
        JOIN schedules s ON h.schedule_id = s.id
        ORDER BY h.created_at DESC
    ");
        return $this->db->resultSet();
    }


    public function insert($data)
    {
        $this->db->query("INSERT INTO histories 
            (user_id, schedule_id, work_schedule_id, days_worked, total_wage, description)
            VALUES (:uid, :sid, :wsid, :days, :wage, :desc)");

        $this->db->bind('uid', $data['user_id']);
        $this->db->bind('sid', $data['schedule_id']);
        $this->db->bind('wsid', $data['work_schedule_id']);
        $this->db->bind('days', $data['days_worked']);
        $this->db->bind('wage', $data['total_wage']);
        $this->db->bind('desc', $data['description']);

        return $this->db->execute();
    }

    public function clearRelatedData($work_schedule_id)
    {
        $this->db->query("DELETE FROM absences WHERE work_schedule_id = :id");
        $this->db->bind('id', $work_schedule_id);
        $this->db->execute();
    }

    public function isArchived($schedule_id)
    {
        $this->db->query("SELECT COUNT(*) as total FROM histories WHERE schedule_id = :sid");
        $this->db->bind('sid', $schedule_id);
        $res = $this->db->single();
        return $res['total'] > 0;
    }

    public function getByUser($userId)
    {
        $this->db->query("
        SELECT h.*, u.name AS user_name, s.description AS schedule_desc
        FROM histories h
        JOIN users u ON h.user_id = u.id
        JOIN schedules s ON h.schedule_id = s.id
        WHERE h.user_id = :uid
        ORDER BY h.created_at DESC
    ");
        $this->db->bind('uid', $userId);
        return $this->db->resultSet();
    }
}
