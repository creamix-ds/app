<?php
use App\Core\Csrf;
use function App\Core\e;

$largos = ['site_description', 'hero_subtitle', 'about_text'];
?>

<?php if (!empty($ok)): ?><p class="alert alert--ok"><?= e($ok) ?></p><?php endif; ?>
<?php if (!empty($error)): ?><p class="alert alert--error"><?= e($error) ?></p><?php endif; ?>

<form method="post" action="/admin/configuracion" class="form-card">
  <?= Csrf::field() ?>
  <p class="muted">Estos datos alimentan el encabezado, el pie y las etiquetas SEO del sitio.</p>

  <?php foreach ($settings as $s): ?>
    <div class="form-row">
      <label for="s_<?= e($s['key_name']) ?>"><?= e($s['label']) ?></label>
      <?php if (in_array($s['key_name'], $largos, true)): ?>
        <textarea id="s_<?= e($s['key_name']) ?>" name="s_<?= e($s['key_name']) ?>" rows="3"><?= e($s['value']) ?></textarea>
      <?php else: ?>
        <input id="s_<?= e($s['key_name']) ?>" name="s_<?= e($s['key_name']) ?>" type="text" value="<?= e($s['value']) ?>">
      <?php endif; ?>
    </div>
  <?php endforeach; ?>

  <div class="form-actions">
    <button type="submit" class="button">Guardar cambios</button>
  </div>
</form>

<form method="post" action="/admin/configuracion/clave" class="form-card">
  <?= Csrf::field() ?>
  <h2>Cambiar contraseña</h2>

  <div class="form-row">
    <label for="actual">Contraseña actual</label>
    <input id="actual" name="actual" type="password" autocomplete="current-password" required>
  </div>
  <div class="form-row">
    <label for="nueva">Contraseña nueva</label>
    <input id="nueva" name="nueva" type="password" autocomplete="new-password" required minlength="10">
    <p class="hint">Mínimo 10 caracteres.</p>
  </div>

  <div class="form-actions">
    <button type="submit" class="button">Actualizar contraseña</button>
  </div>
</form>
