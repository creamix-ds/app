<?php
use App\Core\Csrf;
use App\Core\Session;
use function App\Core\e;

$flashOk    = Session::flash('success');
$flashError = Session::flash('error');
?>

<!-- ============ HERO ============ -->
<section class="hero" id="inicio">
  <div class="wrap grid">
    <div>
      <p class="eyebrow">Estudio digital · <?= e($site['location'] ?? 'Argentina') ?></p>
      <h1><?= e($site['hero_title'] ?? '') ?></h1>
      <p class="lead"><?= e($site['hero_subtitle'] ?? '') ?></p>
      <div class="hero-actions">
        <a class="btn" href="#contacto">Pedir presupuesto</a>
        <a class="btn btn--ghost" href="#proyectos">Ver proyectos</a>
      </div>
      <p class="hero-note">Respuesta en menos de 24 h hábiles · Presupuesto cerrado, sin sorpresas</p>
    </div>

    <div class="overprint" aria-hidden="true">
      <span class="disc disc-a"></span>
      <span class="disc disc-b"></span>
      <?php if ($stats): ?>
      <div class="spec">
        <dl>
          <?php foreach (array_slice($stats, 0, 4) as $stat): ?>
            <dt><?= e($stat['description']) ?></dt><dd><?= e($stat['title']) ?></dd>
          <?php endforeach; ?>
        </dl>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ============ BENEFICIOS ============ -->
<?php if ($benefits): ?>
<section class="section section--tight">
  <div class="wrap benefits">
    <?php foreach ($benefits as $b): ?>
      <article class="benefit reveal">
        <h3><?= e($b['title']) ?></h3>
        <p><?= e($b['description']) ?></p>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- ============ SERVICIOS ============ -->
<?php if ($services): ?>
<section class="section section--ink" id="servicios">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Servicios</p>
      <h2>Diseño, desarrollo y automatización bajo un mismo techo.</h2>
      <p class="lead">No hace falta coordinar tres proveedores distintos. Nos encargamos del diseño, del código que lo sostiene y de los procesos que te ahorran horas cada semana.</p>
    </div>
    <div class="cards reveal">
      <?php foreach ($services as $s): ?>
        <article class="card">
          <span class="swatch"></span>
          <h3><?= e($s['title']) ?></h3>
          <p><?= e($s['description']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ PROCESO ============ -->
<?php if ($process): ?>
<section class="section" id="proceso">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Cómo trabajamos</p>
      <h2>Cuatro etapas, sin misterio.</h2>
      <p class="lead">Sabés en qué punto está tu proyecto en todo momento y qué se espera de vos en cada etapa.</p>
    </div>
    <ol class="steps reveal">
      <?php foreach ($process as $p): ?>
        <li class="step">
          <span class="num">Etapa <?= e($p['icon']) ?></span>
          <h3><?= e($p['title']) ?></h3>
          <p><?= e($p['description']) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
<?php endif; ?>

<!-- ============ PROYECTOS ============ -->
<?php if ($projects): ?>
<section class="section section--top0" id="proyectos">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Proyectos</p>
      <h2>Trabajos entregados.</h2>
      <p class="lead">Cada proyecto arrancó con una conversación parecida a la que podemos tener con vos.</p>
    </div>
    <div class="caps reveal">
      <?php foreach ($projects as $pr): ?>
        <article class="cap">
          <span class="tag"><?= e($pr['tag']) ?></span>
          <h3><?= e($pr['title']) ?></h3>
          <p><?= e($pr['description']) ?></p>
          <?php if (!empty($pr['url'])): ?>
            <a class="cap-link" href="<?= e($pr['url']) ?>" target="_blank" rel="noopener">
              Ver el sitio<span aria-hidden="true"> →</span>
              <span class="sr-only"> de <?= e($pr['title']) ?> (se abre en una pestaña nueva)</span>
            </a>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ NOSOTROS ============ -->
<section class="band" id="nosotros">
  <div class="wrap grid">
    <div class="reveal">
      <p class="eyebrow">Nosotros</p>
      <h2>Estética con criterio, no decoración.</h2>
    </div>
    <div class="reveal">
      <p><?= e($site['about_text'] ?? '') ?></p>
      <p>Cada decisión de diseño responde a una pregunta concreta: ¿esto ayuda a que la persona haga lo que vino a hacer? Lo que no aporta, se saca.</p>
    </div>
  </div>
</section>

<!-- ============ TESTIMONIOS ============ -->
<?php if ($testimonials): ?>
<section class="section" id="testimonios">
  <div class="wrap">
    <div class="section-head reveal">
      <p class="eyebrow">Testimonios</p>
      <h2>Lo que dicen los clientes.</h2>
    </div>
    <div class="quotes reveal">
      <?php foreach ($testimonials as $t): ?>
        <figure class="quote">
          <blockquote><?= e($t['quote']) ?></blockquote>
          <figcaption>
            <strong><?= e($t['author']) ?></strong>
            <span><?= e($t['role']) ?></span>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ============ CONTACTO ============ -->
<section class="section section--ink" id="contacto">
  <div class="wrap contact-grid">
    <div class="contact-side reveal">
      <p class="eyebrow">Contacto</p>
      <h2>Contanos tu idea.</h2>
      <p class="lead">Escribinos qué necesitás y en menos de 24 h hábiles te respondemos con una primera orientación de alcance y plazos, sin compromiso.</p>
      <ul>
        <?php if (!empty($site['email'])): ?>
          <li><a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a></li>
        <?php endif; ?>
        <?php if (!empty($site['whatsapp'])): ?>
          <li><a href="https://wa.me/<?= e($site['whatsapp']) ?>" rel="noopener">WhatsApp</a></li>
        <?php endif; ?>
      </ul>
    </div>

    <form id="contact-form" method="post" action="/contacto">
      <?= Csrf::field() ?>

      <div class="field">
        <label for="nombre">Nombre</label>
        <input id="nombre" name="nombre" type="text" autocomplete="name" required maxlength="120">
      </div>
      <div class="field">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" autocomplete="email" required maxlength="190">
      </div>
      <div class="field">
        <label for="marca">Marca o negocio</label>
        <input id="marca" name="marca" type="text" autocomplete="organization" maxlength="160">
      </div>
      <div class="field">
        <label for="servicio">Servicio</label>
        <select id="servicio" name="servicio">
          <option value="diseno-web">Diseño web</option>
          <option value="sitio-corporativo">Sitio corporativo</option>
          <option value="landing">Landing page</option>
          <option value="ecommerce">Tienda online</option>
          <option value="sistema">Backend o sistema a medida</option>
          <option value="otro">Otro</option>
        </select>
      </div>
      <div class="field field--full">
        <label for="mensaje">Contanos el proyecto</label>
        <textarea id="mensaje" name="mensaje" rows="4" required maxlength="4000"
          placeholder="Qué hacés, qué necesitás resolver y para cuándo."></textarea>
      </div>

      <div class="hp" aria-hidden="true">
        <label for="empresa-alt">No completar</label>
        <input id="empresa-alt" name="empresa_alt" type="text" tabindex="-1" autocomplete="off">
      </div>

      <div class="form-foot">
        <button class="btn" type="submit">Enviar consulta</button>
        <p class="form-msg" id="form-msg" role="status" aria-live="polite"
           <?php if ($flashOk): ?>data-state="ok"<?php elseif ($flashError): ?>data-state="error"<?php endif; ?>>
          <?= e($flashOk ?? $flashError ?? '') ?>
        </p>
      </div>
      <p class="privacy">Usamos tus datos solo para responderte esta consulta. No los compartimos con terceros.</p>
    </form>
  </div>
</section>
