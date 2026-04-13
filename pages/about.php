<section id="about" class="about section">

    <div class="container section-title" data-aos="fade-up">
        <h2><?= e('About'); ?></h2>
        <p>
            <?= e('Experienced PHP Web Developer building secure, scalable, and maintainable web applications.'); ?>
        </p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-4 text-center">
                <img
                    src="assets/img/profile-img.jpg"
                    class="img-fluid about-profile-img"
                    alt="<?= e('Erwin Padilla profile photo'); ?>">
            </div>

            <div class="col-lg-8 content">
                <h3><?= e('PHP Web Developer'); ?></h3>

                <p class="fst-italic about-intro">
                    <?= e('I build modern web applications using PHP, Laravel, Drupal, CodeIgniter, MySQL, Bootstrap, JavaScript, and AWS deployment workflows.'); ?>
                </p>

                <p>
                    <?= e('My experience includes backend development, database design, API integration, front-end improvements, and long-term system maintenance.'); ?>
                </p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <ul class="about-info">
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <strong><?= e('Name:'); ?></strong>
                                <span><?= e('Erwin Padilla'); ?></span>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <strong><?= e('Role:'); ?></strong>
                                <span><?= e('PHP Web Developer'); ?></span>
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
                                <span><?= e('PHP, MySQL, Bootstrap'); ?></span>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <strong><?= e('Frameworks:'); ?></strong>
                                <span><?= e('Laravel, CodeIgniter, Drupal'); ?></span>
                            </li>
                            <li>
                                <i class="bi bi-chevron-right"></i>
                                <strong><?= e('Other Skills:'); ?></strong>
                                <span><?= e('JavaScript, REST APIs, AWS'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <div class="about-mini-card">
                            <h4><?= e('7+'); ?></h4>
                            <p><?= e('Years Experience'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="about-mini-card">
                            <h4><?= e('PHP'); ?></h4>
                            <p><?= e('Backend Focus'); ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="about-mini-card">
                            <h4><?= e('AWS'); ?></h4>
                            <p><?= e('Deployment Workflow'); ?></p>
                        </div>
                    </div>
                </div>

                <p class="about-summary mt-4 mb-0">
                    <?= e('I combine backend development, database optimization, and production support to build systems that solve real business problems.'); ?>
                </p>

                <div class="mt-4">
                    <a href="#resume" class="btn btn-primary me-2"><?= e('View Resume'); ?></a>
                    <a href="#contact" class="btn btn-outline-primary"><?= e('Contact Me'); ?></a>
                </div>
            </div>
        </div>
    </div>

</section>
