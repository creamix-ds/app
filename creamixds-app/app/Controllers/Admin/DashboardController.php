<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Block;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Testimonial;

final class DashboardController extends Controller
{
    public function index(Request $request): void
    {
        $leads = new Lead();

        $this->view('admin/dashboard', [
            'title'        => 'Resumen',
            'nuevos'       => $leads->count("status = 'nuevo'"),
            'totalLeads'   => $leads->count(),
            'ultimos'      => $leads->latest(5),
            'servicios'    => count((new Block())->ofType('service', false)),
            'proyectos'    => (new Project())->count(),
            'testimonios'  => (new Testimonial())->count(),
        ], 'layouts/admin');
    }
}
