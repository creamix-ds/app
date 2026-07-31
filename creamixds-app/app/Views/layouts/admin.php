<?php
use App\Core\Auth;
use App\Core\Csrf;
use App\Models\Lead;
use function App\Core\e;

$usuario = Auth::user();
$pendientes = (new Lead())->count("status = 'nuevo'");
$actual = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

$menu = [
    '/admin'                => 'Resumen',
    '/admin/consultas'      => 'Consultas',
    '/admin/servicios'      => 'Servicios',
    '/admin/proyectos'      => 'Proyectos',
    '/admin/testimonios'    => 'Testimonios',
    '/admin/beneficios'     => 'Beneficios',
    '/admin/proceso'        => 'Proceso',
    '/admin/estadisticas'   => 'Estadísticas',
    '/admin/configuracion'  => 'Datos del sitio',
];
?>
<!doctype html>
<html lang="es-AR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title><?= e($title ?? 'Panel') ?> — CreaMixds</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400..800&family=IBM+Plex+Mono:wght@400;500&family=Instrument+Sans:wght@400;500;600&display=swap">
<link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="admin">

<aside class="sidebar">
  <a class="sidebar-brand" href="/admin">CreaMixds<span>panel</span></a>
  <nav aria-label="Secciones del panel">
    <ul>
      <?php foreach ($menu as $url => $label): ?>
        <li>
          <a href="<?= e($url) ?>" <?= $actual === $url ? 'aria-current="page"' : '' ?>>
            <?= e($label) ?>
            <?php if ($url === '/admin/consultas' && $pendientes > 0): ?>
              <span class="badge"><?= (int) $pendientes ?></span>
            <?php endif; ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>
  <div class="sidebar-foot">
    <a href="/" target="_blank" rel="noopener">Ver el sitio →</a>
    <form method="post" action="/admin/logout">
      <?= Csrf::field() ?>
      <button type="submit">Cerrar sesión</button>
    </form>
  </div>
</aside>

<div class="admin-main">
  <header class="admin-top">
    <h1><?= e($title ?? 'Panel') ?></h1>
    <span class="who"><?= e($usuario['name'] ?? '') ?></span>
  </header>
  <div class="admin-body">
    <?= $slot ?>
  </div>
</div>

</body>
</html>
