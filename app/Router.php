<?php

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    private function toRegex(string $pattern): string
    {
        $regex = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $pattern);
        return '#^' . $regex . '$#';
    }

    public function get(string $pattern, array $action): void
    {
        $this->routes['GET'][$this->toRegex($pattern)] = $action;
    }

    public function post(string $pattern, array $action): void
    {
        $this->routes['POST'][$this->toRegex($pattern)] = $action;
    }

    public function dispatch(string $uri, string $method): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes[$method] ?? [] as $regex => $action) {
            if (preg_match($regex, $path, $matches)) {
                [$controller, $methodName] = $action;

                $params = [];
                foreach ($matches as $k => $v) {
                    if (!is_int($k)) {
                        $params[$k] = $v;
                    }
                }

                $controllerInstance = new $controller();

                if (!empty($params)) {
                    $controllerInstance->$methodName($params);
                } else {
                    $controllerInstance->$methodName();
                }
                return;
            }
        }

        http_response_code(404);
        echo "Page non trouvée";
    }
}
