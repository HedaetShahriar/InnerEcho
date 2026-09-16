<?php

declare(strict_types=1);

namespace App\Controllers;

class HomePageController extends Controller
{
    public function index(): void
    {
        if ($this->isAuthenticated()) {
            $role = $_SESSION['role'] ?? '';
            match ($role) {
                'admin' => $this->redirect('/admin/dashboard'),
                'consultant' => $this->redirect('/consultant/dashboard'),
                'user' => $this->redirect('/user/dashboard'),
                default => $this->redirect('/login'),
            };
        }

        $this->view('home');
    }
}
