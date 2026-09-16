<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class SelfAssessment extends Model
{
    protected string $table = 'self_assessment';

    public function findByUser(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY id DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }
}
