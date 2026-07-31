<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Mailer;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\Validator;
use App\Models\Lead;

/**
 * Recibe el formulario de contacto. Guarda en base de datos y avisa por email.
 * Responde JSON si la peticion vino por fetch, o redirige si vino de un form clasico.
 */
final class ContactController extends Controller
{
    public function store(Request $request): void
    {
        $this->guardCsrf($request);

        // Campo trampa: los bots lo completan, las personas no lo ven.
        if ($request->input('empresa_alt') !== '' && $request->input('empresa_alt') !== null) {
            $this->respond($request, true, 'Gracias por tu consulta.');
        }

        $data = [
            'name'    => $request->input('nombre', ''),
            'email'   => $request->input('email', ''),
            'company' => $request->input('marca', ''),
            'service' => $request->input('servicio', ''),
            'message' => $request->input('mensaje', ''),
        ];

        $validator = (new Validator($data))
            ->check('name', 'tu nombre', 'required|max:120')
            ->check('email', 'el email', 'required|email|max:190')
            ->check('company', 'la marca', 'max:160')
            ->check('message', 'el mensaje', 'required|min:10|max:4000');

        if ($validator->fails()) {
            $this->respond($request, false, (string) $validator->firstError(), 422);
        }

        $leads = new Lead();

        if ($leads->tooManyFrom($request->ip())) {
            $this->respond($request, false, 'Ya recibimos varias consultas tuyas. Escribinos por email y seguimos por ahi.', 429);
        }

        $data['ip']         = $request->ip();
        $data['user_agent'] = $request->userAgent();
        $data['status']     = 'nuevo';

        $leads->create($data);
        Mailer::notifyNewLead($data);

        $this->respond($request, true, 'Listo. Te respondemos en menos de 24 h habiles.');
    }

    private function respond(Request $request, bool $ok, string $message, int $status = 200): never
    {
        if ($request->isJson()) {
            Response::json(['ok' => $ok, 'message' => $message], $status);
        }

        Session::flash($ok ? 'success' : 'error', $message);
        Response::redirect('/#contacto');
    }
}
