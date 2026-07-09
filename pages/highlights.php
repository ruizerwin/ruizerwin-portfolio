<?php

declare(strict_types=1);

$highlights = [
    [
        'icon'  => 'bi-shield-check',
        'title' => 'Production Reliability',
        'text'  => 'Long-term support for business-critical PHP systems — stable deployments, clear debugging, and dependable maintenance.',
    ],
    [
        'icon'  => 'bi-speedometer2',
        'title' => 'Performance Focus',
        'text'  => 'Database tuning, caching strategy, and front-end optimization that translate into measurable gains in speed and stability.',
    ],
    [
        'icon'  => 'bi-people',
        'title' => 'Remote Collaboration',
        'text'  => 'Clear communication with stakeholders and cross-functional teams across North America, from requirements to delivery.',
    ],
    [
        'icon'  => 'bi-layers',
        'title' => 'Full-Stack Depth',
        'text'  => 'Backend architecture, APIs, CMS customization, and cloud hosting — one developer who understands the full stack.',
    ],
    [
        'icon'  => 'bi-plug',
        'title' => 'Integration Expertise',
        'text'  => 'REST APIs, payment gateways, shipping services, and third-party business tools wired into reliable workflows.',
    ],
    [
        'icon'  => 'bi-cpu',
        'title' => 'Growing in AI / ML',
        'text'  => 'Currently studying AI & Machine Learning at Fanshawe College — applying data-driven thinking to modern web systems.',
    ],
];
?>

<section id="highlights" class="highlights section">

    <div class="container section-title" data-aos="fade-up">
        <h2><?= e('Why Work With Me'); ?></h2>
        <p><?= e('What clients and teams can expect when we collaborate on a project.'); ?></p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">
            <?php foreach ($highlights as $index => $highlight): ?>
                <div class="col-lg-4 col-md-6">
                    <article
                        class="highlight-card"
                        data-aos="fade-up"
                        data-aos-delay="<?= e((string) (120 + ($index * 80))); ?>">
                        <div class="highlight-icon">
                            <i class="bi <?= e($highlight['icon']); ?>"></i>
                        </div>
                        <h3><?= e($highlight['title']); ?></h3>
                        <p><?= e($highlight['text']); ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="highlights-cta text-center" data-aos="fade-up" data-aos-delay="200">
            <p><?= e('Freelance · Contract · Remote — based in London, Ontario'); ?></p>
            <div class="highlights-cta-actions">
                <a href="#contact" class="btn btn-primary"><?= e('Start a Conversation'); ?></a>
                <?php if (resume_pdf_available()): ?>
                    <a
                        href="<?= e(resume_pdf_url()); ?>"
                        class="btn btn-outline-primary btn-resume-download"
                        download="Erwin_Padilla_Resume.pdf"
                        data-track="resume-download">
                        <i class="bi bi-download"></i>
                        <?= e('Download Resume'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</section>
