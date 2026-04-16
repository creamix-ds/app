<?php

class Router
{
    public function dispatch(): void
    {
        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');
        $segments = $url === '' ? [] : explode('/', $url);

        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
        $methodName = $segments[1] ?? 'index';
        $params = array_slice($segments, 2);

        $controllerPath = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (!file_exists($controllerPath)) {
            http_response_code(404);
            echo 'Controlador no encontrado';
            return;
        }

        require_once $controllerPath;

        if (!class_exists($controllerName)) {
            http_response_code(404);
            echo 'Clase controladora no encontrada';
            return;
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $methodName)) {
            http_response_code(404);
            echo 'Método no encontrado';
            return;
        }

        call_user_func_array([$controller, $methodName], $params);
    }
}
