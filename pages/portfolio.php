<?php

declare(strict_types=1);
?>

<section id="portfolio" class="portfolio section">

    <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Some of the projects and systems I have worked on.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">

            <?php
            $projects = [
                [
                    'title'       => 'JBI Internal System',
                    'subtitle'    => 'Internal ERP / Business Platform',
                    'description' => 'Custom internal tools for order flow, RGA, invoices, shipping, reporting, and secure admin workflows.',
                    'results'     => [
                        'Built business-critical internal tools for daily operations.',
                        'Improved workflow efficiency across reporting and order handling.',
                        'Supported secure admin processes and long-term maintenance.',
                    ],
                    'tech'        => ['PHP', 'MySQL', 'jQuery', 'Bootstrap'],
                    'image'       => 'assets/img/portfolio/jbimporters.jpg',
                    'demo'        => '',
                    'details'     => '',
                    'status'      => 'Private Project',
                ],
                [
                    'title'       => 'Haya Solutions API Integration',
                    'subtitle'    => 'RESTful API Development',
                    'description' => 'Built and connected API endpoints with clean architecture, reusable components, and better integration flow.',
                    'results'     => [
                        'Integrated third-party services through RESTful APIs.',
                        'Improved development speed with reusable backend components.',
                        'Created cleaner and easier-to-maintain integration logic.',
                    ],
                    'tech'        => ['CodeIgniter', 'PHP', 'MySQL', 'REST API'],
                    'image'       => 'assets/img/portfolio/haya_solutions.jpg',
                    'demo'        => '',
                    'details'     => '',
                    'status'      => 'Private Project',
                ],
                [
                    'title'       => 'Drupal Optimization Project',
                    'subtitle'    => 'CMS Performance Improvement',
                    'description' => 'Improved Drupal performance, front-end structure, and maintainability using Twig and Bootstrap.',
                    'results'     => [
                        'Improved front-end structure and maintainability.',
                        'Helped optimize performance and load speed.',
                        'Enhanced responsive layout quality using Twig and Bootstrap.',
                    ],
                    'tech'        => ['Drupal', 'Twig', 'Bootstrap', 'PHP'],
                    'image'       => 'assets/img/portfolio/y_partners.jpg',
                    'demo'        => '',
                    'details'     => '',
                    'status'      => 'Client Work',
                ],
            ];

            foreach ($projects as $project):
                $demo_url = trim((string) $project['demo']);
                $details_url = trim((string) $project['details']);
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-card h-100">
                        <div class="portfolio-card-image">
                            <img
                                src="<?= e($project['image']); ?>"
                                alt="<?= e($project['title']); ?>"
                                class="img-fluid">
                            <span class="view-text">View Project</span>
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
                                <?php if ($demo_url !== '' && $demo_url !== '#'): ?>
                                    <a
                                        href="<?= e($demo_url); ?>"
                                        class="btn btn-primary btn-sm"
                                        target="_blank"
                                        rel="noopener noreferrer">Preview</a>
                                <?php endif; ?>

                                <?php if ($details_url !== '' && $details_url !== '#'): ?>
                                    <a
                                        href="<?= e($details_url); ?>"
                                        class="btn btn-outline-primary btn-sm">Details</a>
                                <?php endif; ?>

                                <?php if (($demo_url === '' || $demo_url === '#') && ($details_url === '' || $details_url === '#')): ?>
                                    <a href="#contact" class="btn btn-outline-primary btn-sm">Ask About This Project</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

</section>
