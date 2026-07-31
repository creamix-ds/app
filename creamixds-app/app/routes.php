<?php
declare(strict_types=1);

/**
 * Todas las rutas de la aplicacion, declaradas de forma explicita.
 * Lo que no esta en esta lista, no existe: no se puede llamar a un
 * controlador arbitrario desde la URL.
 *
 * @var App\Core\Router $router
 */

use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\BenefitController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\LeadController;
use App\Controllers\Admin\ProcessController;
use App\Controllers\Admin\ProjectController;
use App\Controllers\Admin\ServiceController;
use App\Controllers\Admin\SettingController;
use App\Controllers\Admin\StatController;
use App\Controllers\Admin\TestimonialController;

// --- Sitio publico -------------------------------------------------
$router->get('/', [HomeController::class, 'index']);
$router->post('/contacto', [ContactController::class, 'store']);

// --- Acceso al panel -----------------------------------------------
$router->get('/admin/login', [AuthController::class, 'showLogin']);
$router->post('/admin/login', [AuthController::class, 'login']);
$router->post('/admin/logout', [AuthController::class, 'logout'], ['auth']);

// --- Panel ---------------------------------------------------------
$auth = ['auth'];

$router->get('/admin', [DashboardController::class, 'index'], $auth);

$router->get('/admin/consultas', [LeadController::class, 'index'], $auth);
$router->post('/admin/consultas/{id}/estado', [LeadController::class, 'updateStatus'], $auth);
$router->post('/admin/consultas/{id}/eliminar', [LeadController::class, 'destroy'], $auth);

$router->get('/admin/configuracion', [SettingController::class, 'edit'], $auth);
$router->post('/admin/configuracion', [SettingController::class, 'update'], $auth);
$router->post('/admin/configuracion/clave', [SettingController::class, 'updatePassword'], $auth);

// Recursos con alta, baja y modificacion. Todos comparten el mismo CRUD.
$recursos = [
    'servicios'     => ServiceController::class,
    'proyectos'     => ProjectController::class,
    'testimonios'   => TestimonialController::class,
    'beneficios'    => BenefitController::class,
    'proceso'       => ProcessController::class,
    'estadisticas'  => StatController::class,
];

foreach ($recursos as $slug => $controller) {
    $router->get("/admin/{$slug}",                 [$controller, 'index'],   $auth);
    $router->get("/admin/{$slug}/nuevo",           [$controller, 'create'],  $auth);
    $router->post("/admin/{$slug}",                [$controller, 'store'],   $auth);
    $router->get("/admin/{$slug}/{id}/editar",     [$controller, 'edit'],    $auth);
    $router->post("/admin/{$slug}/{id}",           [$controller, 'update'],  $auth);
    $router->post("/admin/{$slug}/{id}/eliminar",  [$controller, 'destroy'], $auth);
}
