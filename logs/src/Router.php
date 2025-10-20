<?php

namespace Src;

class Router
{
    private $routes = [];

    // Tambahkan route baru
    public function add($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    // Jalankan router
    public function dispatch($requestUri, $requestMethod)
    {
        $path = parse_url($requestUri, PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['path'] === $path && $route['method'] === strtoupper($requestMethod)) {
                [$controller, $action] = explode('@', $route['handler']);
                $controllerClass = "Src\\Controllers\\$controller";

                if (!class_exists($controllerClass)) {
                    http_response_code(500);
                    echo json_encode(["success" => false, "error" => "Controller $controllerClass tidak ditemukan"]);
                    return;
                }

                $controllerInstance = new $controllerClass();
                if (!method_exists($controllerInstance, $action)) {
                    http_response_code(500);
                    echo json_encode(["success" => false, "error" => "Method $action tidak ditemukan"]);
                    return;
                }

                $controllerInstance->$action();
                return;
            }
        }

        // Jika tidak ada route yang cocok
        http_response_code(404);
        echo json_encode(["success" => false, "error" => "Route tidak ditemukan"]);
    }
}
