<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\MoodTracking;
use App\Models\SelfAssessment;
use App\Models\Journal;

class UserController extends Controller
{
    private User $userModel;
    private Appointment $appointmentModel;
    private Notification $notificationModel;
    private MoodTracking $moodModel;
    private SelfAssessment $assessmentModel;
    private Journal $journalModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->appointmentModel = new Appointment();
        $this->notificationModel = new Notification();
        $this->moodModel = new MoodTracking();
        $this->assessmentModel = new SelfAssessment();
        $this->journalModel = new Journal();
    }

    public function dashboard(): void
    {
        $this->requireRole('user');

        $userId = $_SESSION['user_id'];
        $user = $this->userModel->find($userId);
        $hasUnread = $this->notificationModel->hasUnread($userId);
        $consultants = $this->userModel->getConsultants();

        $this->view('user.dashboard', [
            'user' => $user,
            'hasUnread' => $hasUnread,
            'consultants' => $consultants,
        ]);
    }

    public function profile(): void
    {
        $this->requireRole('user');
        $userId = $_SESSION['user_id'];
        $user = $this->userModel->find($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $updateData = [
                'Name' => trim($data['name'] ?? ''),
                'Email' => trim($data['email'] ?? ''),
                'Contact' => trim($data['contact'] ?? ''),
            ];

            if (!empty($data['password'])) {
                $updateData['Password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            }

            $this->userModel->update($userId, $updateData);
            $_SESSION['uname'] = $updateData['Name'];
            $this->json(['success' => true]);
        }

        $this->view('user.profile', ['user' => $user]);
    }

    public function bookAppointment(): void
    {
        $this->requireRole('user');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $userId = $_SESSION['user_id'];

            $this->appointmentModel->create([
                'user_id' => $userId,
                'consultant_id' => (int) $data['consultant'],
                'preferred_day' => $data['preferredDay'],
                'preferred_time' => $data['preferredTime'],
                'status' => 'pending',
            ]);

            $this->json(['success' => true]);
        }
    }

    public function trackMood(): void
    {
        $this->requireRole('user');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $description = trim($data['moodDescription'] ?? '');

            if (empty($description)) {
                $this->json(['success' => false, 'message' => 'Mood description is required'], 400);
                return;
            }

            $this->moodModel->create([
                'user_id' => $_SESSION['user_id'],
                'mood_description' => htmlspecialchars($description),
            ]);

            $this->json(['success' => true]);
        }
    }

    public function trackAssessment(): void
    {
        $this->requireRole('user');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();

            $this->assessmentModel->create([
                'user_id' => $_SESSION['user_id'],
                'stress_level' => (int) ($data['stress'] ?? 1),
                'happiness_level' => (int) ($data['happiness'] ?? 1),
                'anxiety_level' => (int) ($data['anxiety'] ?? 1),
                'energy_level' => (int) ($data['energy'] ?? 1),
                'sleep_quality' => (int) ($data['sleep'] ?? 1),
            ]);

            $this->json(['success' => true]);
        }
    }

    public function saveJournal(): void
    {
        $this->requireRole('user');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getPostData();
            $title = trim($data['journalTitle'] ?? '');
            $content = trim($data['journalContent'] ?? '');

            if (empty($title) || empty($content)) {
                $this->json(['success' => false, 'message' => 'Title and content are required'], 400);
                return;
            }

            $this->journalModel->create([
                'user_id' => $_SESSION['user_id'],
                'title' => htmlspecialchars($title),
                'content' => htmlspecialchars($content),
            ]);

            $this->json(['success' => true]);
        }
    }

    public function getNotifications(): void
    {
        $this->requireRole('user');
        $notifications = $this->notificationModel->findUnread($_SESSION['user_id']);
        $this->json(['notifications' => $notifications]);
    }

    public function markNotificationsRead(): void
    {
        $this->requireRole('user');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->notificationModel->markAsRead($_SESSION['user_id']);
            $this->json(['success' => true]);
        }
    }
}
