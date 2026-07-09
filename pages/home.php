<section id="home" class="hero home-custom-style section">

    <img src="assets/img/home_bg.jpg" alt="Hero Background" class="hero-bg">

    <div class="hero-overlay"></div>

    <div class="container hero-container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-8 col-xl-7">
                <div class="hero-content">

                    <span class="hero-badge">Senior PHP Full-Stack Developer &middot; Laravel &middot; Drupal &middot; AWS</span>

                    <h1><?= e('Erwin D. Padilla'); ?></h1>

                    <p class="hero-lead">
                        <?= e('Senior PHP developer with 17+ years (since 2007) building web applications, APIs, and cloud-hosted systems on PHP, Linux, Bootstrap, and Windows environments.'); ?>
                    </p>

                    <ul class="hero-benefits">
                        <li>
                            <i class="bi bi-check2"></i>
                            <span><?= e('Enterprise PHP, Laravel, CodeIgniter & Drupal'); ?></span>
                        </li>
                        <li>
                            <i class="bi bi-check2"></i>
                            <span><?= e('MySQL & SQL Server optimization'); ?></span>
                        </li>
                        <li>
                            <i class="bi bi-check2"></i>
                            <span><?= e('AWS deployment, CI/CD & production support'); ?></span>
                        </li>
                    </ul>

                    <div class="hero-typed-wrap">
                        <span class="hero-prefix"><?= e('Specialized in:'); ?></span>
                        <span class="typed" data-typed-items="PHP 8+ Development,Laravel & Livewire,REST API Integration,Drupal CMS,AWS Lightsail Deployment,AI & Machine Learning"></span>
                    </div>

                    <div class="hero-stats">
                        <div class="hero-stat-item">
                            <h3><?= e('17+'); ?></h3>
                            <p><?= e('Years Since 2007'); ?></p>
                        </div>
                        <div class="hero-stat-item">
                            <h3><?= e('90%'); ?></h3>
                            <p><?= e('Fewer System Errors'); ?></p>
                        </div>
                        <div class="hero-stat-item">
                            <h3><?= e('30%'); ?></h3>
                            <p><?= e('Faster Load Times'); ?></p>
                        </div>
                    </div>

                    <p class="hero-availability">
                        <i class="bi bi-briefcase"></i>
                        <?= e('Available for: Freelance · Contract · Remote'); ?>
                    </p>

                    <div class="hero-actions">
                        <a href="#portfolio" class="btn btn-primary"><?= e('View Work'); ?></a>
                        <a href="#contact" class="btn btn-outline-light"><?= e('Hire Me'); ?></a>
                        <?php if (resume_pdf_available()): ?>
                            <a
                                href="<?= e(resume_pdf_url()); ?>"
                                class="btn btn-outline-light btn-resume-download"
                                download="Erwin_Padilla_Resume.pdf"
                                data-track="resume-download"><?= e('Download Resume'); ?></a>
                        <?php endif; ?>
                        <a
                            href="<?= e(linkedin_url()); ?>"
                            class="btn btn-outline-light btn-linkedin"
                            target="_blank"
                            rel="noopener noreferrer">
                            <i class="bi bi-linkedin"></i>
                            <?= e('LinkedIn'); ?>
                        </a>
                    </div>

                    <div class="hero-stack">
                        <span class="hero-pill"><?= e('PHP 8.2+'); ?></span>
                        <span class="hero-pill"><?= e('Laravel'); ?></span>
                        <span class="hero-pill"><?= e('CodeIgniter'); ?></span>
                        <span class="hero-pill"><?= e('MySQL'); ?></span>
                        <span class="hero-pill"><?= e('REST APIs'); ?></span>
                        <span class="hero-pill"><?= e('AWS'); ?></span>
                        <span class="hero-pill"><?= e('Livewire'); ?></span>
                        <span class="hero-pill"><?= e('Tailwind CSS'); ?></span>
                        <span class="hero-pill"><?= e('AI / ML'); ?></span>
                    </div>

                    <div class="social-links hero-social-links mt-4">
                        <a href="https://www.facebook.com/ruizerwin/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/ruizerwin1/?hl=en" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/ruizerwin/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="https://github.com/ruizerwin" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
                            <i class="bi bi-github"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
