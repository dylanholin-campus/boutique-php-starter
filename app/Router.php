<?php

class Router
{
    private array $routes = [];

    public function get(string $path, array $action): void
    {
        $this->routes['GET'][$path] = $action;
    }

    public function post(string $path, array $action): void
    {
        $this->routes['POST'][$path] = $action;
    }

    public function dispatch(string $uri, string $method): void
    {
        // On extrait juste le chemin (ex: /test) sans les paramètres (?id=42)
        $path = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$path])) {
            [$controller, $action] = $this->routes[$method][$path];
            
            // On instancie la classe et on appelle la méthode
            $controllerInstance = new $controller();
            $controllerInstance->$action();
        } else {
            http_response_code(404);
            echo "Page non trouvée";
        }
    }
}
