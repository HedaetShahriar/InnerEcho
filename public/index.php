<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

session_start();

$router = new Router();

require __DIR__ . '/../routes/web.php';

$router->dispatch();
