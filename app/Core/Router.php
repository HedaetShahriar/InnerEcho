<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array|callable $action): self
    {
        $this->routes['GET'][$path] = $action;
        return $this;
    }

    public function post(string $path, array|callable $action): self
    {
        $this->routes['POST'][$path] = $action;
        return $this;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];

            if (is_callable($action)) {
                $action();
                return;
            }

            [$controllerClass, $methodName] = $action;
            $controller = new $controllerClass();
            $controller->$methodName();
            return;
        }

        http_response_code(404);
        echo '404 - Page Not Found';
    }
}
