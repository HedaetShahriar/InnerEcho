<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Appointment extends Model
{
    protected string $table = 'appointments';

    public function findByUser(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT a.*, u.Name as consultant_name 
            FROM {$this->table} a 
            JOIN users u ON a.consultant_id = u.Id 
            WHERE a.user_id = :user_id 
            ORDER BY a.created_at DESC
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function findByConsultant(int $consultantId): array
    {
        $stmt = $this->db->prepare("
            SELECT a.*, u.Name as user_name, u.Email as user_email, u.Contact as user_contact
            FROM {$this->table} a 
            JOIN users u ON a.user_id = u.Id 
            WHERE a.consultant_id = :consultant_id 
            ORDER BY a.created_at DESC
        ");
        $stmt->execute(['consultant_id' => $consultantId]);
        return $stmt->fetchAll();
    }

    public function updateStatus(int $id, string $status, ?string $date = null): bool
    {
        $sql = "UPDATE {$this->table} SET status = :status";
        $params = ['status' => $status, 'id' => $id];

        if ($date !== null) {
            $sql .= ", final_appointment_date = :date";
            $params['date'] = $date;
        }

        $sql .= " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
}
