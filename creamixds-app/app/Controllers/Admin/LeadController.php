<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\Lead;

final class LeadController extends Controller
{
    public function index(Request $request): void
    {
        $status = $request->input('estado', '');

        $this->view('admin/leads/index', [
            'title'  => 'Consultas recibidas',
            'leads'  => (new Lead())->latest(200, $status),
            'estado' => $status,
            'ok'     => Session::flash('success'),
        ], 'layouts/admin');
    }

    public function updateStatus(Request $request, string $id): void
    {
        $this->guardCsrf($request);
        (new Lead())->setStatus((int) $id, (string) $request->input('status', 'leido'));
        Session::flash('success', 'Estado actualizado.');
        $this->redirect('/admin/consultas');
    }

    public function destroy(Request $request, string $id): void
    {
        $this->guardCsrf($request);
        (new Lead())->delete((int) $id);
        Session::flash('success', 'Consulta eliminada.');
        $this->redirect('/admin/consultas');
    }
}
