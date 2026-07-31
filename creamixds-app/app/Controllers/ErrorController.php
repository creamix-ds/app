<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Setting;

final class ErrorController extends Controller
{
    public function notFound(Request $request): void
    {
        http_response_code(404);

        if ($request->isJson()) {
            Response::json(['ok' => false, 'error' => 'Recurso no encontrado'], 404);
        }

        $this->view('errors/404', ['site' => (new Setting())->map()]);
    }
}
