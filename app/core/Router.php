<?php
namespace App\config;
class Routeur{
   
    public static function resolve(array $route){

 
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $Uris = trim($requestUri, '/');

        if (isset($route[$Uris])) {

            $route = $route[$Uris];
        
                // if (isset($route['middleware'])) {
                //     Middleware::execute($route['middleware']);
                // }
            

            $controllerClass = $route['controller'];
            $method = $route['method'];
            $controller = new $controllerClass();
            $controller->$method();
        } else {
            echo "404 Not Found";
        }


    
    }


}