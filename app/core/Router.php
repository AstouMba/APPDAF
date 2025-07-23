<?php
namespace App\Core;

use App\Config\Middlewares;

class Router
{
    public static function resolve(array $routes)
    {
        // Nettoyage de l’URI
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/'); // supprime le slash final sauf si c’est la racine
        $uri = $uri === '' ? '/' : $uri;

        $method = $_SERVER['REQUEST_METHOD'];

        // Format attendu : $routes['/path']['GET'] ou ['POST']
        if (isset($routes[$uri]) && isset($routes[$uri][$method])) {
            $route = $routes[$uri][$method];

            // // Middleware éventuel
            // if (isset($route['middleware'])) {
            //     $middlewares = Middlewares::getMiddlewares();
            //     $middlewareKey = $route['middleware'];

            //     if (isset($middlewares[$middlewareKey])) {
            //         $middleware = $middlewares[$middlewareKey];
            //         $middleware(); // Exécution
            //     }
            // }

            $controllerName = $route['controller'];
            $actionName = $route['action'];

            $controller = new $controllerName();
            $controller->$actionName();
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => "Route non trouvée : $method $uri"
            ]);
        }
    }
}
