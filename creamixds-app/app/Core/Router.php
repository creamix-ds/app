<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Router con verbos HTTP, parametros en la URL ({id}) y middleware de autenticacion.
 * Reemplaza al router anterior, que exponia cualquier clase y metodo del proyecto
 * a partir de la URL (?url=Controlador/metodo), un riesgo de seguridad conocido.
 */
final class Router
{
    private array $routes = [];

    public function get(string $pattern, array $action, array $middleware = []): void
    {
        $this->add('GET', $pattern, $action, $middleware);
    }

    public function post(string $pattern, array $action, array $middleware = []): void
    {
        $this->add('POST', $pattern, $action, $middleware);
    }

    private function add(string $method, string $pattern, array $action, array $middleware): void
    {
        $regex = preg_replace('#\{([a-z_]+)\}#i', '(?P<$1>[^/]+)', $pattern);
        $this->routes[] = [
            'method'     => $method,
            'regex'      => '#^' . $regex . '$#',
            'action'     => $action,
            'middleware' => $middleware,
        ];
    }

    public function dispatch(Request $request): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $request->method) {
                continue;
            }
            if (!preg_match($route['regex'], $request->path, $matches)) {
                continue;
            }

            foreach ($route['middleware'] as $name) {
                if ($name === 'auth' && !Auth::check()) {
                    Session::set('_intended', $request->path);
                    Response::redirect('/admin/login');
                }
            }

            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            [$class, $method] = $route['action'];
            (new $class())->$method($request, ...array_values($params));
            return;
        }

        (new \App\Controllers\ErrorController())->notFound($request);
    }
}
