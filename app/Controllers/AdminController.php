<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Notification;

class AdminController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function dashboard(): void
    {
        $this->requireRole('admin');

        $totalUsers = $this->userModel->count(['Role' => 'user']);
        $totalConsultants = $this->userModel->count(['Role' => 'consultant']);

        $this->view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalConsultants' => $totalConsultants,
        ]);
    }

    public function users(): void
    {
        $this->requireRole('admin');
        $users = $this->userModel->getUsers();
        $this->view('admin.users', ['users' => $users]);
    }

    public function consultants(): void
    {
        $this->requireRole('admin');
        $consultants = $this->userModel->getConsultants();
        $this->view('admin.consultants', ['consultants' => $consultants]);
    }

    public function addUser(): void
    {
        $this->requireRole('admin');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $this->userModel->create([
                'Name' => trim($data['fullname'] ?? ''),
                'Email' => trim($data['email'] ?? ''),
                'Contact' => trim($data['contact'] ?? ''),
                'Password' => password_hash($data['password'] ?? '', PASSWORD_BCRYPT),
                'Role' => 'user',
            ]);
            $this->json(['success' => true]);
        }

        $this->view('admin.add-user');
    }

    public function addConsultant(): void
    {
        $this->requireRole('admin');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $this->userModel->create([
                'Name' => trim($data['fullname'] ?? ''),
                'Email' => trim($data['email'] ?? ''),
                'Contact' => trim($data['contact'] ?? ''),
                'Password' => password_hash($data['password'] ?? '', PASSWORD_BCRYPT),
                'Role' => 'consultant',
                'consultancyType' => $data['consultancyType'] ?? 'Personal',
            ]);
            $this->json(['success' => true]);
        }

        $this->view('admin.add-consultant');
    }

    public function updateUser(): void
    {
        $this->requireRole('admin');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $id = (int) ($data['id'] ?? 0);

            $updateData = [
                'Name' => trim($data['name'] ?? ''),
                'Email' => trim($data['email'] ?? ''),
                'Contact' => trim($data['contact'] ?? ''),
            ];

            if (!empty($data['password'])) {
                $updateData['Password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            }

            $this->userModel->update($id, $updateData);
            $this->json(['success' => true]);
        }
    }

    public function deleteUser(): void
    {
        $this->requireRole('admin');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $id = (int) ($data['id'] ?? 0);
            $this->userModel->delete($id);
            $this->json(['success' => true]);
        }
    }
}
