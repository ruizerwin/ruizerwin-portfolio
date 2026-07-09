<?php

declare(strict_types=1);
?>

<section id="portfolio" class="portfolio section">

    <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Selected systems and projects — with brief case-study highlights from real engagements.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">

            <?php
            $projects = [
                [
                    'title'       => 'JBI Internal System',
                    'subtitle'    => 'ERP / Operations Platform',
                    'description' => 'Long-running B2B platform for order flow, RGA, invoicing, shipping, reporting, and secure admin operations.',
                    'impact'      => '15+ years of production support',
                    'results'     => [
                        'Built business-critical tools used daily across North American operations.',
                        'Integrated SQL Server, MySQL, UPS APIs, and payment gateways.',
                        'Optimized queries and workflows to reduce response times significantly.',
                    ],
                    'case_study'  => [
                        'role'     => 'PHP / Web Developer — Remote',
                        'challenge' => 'Maintain and extend a large-scale B2B system serving customers across North America while keeping deployments stable.',
                        'approach'  => 'Custom PHP applications, reusable business modules, database-driven reporting, and long-term production support on Linux and Windows hosting.',
                        'outcome'   => 'Reliable internal tooling for order handling, invoicing, shipping, and admin workflows — supported for more than a decade.',
                    ],
                    'tech'        => ['PHP', 'MySQL', 'SQL Server', 'jQuery', 'Bootstrap'],
                    'image'       => 'assets/img/portfolio/jbimporters.jpg',
                    'demo'        => '',
                    'details'     => '',
                    'status'      => 'Private Project',
                ],
                [
                    'title'       => 'Haya Solutions API Integration',
                    'subtitle'    => 'API Integration / Backend',
                    'description' => 'REST API endpoints and reusable backend components to connect third-party services with cleaner architecture.',
                    'impact'      => '20% faster development',
                    'results'     => [
                        'Built RESTful APIs with CodeIgniter for third-party integrations.',
                        'Improved development speed through reusable components.',
                        'Extended platform features with maintainable custom functions.',
                    ],
                    'case_study'  => [
                        'role'     => 'Web Developer — Remote',
                        'challenge' => 'Connect external services quickly without creating fragile, one-off integration code.',
                        'approach'  => 'RESTful API design in CodeIgniter with shared components and clear separation between integration and business logic.',
                        'outcome'   => 'Roughly 20% improvement in development time and easier maintenance for future client requirements.',
                    ],
                    'tech'        => ['CodeIgniter', 'PHP', 'MySQL', 'REST API'],
                    'image'       => 'assets/img/portfolio/haya_solutions.jpg',
                    'demo'        => '',
                    'details'     => '',
                    'status'      => 'Private Project',
                ],
                [
                    'title'       => 'Drupal Optimization Project',
                    'subtitle'    => 'CMS Performance / Front-End',
                    'description' => 'Drupal CMS performance, custom modules, and responsive front-end work using Twig and Bootstrap.',
                    'impact'      => '30% faster load times',
                    'results'     => [
                        'Created and optimized Drupal features for speed and stability.',
                        'Built custom modules for business logic and new functionality.',
                        'Reduced load time by 30% through optimization and structure improvements.',
                    ],
                    'case_study'  => [
                        'role'     => 'Drupal Developer — Remote',
                        'challenge' => 'Improve CMS performance and deliver modern, mobile-friendly interfaces without sacrificing maintainability.',
                        'approach'  => 'Custom Drupal modules, Twig templates, Bootstrap layouts, and targeted performance tuning across content structure.',
                        'outcome'   => '30% reduction in load time with a more stable, responsive front-end experience.',
                    ],
                    'tech'        => ['Drupal', 'Twig', 'Bootstrap', 'PHP'],
                    'image'       => 'assets/img/portfolio/y_partners.jpg',
                    'demo'        => '',
                    'details'     => '',
                    'status'      => 'Client Work',
                ],
            ];

            foreach ($projects as $index => $project):
                $demo_url = trim((string) $project['demo']);
                $details_url = trim((string) $project['details']);
                $caseStudyJson = htmlspecialchars(
                    json_encode($project['case_study'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    ENT_QUOTES,
                    'UTF-8'
                );
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-card h-100" data-portfolio-card>
                        <div class="portfolio-card-image">
                            <img
                                src="<?= e($project['image']); ?>"
                                alt="<?= e($project['title']); ?>"
                                class="img-fluid"
                                loading="lazy">
                            <?php if (!empty($project['impact'])): ?>
                                <span class="portfolio-impact-badge"><?= e($project['impact']); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="portfolio-card-body">
                            <span class="portfolio-card-subtitle"><?= e($project['subtitle']); ?></span>
                            <h3><?= e($project['title']); ?></h3>
                            <p><?= e($project['description']); ?></p>

                            <?php if (!empty($project['results'])): ?>
                                <ul class="portfolio-results">
                                    <?php foreach ($project['results'] as $result): ?>
                                        <li><?= e($result); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <div class="portfolio-tech">
                                <?php foreach ($project['tech'] as $tech): ?>
                                    <span><?= e($tech); ?></span>
                                <?php endforeach; ?>
                            </div>

                            <?php if (!empty($project['status'])): ?>
                                <div class="portfolio-status"><?= e($project['status']); ?></div>
                            <?php endif; ?>

                            <div class="portfolio-card-actions">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-sm btn-case-study"
                                    data-case-study="<?= $caseStudyJson; ?>"
                                    data-project-title="<?= e($project['title']); ?>">
                                    Case Study
                                </button>

                                <?php if ($demo_url !== '' && $demo_url !== '#'): ?>
                                    <a
                                        href="<?= e($demo_url); ?>"
                                        class="btn btn-outline-primary btn-sm"
                                        target="_blank"
                                        rel="noopener noreferrer">Preview</a>
                                <?php endif; ?>

                                <?php if ($details_url !== '' && $details_url !== '#'): ?>
                                    <a
                                        href="<?= e($details_url); ?>"
                                        class="btn btn-outline-primary btn-sm">Project Details</a>
                                <?php endif; ?>

                                <?php if (($demo_url === '' || $demo_url === '#') && ($details_url === '' || $details_url === '#')): ?>
                                    <a href="#contact" class="btn btn-outline-primary btn-sm">Ask for Details</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="modal fade portfolio-case-modal" id="portfolioCaseModal" tabindex="-1" aria-labelledby="portfolioCaseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <p class="portfolio-modal-kicker mb-1">Case Study</p>
                        <h5 class="modal-title" id="portfolioCaseModalLabel">Project</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="portfolio-modal-section">
                        <h6>Role</h6>
                        <p data-case-role></p>
                    </div>
                    <div class="portfolio-modal-section">
                        <h6>Challenge</h6>
                        <p data-case-challenge></p>
                    </div>
                    <div class="portfolio-modal-section">
                        <h6>Approach</h6>
                        <p data-case-approach></p>
                    </div>
                    <div class="portfolio-modal-section">
                        <h6>Outcome</h6>
                        <p data-case-outcome></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#contact" class="btn btn-outline-primary" data-bs-dismiss="modal">Discuss a Similar Project</a>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</section>
