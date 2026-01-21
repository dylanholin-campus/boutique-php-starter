<?php

declare(strict_types=1);

class Router
{
    /**
     * @var array{
     *     GET: array<string, array{0: class-string, 1: string}>,
     *     POST: array<string, array{0: class-string, 1: string}>
     * }
     */
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * @param array{0: class-string, 1: string} $action
     */
    public function get(string $path, array $action): void
    {
        $this->routes['GET'][$path] = $action;
    }

    /**
     * @param array{0: class-string, 1: string} $action
     */
    public function post(string $path, array $action): void
    {
        $this->routes['POST'][$path] = $action;
    }

    public function dispatch(string $uri, string $method): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$path])) {
            [$controller, $action] = $this->routes[$method][$path];
            $controllerInstance = new $controller();
            $controllerInstance->$action();
            return;
        }

        http_response_code(404);
        echo 'Page non trouvée';
    }
}
