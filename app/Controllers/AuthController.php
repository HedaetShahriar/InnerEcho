<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLogin(): void
    {
        if ($this->isAuthenticated()) {
            $this->redirectByRole();
        }
        $this->view('auth.login');
    }

    public function login(): void
    {
        $data = $this->getPostData();
        $name = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';

        $user = $this->userModel->findByCredentials($name);

        if (!$user || !password_verify($password, $user['Password'])) {
            $this->view('auth.login', ['error' => 'Invalid username or password']);
            return;
        }

        if (password_needs_rehash($user['Password'], PASSWORD_BCRYPT)) {
            $this->userModel->update((int) $user['Id'], [
                'Password' => password_hash($password, PASSWORD_BCRYPT),
            ]);
        }

        $_SESSION['user_id'] = (int) $user['Id'];
        $_SESSION['uname'] = $user['Name'];
        $_SESSION['role'] = $user['Role'];

        $this->redirectByRole();
    }

    public function showSignup(): void
    {
        if ($this->isAuthenticated()) {
            $this->redirectByRole();
        }
        $this->view('auth.signup');
    }

    public function signup(): void
    {
        $data = $this->getPostData();

        $name = trim($data['fullname'] ?? '');
        $email = trim($data['email'] ?? '');
        $contact = trim($data['contact'] ?? '');
        $password = $data['password'] ?? '';

        if (empty($name) || empty($email) || empty($contact) || empty($password)) {
            $this->json(['success' => false, 'message' => 'All fields are required'], 400);
            return;
        }

        $existing = $this->userModel->findByEmail($email);
        if ($existing) {
            $this->json(['success' => false, 'message' => 'Email already registered'], 400);
            return;
        }

        $this->userModel->create([
            'Name' => $name,
            'Email' => $email,
            'Contact' => $contact,
            'Password' => password_hash($password, PASSWORD_BCRYPT),
            'Role' => 'user',
        ]);

        $this->json(['success' => true]);
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect('/login');
    }

    private function redirectByRole(): void
    {
        $role = $_SESSION['role'] ?? '';

        match ($role) {
            'admin' => $this->redirect('/admin/dashboard'),
            'consultant' => $this->redirect('/consultant/dashboard'),
            'user' => $this->redirect('/user/dashboard'),
            default => $this->redirect('/login'),
        };
    }
}
