<?php
use App\Core\Csrf;
use function App\Core\e;

// Se muestran como columnas los dos primeros campos de texto del recurso.
$columnas = array_slice(array_values(array_filter($fields, static fn ($f) => ($f['type'] ?? 'text') !== 'checkbox')), 0, 3);
?>

<?php if (!empty($ok)): ?><p class="alert alert--ok"><?= e($ok) ?></p><?php endif; ?>

<div class="panel-head">
  <p class="muted"><?= count($items) ?> elemento<?= count($items) === 1 ? '' : 's' ?></p>
  <a class="button" href="/admin/<?= e($slug) ?>/nuevo">Agregar</a>
</div>

<?php if (!$items): ?>
  <p class="empty">Todavía no hay nada acá. Usá «Agregar» para crear el primero.</p>
<?php else: ?>
  <table class="table-wide">
    <thead>
      <tr>
        <?php foreach ($columnas as $c): ?><th><?= e($c['label']) ?></th><?php endforeach; ?>
        <th>Visible</th>
        <th><span class="sr-only">Acciones</span></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $item): ?>
        <tr>
          <?php foreach ($columnas as $c): ?>
            <td><?= e(App\Core\Str::truncate((string) ($item[$c['name']] ?? ''), 90)) ?></td>
          <?php endforeach; ?>
          <td><?= !empty($item['is_active']) ? 'Sí' : 'No' ?></td>
          <td class="row-actions">
            <a class="ghost" href="/admin/<?= e($slug) ?>/<?= (int) $item['id'] ?>/editar">Editar</a>
            <form method="post" action="/admin/<?= e($slug) ?>/<?= (int) $item['id'] ?>/eliminar"
                  onsubmit="return confirm('¿Eliminar «<?= e($item['title'] ?? $item['author'] ?? 'este elemento') ?>»?')">
              <?= Csrf::field() ?>
              <button type="submit" class="ghost danger">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
