<?php use function App\Core\e; ?>

<div class="stats">
  <a class="stat" href="/admin/consultas?estado=nuevo">
    <span class="stat-num"><?= (int) $nuevos ?></span>
    <span class="stat-label">Consultas sin leer</span>
  </a>
  <div class="stat">
    <span class="stat-num"><?= (int) $totalLeads ?></span>
    <span class="stat-label">Consultas totales</span>
  </div>
  <a class="stat" href="/admin/servicios">
    <span class="stat-num"><?= (int) $servicios ?></span>
    <span class="stat-label">Servicios</span>
  </a>
  <a class="stat" href="/admin/proyectos">
    <span class="stat-num"><?= (int) $proyectos ?></span>
    <span class="stat-label">Proyectos</span>
  </a>
</div>

<section class="panel">
  <div class="panel-head">
    <h2>Últimas consultas</h2>
    <a class="link" href="/admin/consultas">Ver todas</a>
  </div>

  <?php if (!$ultimos): ?>
    <p class="empty">Todavía no llegó ninguna consulta. Cuando alguien complete el formulario del sitio, va a aparecer acá.</p>
  <?php else: ?>
    <table>
      <thead><tr><th>Fecha</th><th>Nombre</th><th>Email</th><th>Servicio</th><th>Estado</th></tr></thead>
      <tbody>
        <?php foreach ($ultimos as $l): ?>
          <tr>
            <td><?= e(date('d/m/Y H:i', strtotime((string) $l['created_at']))) ?></td>
            <td><?= e($l['name']) ?></td>
            <td><a href="mailto:<?= e($l['email']) ?>"><?= e($l['email']) ?></a></td>
            <td><?= e($l['service']) ?></td>
            <td><span class="pill pill--<?= e($l['status']) ?>"><?= e($l['status']) ?></span></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</section>
