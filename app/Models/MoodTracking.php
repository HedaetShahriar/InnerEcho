<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class MoodTracking extends Model
{
    protected string $table = 'mood_tracking';

    public function findByUser(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY id DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }
}
