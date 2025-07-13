<?php
require_once './Cores/Database7.php';

class jadwal_kerja
{
    private $table = 'schedules';
    private $db;

    public function __construct()
    {
        $this->db = new Database7;
    }

    public function getAll()
    {
        $this->db->query("
            SELECT schedules.*, areas.name AS area_name 
            FROM schedules 
            JOIN areas ON schedules.area_id = areas.id
        ");
        return $this->db->resultSet();
    }

    public function findById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query("
            INSERT INTO {$this->table} 
                (area_id, start_day, finish_day, is_published, description, status)
            VALUES
                (:area_id, :start_day, :finish_day, :is_published, :description, :status)
        ");
        $this->db->bind('area_id', $data['area_id']);
        $this->db->bind('start_day', $data['start_day']);
        $this->db->bind('finish_day', $data['finish_day']);
        $this->db->bind('is_published', $data['is_published']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('status', $data['status']);
        return $this->db->execute();
    }

    public function update($data)
    {
        $this->db->query("
            UPDATE {$this->table}
            SET
                area_id = :area_id,
                start_day = :start_day,
                finish_day = :finish_day,
                is_published = :is_published,
                description = :description,
                status = :status
            WHERE id = :id
        ");
        $this->db->bind('id', $data['id']);
        $this->db->bind('area_id', $data['area_id']);
        $this->db->bind('start_day', $data['start_day']);
        $this->db->bind('finish_day', $data['finish_day']);
        $this->db->bind('is_published', $data['is_published']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('status', $data['status']);
        return $this->db->execute();
    }

    public function delete($id)
    {
        // Cek apakah ada pengajuan yang terkait
        $this->db->query("SELECT COUNT(*) as total FROM applications WHERE schedule_id = :id");
        $this->db->bind('id', $id);
        $check = $this->db->single();

        if ($check['total'] > 0) {
            return false; // Tidak bisa dihapus
        }

        $this->db->query("DELETE FROM $this->table WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }


    public function getAllAreas()
    {
        $this->db->query("SELECT * FROM areas");
        return $this->db->resultSet();
    }

    public function getPublished()
    {
        $this->db->query("
            SELECT s.*, a.name AS area_name
            FROM schedules s
            JOIN areas a ON s.area_id = a.id
            WHERE s.is_published = 1
            ORDER BY s.start_day ASC
        ");
        return $this->db->resultSet();
    }

    public function getJadwalIdsByUser($userId)
    {
        $this->db->query("
            SELECT schedule_id 
            FROM applications
            WHERE user_id = :user_id
        ");
        $this->db->bind('user_id', $userId);
        return $this->db->resultSet(PDO::FETCH_COLUMN);
    }

    public function hasUserApplied($scheduleId, $userId)
    {
        $this->db->query("
            SELECT COUNT(*) as cnt
            FROM applications
            WHERE schedule_id = :schedule_id AND user_id = :user_id
        ");
        $this->db->bind('schedule_id', $scheduleId);
        $this->db->bind('user_id', $userId);
        $row = $this->db->single();
        return $row ? ($row['cnt'] > 0) : false;
    }

    public function applyUser($scheduleId, $userId)
    {
        $this->db->query("
            INSERT INTO applications (schedule_id, user_id)
            VALUES (:schedule_id, :user_id)
        ");
        $this->db->bind('schedule_id', $scheduleId);
        $this->db->bind('user_id', $userId);
        return $this->db->execute();
    }
    public function tandaiSelesaiOtomatis()
    {
        $this->db->query("UPDATE schedules SET status = 'selesai' WHERE finish_day < NOW() AND status != 'selesai'");
        return $this->db->execute();
    }

    public function getSelesaiSchedules()
    {
        $this->db->query("SELECT * FROM schedules WHERE status = 'selesai'");
        return $this->db->resultSet();
    }
}
