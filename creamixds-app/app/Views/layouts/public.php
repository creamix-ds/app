<?php
use App\Core\Csrf;
use function App\Core\e;

$site = $site ?? [];
$brand = $site['brand'] ?? 'CreaMixds';
?>
<!doctype html>
<html lang="es-AR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($site['site_title'] ?? $brand) ?></title>
<meta name="description" content="<?= e($site['site_description'] ?? '') ?>">
<link rel="canonical" href="<?= e(rtrim((string) App\Core\Config::get('APP_URL', ''), '/')) ?>/">
<meta name="robots" content="index, follow, max-image-preview:large">

<meta property="og:type" content="website">
<meta property="og:locale" content="es_AR">
<meta property="og:site_name" content="<?= e($brand) ?>">
<meta property="og:title" content="<?= e($site['site_title'] ?? $brand) ?>">
<meta property="og:description" content="<?= e($site['site_description'] ?? '') ?>">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" href="/assets/logo.png" type="image/png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400..800&family=IBM+Plex+Mono:wght@400;500&family=Instrument+Sans:wght@400;500;600&display=swap">
<link rel="stylesheet" href="/assets/css/site.css">

<script type="application/ld+json">
<?= json_encode([
    '@context'    => 'https://schema.org',
    '@type'       => 'ProfessionalService',
    'name'        => $brand,
    'url'         => App\Core\Config::get('APP_URL', ''),
    'description' => $site['site_description'] ?? '',
    'email'       => $site['email'] ?? '',
    'telephone'   => isset($site['whatsapp']) ? '+' . $site['whatsapp'] : '',
    'address'     => ['@type' => 'PostalAddress', 'addressCountry' => 'AR'],
    'areaServed'  => ['@type' => 'Country', 'name' => $site['location'] ?? 'Argentina'],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
</head>
<body>
<a class="skip" href="#contenido">Saltar al contenido</a>

<header class="site-header">
  <div class="wrap bar">
    <a class="brand" href="/"><img src="/assets/logo.png" alt="" width="30" height="30"><?= e($brand) ?></a>
    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-principal">Menú</button>
    <nav class="nav" id="nav-principal" aria-label="Navegación principal">
      <a href="#servicios">Servicios</a>
      <a href="#proceso">Proceso</a>
      <a href="#proyectos">Proyectos</a>
      <a href="#testimonios">Testimonios</a>
      <a class="btn" href="#contacto">Pedir presupuesto</a>
    </nav>
  </div>
</header>

<main id="contenido"><?= $slot ?></main>

<footer class="site-footer">
  <div class="wrap">
    <div class="top">
      <div>
        <h2><?= e($brand) ?></h2>
        <p>Diseño y desarrollo web a medida. Sitios, sistemas y automatizaciones para negocios de <?= e($site['location'] ?? 'Argentina') ?>.</p>
      </div>
      <div>
        <h3>Secciones</h3>
        <ul>
          <li><a href="#servicios">Servicios</a></li>
          <li><a href="#proceso">Proceso</a></li>
          <li><a href="#proyectos">Proyectos</a></li>
          <li><a href="#contacto">Contacto</a></li>
        </ul>
      </div>
      <div>
        <h3>Contacto</h3>
        <ul>
          <?php if (!empty($site['email'])): ?>
            <li><a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a></li>
          <?php endif; ?>
          <?php if (!empty($site['whatsapp'])): ?>
            <li><a href="https://wa.me/<?= e($site['whatsapp']) ?>" rel="noopener">WhatsApp</a></li>
          <?php endif; ?>
          <?php if (!empty($site['instagram_url'])): ?>
            <li><a href="<?= e($site['instagram_url']) ?>" rel="noopener">Instagram</a></li>
          <?php endif; ?>
          <?php if (!empty($site['linkedin_url'])): ?>
            <li><a href="<?= e($site['linkedin_url']) ?>" rel="noopener">LinkedIn</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
    <div class="legal">
      <span>© <?= date('Y') ?> <?= e($brand) ?>. Todos los derechos reservados.</span>
      <a href="/admin">Administrar sitio</a>
    </div>
  </div>
</footer>

<script src="/assets/js/site.js" defer></script>
</body>
</html>
