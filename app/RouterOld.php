<?php

class Router
{
    private array $routes = [   // La structure finale ressemble à :
        'GET' => [],            // $routes['GET']['/test'] = [ControllerClassName, 'methodName'];
        'POST' => [],           // $routes['POST']['/login'] = [ControllerClassName, 'authenticate'];
    ];                          // Le type array $action représente un “couple” [contrôleur, méthode].

    public function get(string $path, array $action): void   // ajoute une route GET (chemin + action) et ne retourne rien (void).
    {
        $this->routes['GET'][$path] = $action;               // signifie “dans la sous-table GET, à la clé $path, stocker le tableau $action”.
    }

    public function post(string $path, array $action): void
    {
        $this->routes['POST'][$path] = $action;
    }

    public function dispatch(string $uri, string $method): void // reçoit l’URI demandée et la méthode HTTP, puis calcule $path = parse_url($uri,
    {
        $path = parse_url($uri, PHP_URL_PATH);          // PHP_URL_PATH); pour ne garder que le chemin sans la query string (ex: /test au lieu de /test?id=42)
                                                        // On extrait juste le chemin (ex: /test) sans les paramètres (?id=42)
        if (isset($this->routes[$method][$path])) {     // vérifie si une route existe exactement pour ce couple (méthode, chemin).
            [$controller, $action] = $this->routes[$method][$path]; // [$controller, $action] = ... est une déstructuration de tableau
                                                                    // on récupère les deux éléments (classe contrôleur, nom de méthode) en deux variables.
            $controllerInstance = new $controller();    //  instancie la classe dont le nom est dans la variable (instanciation dynamique).
            $controllerInstance->$action();             // appelle une méthode dont le nom est dans une variable (appel dynamique).
            return;
        }

        http_response_code(404);
        echo 'Page non trouvée';
    }
}
