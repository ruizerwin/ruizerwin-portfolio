<section id="about" class="about section">

    <div class="container section-title" data-aos="fade-up">
        <h2><?= e('About'); ?></h2>
        <p>
            <?= e('Senior PHP Full-Stack Developer with 17+ years of experience since 2007, building secure, scalable, and maintainable enterprise web applications.'); ?>
        </p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-4 text-center">
                <img src="assets/img/profile-erwin.jpg" class="img-fluid rounded shadow-sm" alt="Erwin Padilla">
            </div>

            <div class="col-lg-8 content">
                <h3><?= e('Senior PHP Full-Stack Developer'); ?></h3>

                <p class="fst-italic about-intro">
                    <?= e('I design and maintain enterprise web applications using PHP 8+, Laravel, Livewire, CodeIgniter, Drupal, MySQL, SQL Server, Bootstrap, Tailwind CSS, REST APIs, and AWS cloud hosting.'); ?>
                </p>

                <p>
                    <?= e('My experience spans backend architecture, database design, third-party integrations, performance optimization, and long-term production support for business-critical systems across remote teams in North America.'); ?>
                </p>

                <div class="about-education-notice">
                    <div class="about-education-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <div>
                        <h4><?= e('AI & Machine Learning — Fanshawe College'); ?></h4>
                        <p class="mb-1"><em><?= e('Currently studying · Post-Graduate Co-op Certificate · GAP5 culmination'); ?></em></p>
                        <p class="mb-2">
                            <?= e('One-year program focused on building, managing, and administering systems that analyze big data and convert insights into autonomous tasks. Covers AI, machine learning, and data-driven automation for real-world applications.'); ?>
                        </p>
                        <p class="about-education-meta mb-0">
                            <i class="bi bi-geo-alt"></i> <?= e('London, Ontario, Canada'); ?>
                        </p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <ul class="about-info">
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <strong><?= e('Name:'); ?></strong>
                                <span><?= e('Erwin D. Padilla'); ?></span>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <strong><?= e('Role:'); ?></strong>
                                <span><?= e('Senior PHP Full-Stack Developer'); ?></span>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <strong><?= e('Location:'); ?></strong>
                                <span><?= e('London, Ontario'); ?></span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <ul class="about-info">
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <strong><?= e('Main Stack:'); ?></strong>
                                <span><?= e('PHP 8+, MySQL, Bootstrap'); ?></span>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <strong><?= e('Frameworks:'); ?></strong>
                                <span><?= e('Laravel, CodeIgniter, Drupal'); ?></span>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <strong><?= e('Cloud:'); ?></strong>
                                <span><?= e('AWS Lightsail, GitHub Actions'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <div class="about-mini-card">
                            <h4><?= e('17+'); ?></h4>
                            <p><?= e('Years Since 2007'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="about-mini-card">
                            <h4><?= e('B2B'); ?></h4>
                            <p><?= e('Enterprise Systems'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="about-mini-card">
                            <h4><?= e('AI/ML'); ?></h4>
                            <p><?= e('Post-Graduate'); ?></p>
                        </div>
                    </div>
                </div>

                <p class="about-summary mt-4 mb-0">
                    <?= e('I combine backend engineering, database optimization, and production support to deliver reliable systems — while expanding into artificial intelligence and machine learning.'); ?>
                </p>

                <div class="mt-4 about-actions">
                    <a href="#resume" class="btn btn-primary"><?= e('View Resume'); ?></a>
                    <?php if (resume_pdf_available()): ?>
                        <a
                            href="<?= e(resume_pdf_url()); ?>"
                            class="btn btn-outline-primary btn-resume-download"
                            data-track="resume-download"
                            rel="noopener"><?= e('Download PDF'); ?></a>
                    <?php endif; ?>
                    <a
                        href="<?= e(linkedin_url()); ?>"
                        class="btn btn-outline-primary"
                        target="_blank"
                        rel="noopener noreferrer">
                        <i class="bi bi-linkedin"></i>
                        <?= e('LinkedIn'); ?>
                    </a>
                    <a href="#contact" class="btn btn-outline-primary"><?= e('Contact Me'); ?></a>
                </div>
            </div>
        </div>
    </div>

</section>
