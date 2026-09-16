<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Models\Appointment;

class ConsultantController extends Controller
{
    private User $userModel;
    private Appointment $appointmentModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->appointmentModel = new Appointment();
    }

    public function dashboard(): void
    {
        $this->requireRole('consultant');

        $userId = $_SESSION['user_id'];
        $user = $this->userModel->find($userId);
        $appointments = $this->appointmentModel->findByConsultant($userId);

        $this->view('consultant.dashboard', [
            'user' => $user,
            'appointments' => $appointments,
        ]);
    }

    public function profile(): void
    {
        $this->requireRole('consultant');
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->find($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $updateData = [
                'Name' => trim($data['name'] ?? ''),
                'Email' => trim($data['email'] ?? ''),
                'Contact' => trim($data['contact'] ?? ''),
                'consultancyType' => $data['consultancyType'] ?? 'Personal',
            ];

            if (!empty($data['password'])) {
                $updateData['Password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            }

            $this->userModel->update($userId, $updateData);
            $_SESSION['uname'] = $updateData['Name'];
            $this->json(['success' => true]);
        }

        $this->view('consultant.profile', ['user' => $user]);
    }

    public function acceptAppointment(): void
    {
        $this->requireRole('consultant');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $id = (int) ($data['id'] ?? 0);
            $date = $data['date'] ?? date('Y-m-d');

            $this->appointmentModel->updateStatus($id, 'accepted', $date);
            $this->json(['success' => true]);
        }
    }

    public function rejectAppointment(): void
    {
        $this->requireRole('consultant');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $id = (int) ($data['id'] ?? 0);

            $this->appointmentModel->updateStatus($id, 'denied');
            $this->json(['success' => true]);
        }
    }
}
