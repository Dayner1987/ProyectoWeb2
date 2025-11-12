<?php

namespace Dell5480\BackEnd\Core;

class Router
{
    private $routes = [];

    public function add($method, $uri, $callback)
    {
        $this->routes[] = compact('method', 'uri', 'callback');
    }

    public function run()
    {
        $method = $_SERVER["REQUEST_METHOD"];
        $uri = trim($_SERVER["REQUEST_URI"], "/");

        foreach ($this->routes as $route) {

            if ($route["method"] == $method && $route["uri"] == $uri) {
                return call_user_func($route["callback"]);
            }
        }

        http_response_code(404);
        echo json_encode(["error" => "Ruta no encontrada"]);
    }
}
