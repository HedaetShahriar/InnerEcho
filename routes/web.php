<?php

declare(strict_types=1);

/** @var App\Core\Router $router */

use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Controllers\UserController;
use App\Controllers\ConsultantController;
use App\Controllers\HomePageController;
use App\Controllers\PageController;

// Auth routes
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/signup', [AuthController::class, 'showSignup']);
$router->post('/signup', [AuthController::class, 'signup']);
$router->post('/logout', [AuthController::class, 'logout']);

// Admin routes
$router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
$router->get('/admin/users', [AdminController::class, 'users']);
$router->get('/admin/consultants', [AdminController::class, 'consultants']);
$router->get('/admin/add-user', [AdminController::class, 'addUser']);
$router->post('/admin/add-user', [AdminController::class, 'addUser']);
$router->get('/admin/add-consultant', [AdminController::class, 'addConsultant']);
$router->post('/admin/add-consultant', [AdminController::class, 'addConsultant']);
$router->post('/admin/users/update', [AdminController::class, 'updateUser']);
$router->post('/admin/users/delete', [AdminController::class, 'deleteUser']);

// User routes
$router->get('/user/dashboard', [UserController::class, 'dashboard']);
$router->get('/user/profile', [UserController::class, 'profile']);
$router->post('/user/profile', [UserController::class, 'profile']);
$router->post('/user/appointment/book', [UserController::class, 'bookAppointment']);
$router->post('/user/mood/track', [UserController::class, 'trackMood']);
$router->post('/user/assessment/track', [UserController::class, 'trackAssessment']);
$router->post('/user/journal/save', [UserController::class, 'saveJournal']);
$router->get('/user/notifications', [UserController::class, 'getNotifications']);
$router->post('/user/notifications/read', [UserController::class, 'markNotificationsRead']);

// Consultant routes
$router->get('/consultant/dashboard', [ConsultantController::class, 'dashboard']);
$router->get('/consultant/profile', [ConsultantController::class, 'profile']);
$router->post('/consultant/profile', [ConsultantController::class, 'profile']);
$router->post('/consultant/appointment/accept', [ConsultantController::class, 'acceptAppointment']);
$router->post('/consultant/appointment/reject', [ConsultantController::class, 'rejectAppointment']);

// Home
$router->get('/', [HomePageController::class, 'index']);

// Public pages
$router->get('/about', [PageController::class, 'about']);
$router->get('/therapist', [PageController::class, 'therapist']);
