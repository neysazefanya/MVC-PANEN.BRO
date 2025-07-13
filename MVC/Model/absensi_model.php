<?php
require_once './Cores/Database7.php';

class Absence
{
    private $db;

    public function __construct()
    {
        $this->db = new Database7;
    }

    public function hasCheckedInToday($work_schedule_id)
    {
        $sql = "SELECT COUNT(*) as cnt
                FROM absences
                WHERE work_schedule_id = :work_schedule_id
                  AND type = 'check-in'
                  AND DATE(created_at) = CURDATE()";
        $this->db->query($sql);
        $this->db->bind('work_schedule_id', $work_schedule_id);
        return $this->db->single()['cnt'] > 0;
    }

    public function hasCheckedOutToday($work_schedule_id)
    {
        $sql = "SELECT COUNT(*) as cnt
                FROM absences
                WHERE work_schedule_id = :work_schedule_id
                  AND type = 'check-out'
                  AND DATE(created_at) = CURDATE()";
        $this->db->query($sql);
        $this->db->bind('work_schedule_id', $work_schedule_id);
        return $this->db->single()['cnt'] > 0;
    }

    public function checkIn($work_schedule_id)
    {
        // Query insert pakai NOW() supaya jam otomatis
        $sql = "INSERT INTO absences (work_schedule_id, type, created_at)
            VALUES (:work_schedule_id, 'check-in', NOW())";

        $this->db->query($sql);
        $this->db->bind('work_schedule_id', $work_schedule_id);
        return $this->db->execute();
    }


    public function checkOut($work_schedule_id, $quantity, $status_of_duty, $notes)
    {
        $sql = "INSERT INTO absences (work_schedule_id, type, quantity, status_of_duty, notes)
                VALUES (:work_schedule_id, 'check-out', :quantity, :status_of_duty, :notes)";
        $this->db->query($sql);
        $this->db->bind('work_schedule_id', $work_schedule_id);
        $this->db->bind('quantity', $quantity);
        $this->db->bind('status_of_duty', $status_of_duty);
        $this->db->bind('notes', $notes);
        return $this->db->execute();
    }

    public function hitungHadir($work_schedule_id)
{
    $this->db->query("SELECT COUNT(*) as total FROM absences WHERE work_schedule_id = :id AND type = 'check-in'");
    $this->db->bind('id', $work_schedule_id);
    $res = $this->db->single();
    return $res['total'] ?? 0;
}


public function getScheduleById($work_schedule_id)
    {
        $sql = "
        SELECT s.*
        FROM work_schedules ws
        JOIN schedules s ON s.id = ws.schedule_id
        WHERE ws.id = :id
    ";
        $this->db->query($sql);
        $this->db->bind('id', $work_schedule_id);
        return $this->db->single();
    } 
}
