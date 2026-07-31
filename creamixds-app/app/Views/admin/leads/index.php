<?php
use App\Core\Csrf;
use function App\Core\e;

$filtros = ['' => 'Todas', 'nuevo' => 'Sin leer', 'leido' => 'Leídas', 'respondido' => 'Respondidas', 'archivado' => 'Archivadas'];
?>

<?php if (!empty($ok)): ?><p class="alert alert--ok"><?= e($ok) ?></p><?php endif; ?>

<div class="filters">
  <?php foreach ($filtros as $valor => $label): ?>
    <a class="filter <?= $estado === $valor ? 'is-active' : '' ?>"
       href="/admin/consultas<?= $valor === '' ? '' : '?estado=' . e($valor) ?>"><?= e($label) ?></a>
  <?php endforeach; ?>
</div>

<?php if (!$leads): ?>
  <p class="empty">No hay consultas con este filtro.</p>
<?php else: ?>
  <div class="leads">
    <?php foreach ($leads as $l): ?>
      <article class="lead-card">
        <header>
          <div>
            <h2><?= e($l['name']) ?><?= $l['company'] ? ' — ' . e($l['company']) : '' ?></h2>
            <p class="lead-meta">
              <a href="mailto:<?= e($l['email']) ?>"><?= e($l['email']) ?></a>
              · <?= e($l['service']) ?>
              · <?= e(date('d/m/Y H:i', strtotime((string) $l['created_at']))) ?>
            </p>
          </div>
          <span class="pill pill--<?= e($l['status']) ?>"><?= e($l['status']) ?></span>
        </header>

        <p class="lead-text"><?= nl2br(e($l['message'])) ?></p>

        <footer class="lead-actions">
          <?php foreach (['leido' => 'Marcar leída', 'respondido' => 'Marcar respondida', 'archivado' => 'Archivar'] as $st => $label): ?>
            <?php if ($l['status'] !== $st): ?>
              <form method="post" action="/admin/consultas/<?= (int) $l['id'] ?>/estado">
                <?= Csrf::field() ?>
                <input type="hidden" name="status" value="<?= e($st) ?>">
                <button type="submit" class="ghost"><?= e($label) ?></button>
              </form>
            <?php endif; ?>
          <?php endforeach; ?>

          <a class="ghost" href="mailto:<?= e($l['email']) ?>?subject=Tu%20consulta%20en%20CreaMixds">Responder</a>

          <form method="post" action="/admin/consultas/<?= (int) $l['id'] ?>/eliminar"
                onsubmit="return confirm('¿Eliminar esta consulta? No se puede deshacer.')">
            <?= Csrf::field() ?>
            <button type="submit" class="ghost danger">Eliminar</button>
          </form>
        </footer>
      </article>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
