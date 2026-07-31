<?php
declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function view(string $view, array $data = [], string $layout = 'layouts/public'): void
    {
        View::render($view, $data, $layout);
    }

    protected function redirect(string $path): never
    {
        Response::redirect($path);
    }

    /** Rechaza el POST si el token CSRF no coincide. */
    protected function guardCsrf(Request $request): void
    {
        if (!Csrf::check($request->input('_csrf'))) {
            http_response_code(419);
            exit('La sesion expiro. Volve a cargar la pagina e intentalo de nuevo.');
        }
    }
}
