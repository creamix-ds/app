<?php
use App\Core\Csrf;
use function App\Core\e;

$accion = $item === null
    ? '/admin/' . $slug
    : '/admin/' . $slug . '/' . (int) $item['id'];

/** Valor a mostrar: lo reenviado tras un error, o lo guardado, o el default. */
$valor = static function (string $name, $default = '') use ($old, $item) {
    if (array_key_exists($name, $old)) { return $old[$name]; }
    if (is_array($item) && array_key_exists($name, $item)) { return $item[$name]; }
    return $default;
};
?>

<form method="post" action="<?= e($accion) ?>" class="form-card">
  <?= Csrf::field() ?>

  <?php foreach ($fields as $f):
      $name = $f['name'];
      $type = $f['type'] ?? 'text';
      $error = $errors[$name] ?? null;
  ?>
    <div class="form-row <?= $error ? 'has-error' : '' ?>">
      <?php if ($type === 'checkbox'): ?>
        <label class="check">
          <input type="checkbox" name="<?= e($name) ?>" value="1"
            <?= ($item === null || !empty($valor($name, 1))) ? 'checked' : '' ?>>
          <span><?= e($f['label']) ?></span>
        </label>

      <?php else: ?>
        <label for="f_<?= e($name) ?>"><?= e($f['label']) ?></label>

        <?php if ($type === 'textarea'): ?>
          <textarea id="f_<?= e($name) ?>" name="<?= e($name) ?>" rows="4"><?= e($valor($name)) ?></textarea>
        <?php else: ?>
          <input id="f_<?= e($name) ?>" name="<?= e($name) ?>"
                 type="<?= $type === 'number' ? 'number' : 'text' ?>"
                 value="<?= e($valor($name, $type === 'number' ? '0' : '')) ?>">
        <?php endif; ?>

        <?php if (!empty($f['hint'])): ?>
          <p class="hint"><?= e($f['hint']) ?></p>
        <?php endif; ?>
      <?php endif; ?>

      <?php if ($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?>
    </div>
  <?php endforeach; ?>

  <div class="form-actions">
    <button type="submit" class="button">Guardar</button>
    <a class="ghost" href="/admin/<?= e($slug) ?>">Cancelar</a>
  </div>
</form>
