<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-wrapper">
    <nav class="navbar">
        <div class="nav-content container-custom">
            <div class="logo-text"><?= htmlspecialchars($content['site']['brand']) ?></div>
            <ul class="nav-links">
                <?php foreach ($content['nav'] as $item): ?>
                    <li><a href="<?= htmlspecialchars($item['href']) ?>"><?= htmlspecialchars($item['label']) ?></a></li>
                <?php endforeach; ?>
            </ul>
            <a href="#contacto" class="nav-cta">Contactar</a>
        </div>
    </nav>

    <section id="inicio" class="hero">
        <div class="container-custom hero-content">
            <div class="hero-box">
                <span class="pill">Agencia digital creativa</span>
                <h1><?= htmlspecialchars($content['hero']['title']) ?></h1>
                <p><?= htmlspecialchars($content['hero']['subtitle']) ?></p>
                <div class="hero-buttons">
                    <a href="<?= htmlspecialchars($content['hero']['button']['href']) ?>" class="btn-secondary">
                        <?= htmlspecialchars($content['hero']['button']['label']) ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<section class="benefits section-soft">
    <div class="container-custom benefits-grid">
        <?php foreach ($content['benefits'] as $benefit): ?>
            <div class="benefit-card">
                <div class="benefit-icon"><?= htmlspecialchars($benefit['icon']) ?></div>
                <h3><?= htmlspecialchars($benefit['title']) ?></h3>
                <p><?= htmlspecialchars($benefit['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section id="servicios" class="section section-dark">
    <div class="container-custom">
        <div class="section-header center light">
            <div class="section-badge"><?= htmlspecialchars($content['services_section']['badge']) ?></div>
            <h2 class="section-title"><?= htmlspecialchars($content['services_section']['title']) ?></h2>
            <p class="section-subtitle"><?= htmlspecialchars($content['services_section']['subtitle']) ?></p>
        </div>

        <div class="services-grid">
            <?php foreach ($content['services'] as $service): ?>
                <div class="service-card-modern">
                    <div class="service-icon-box"><i data-lucide="<?= htmlspecialchars($service['icon']) ?>"></i></div>
                    <h3><?= htmlspecialchars($service['title']) ?></h3>
                    <p><?= htmlspecialchars($service['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="proceso" class="section">
    <div class="container-custom">
        <div class="section-header center">
            <div class="section-badge"><?= htmlspecialchars($content['process_section']['badge']) ?></div>
            <h2 class="section-title"><?= htmlspecialchars($content['process_section']['title']) ?></h2>
            <p class="section-subtitle"><?= htmlspecialchars($content['process_section']['subtitle']) ?></p>
        </div>

        <div class="process-steps">
            <?php foreach ($content['process_steps'] as $step): ?>
                <div class="process-step">
                    <div class="step-number"><?= htmlspecialchars((string)$step['number']) ?></div>
                    <h3><?= htmlspecialchars($step['title']) ?></h3>
                    <p><?= htmlspecialchars($step['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="portafolio" class="section">
    <div class="container-custom">
        <div class="section-header center">
            <div class="section-badge"><?= htmlspecialchars($content['portfolio_section']['badge']) ?></div>
            <h2 class="section-title"><?= htmlspecialchars($content['portfolio_section']['title']) ?></h2>
            <p class="section-subtitle"><?= htmlspecialchars($content['portfolio_section']['subtitle']) ?></p>
        </div>

        <div class="portfolio-grid">
            <?php foreach ($content['portfolio'] as $project): ?>
                <div class="portfolio-card">
                    <div class="portfolio-image"><?= htmlspecialchars($project['emoji']) ?></div>
                    <div class="portfolio-content">
                        <span class="portfolio-tag"><?= htmlspecialchars($project['tag']) ?></span>
                        <h3><?= htmlspecialchars($project['title']) ?></h3>
                        <p><?= htmlspecialchars($project['description']) ?></p>
                        <a href="<?= htmlspecialchars($project['url']) ?>" target="_blank" rel="noopener noreferrer" class="portfolio-link">Ver proyecto →</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-warm">
    <div class="container-custom">
        <div class="section-header center">
            <div class="section-badge"><?= htmlspecialchars($content['testimonials_section']['badge']) ?></div>
            <h2 class="section-title"><?= htmlspecialchars($content['testimonials_section']['title']) ?></h2>
            <p class="section-subtitle"><?= htmlspecialchars($content['testimonials_section']['subtitle']) ?></p>
        </div>

        <div class="testimonials-grid">
            <?php foreach ($content['testimonials'] as $testimonial): ?>
                <div class="testimonial-card">
                    <div class="quote-icon">&quot;</div>
                    <p class="testimonial-text"><?= htmlspecialchars($testimonial['text']) ?></p>
                    <div class="testimonial-author">
                        <div class="author-avatar"><?= htmlspecialchars($testimonial['avatar']) ?></div>
                        <div class="author-info">
                            <h4><?= htmlspecialchars($testimonial['name']) ?></h4>
                            <p><?= htmlspecialchars($testimonial['role']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="trust-stats">
            <?php foreach ($content['stats'] as $stat): ?>
                <div class="trust-stat">
                    <div class="trust-icon"><?= htmlspecialchars($stat['icon']) ?></div>
                    <div class="trust-number"><?= htmlspecialchars($stat['number']) ?></div>
                    <div class="trust-label"><?= htmlspecialchars($stat['label']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container-custom cta-content">
        <h2><?= htmlspecialchars($content['cta']['title']) ?></h2>
        <p><?= htmlspecialchars($content['cta']['subtitle']) ?></p>
        <a href="<?= htmlspecialchars($content['cta']['button']['href']) ?>" class="btn-primary">
            <?= htmlspecialchars($content['cta']['button']['label']) ?>
        </a>
    </div>
</section>

<section id="contacto" class="section">
    <div class="container-custom">
        <div class="section-header center">
            <div class="section-badge"><?= htmlspecialchars($content['contact']['badge']) ?></div>
            <h2 class="section-title"><?= htmlspecialchars($content['contact']['title']) ?></h2>
            <p class="section-subtitle"><?= htmlspecialchars($content['contact']['subtitle']) ?></p>
        </div>

        <div class="botones-contacto">
            <?php foreach ($content['contact']['buttons'] as $button): ?>
                <a href="<?= htmlspecialchars($button['href']) ?>" class="btn-contacto">
                    <?= htmlspecialchars($button['label']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<footer>
    <div class="container-custom footer-content">
        <div class="footer-logo"><?= htmlspecialchars($content['site']['brand']) ?></div>
        <p class="footer-text"><?= htmlspecialchars($content['site']['description']) ?></p>
        <p class="footer-text">Para más información detallada escribinos a <?= htmlspecialchars($content['site']['email']) ?></p>
        <div class="footer-links">
            <?php foreach ($content['nav'] as $item): ?>
                <a href="<?= htmlspecialchars($item['href']) ?>"><?= htmlspecialchars($item['label']) ?></a>
            <?php endforeach; ?>
            <a href="#contacto">Contacto</a>
        </div>
        <div class="footer-bottom">
            <p><?= htmlspecialchars($content['site']['year']) ?> <?= htmlspecialchars($content['site']['brand']) ?> - <?= htmlspecialchars($content['site']['location']) ?></p>
        </div>
    </div>
</footer>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
