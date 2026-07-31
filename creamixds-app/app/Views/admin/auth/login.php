<?php
use App\Core\Csrf;
use function App\Core\e;
?>
<main class="login">
  <form method="post" action="/admin/login" class="login-card">
    <?= Csrf::field() ?>
    <p class="login-eyebrow">CreaMixds</p>
    <h1>Acceso al panel</h1>

    <?php if (!empty($error)): ?>
      <p class="alert alert--error"><?= e($error) ?></p>
    <?php endif; ?>

    <label for="email">Email</label>
    <input id="email" name="email" type="email" autocomplete="username" required autofocus>

    <label for="password">Contraseña</label>
    <input id="password" name="password" type="password" autocomplete="current-password" required>

    <button type="submit">Entrar</button>
    <a class="login-back" href="/">← Volver al sitio</a>
  </form>
</main>
