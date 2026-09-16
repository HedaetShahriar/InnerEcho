<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Notification extends Model
{
    protected string $table = 'notifications';

    public function findUnread(int $userId): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table} 
            WHERE user_id = :user_id AND is_read = '0' 
            ORDER BY created_at DESC
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function markAsRead(int $userId): bool
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET is_read = '1' WHERE user_id = :user_id AND is_read = '0'");
        return $stmt->execute(['user_id' => $userId]);
    }

    public function hasUnread(int $userId): bool
    {
        return $this->count(['user_id' => $userId, 'is_read' => '0']) > 0;
    }
}
