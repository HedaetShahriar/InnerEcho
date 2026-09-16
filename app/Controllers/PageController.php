<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;

class PageController extends Controller
{
    public function about(): void
    {
        $this->view('about');
    }

    public function therapist(): void
    {
        $userModel = new User();
        $therapists = $userModel->getConsultants();
        $this->view('therapist', ['therapists' => $therapists]);
    }
}
