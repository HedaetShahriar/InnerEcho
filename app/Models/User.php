<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected string $table = 'users';

    public function findByCredentials(string $name): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE Name = :name LIMIT 1");
        $stmt->execute(['name' => $name]);
        return $stmt->fetch() ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE Email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }

    public function getConsultants(): array
    {
        $stmt = $this->db->query("SELECT Id, Name, Email, Contact, consultancyType, image FROM {$this->table} WHERE Role = 'consultant'");
        return $stmt->fetchAll();
    }

    public function getUsers(): array
    {
        $stmt = $this->db->query("SELECT Id, Name, Email, Contact, Role, image FROM {$this->table} WHERE Role = 'user'");
        return $stmt->fetchAll();
    }

    public function getAllUsers(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY Id DESC");
        return $stmt->fetchAll();
    }
}
