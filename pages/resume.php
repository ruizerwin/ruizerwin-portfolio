<?php

declare(strict_types=1);
?>
<section id="resume" class="resume section">

    <div class="container section-title" data-aos="fade-up">
        <h2>Resume</h2>
        <p>Senior PHP Full-Stack Developer with 17+ years of experience since 2007.</p>
    </div>

    <div class="container resume-actions-bar" data-aos="fade-up" data-aos-delay="50">
        <?php if (resume_pdf_available()): ?>
            <a
                href="<?= e(resume_pdf_url()); ?>"
                class="btn btn-primary btn-resume-download"
                download="Erwin_Padilla_Resume.pdf"
                data-track="resume-download">
                <i class="bi bi-download"></i>
                <?= e('Download PDF Resume'); ?>
            </a>
        <?php endif; ?>
        <a
            href="<?= e(linkedin_url()); ?>"
            class="btn btn-outline-primary"
            target="_blank"
            rel="noopener noreferrer">
            <i class="bi bi-linkedin"></i>
            <?= e('Connect on LinkedIn'); ?>
        </a>
        <a href="#contact" class="btn btn-outline-primary">
            <i class="bi bi-envelope"></i>
            <?= e('Get in Touch'); ?>
        </a>
    </div>

    <div class="container">
        <div class="row gy-4">

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

                <h3 class="resume-title">Professional Summary</h3>
                <div class="resume-item pb-0">
                    <h4>Erwin D. Padilla</h4>
                    <p><em>Senior PHP Full-Stack Developer | Laravel, Drupal, AWS</em></p>
                    <p class="resume-summary">
                        Senior PHP Full-Stack Developer with 17+ years of experience since 2007 designing, developing, and
                        maintaining enterprise web applications in Laravel, Livewire, CodeIgniter, Drupal, PHP 8.2+,
                        MySQL, SQL Server, JavaScript, Bootstrap, Tailwind CSS, REST APIs, and AWS cloud
                        hosting. Optimizing application performance, integrating third-party services, and delivering
                        scalable solutions in remote environments. Strong problem-solving, debugging, and database
                        design skills with extensive experience supporting business-critical applications.
                    </p>
                    <ul>
                        <li>London, ON</li>
                        <li><a href="tel:+14165053876">+1 (416) 505-3876</a></li>
                        <li><a href="mailto:ruizerwin@hotmail.com">ruizerwin@hotmail.com</a></li>
                        <li><a href="https://www.ruizerwin.com" target="_blank" rel="noopener noreferrer">www.ruizerwin.com</a></li>
                    </ul>
                </div>

                <h3 class="resume-title">Core Skills</h3>
                <div class="resume-skills">
                    <span>PHP 8.2+</span>
                    <span>Laravel</span>
                    <span>Livewire</span>
                    <span>CodeIgniter 4</span>
                    <span>Drupal 9/10</span>
                    <span>MySQL</span>
                    <span>SQL Server</span>
                    <span>Stored Procedures</span>
                    <span>Query Optimization</span>
                    <span>JavaScript</span>
                    <span>jQuery</span>
                    <span>AJAX</span>
                    <span>Bootstrap 5</span>
                    <span>Tailwind CSS</span>
                    <span>Alpine.js</span>
                    <span>REST APIs</span>
                    <span>Third-Party Integrations</span>
                    <span>AWS Lightsail</span>
                    <span>Linux Administration</span>
                    <span>Apache</span>
                    <span>SSH</span>
                    <span>Git</span>
                    <span>GitHub</span>
                    <span>VS Code</span>
                    <span>Xdebug</span>
                    <span>Deployment Pipelines</span>
                    <span>Performance Optimization</span>
                    <span>Security Best Practices</span>
                </div>

                <h3 class="resume-title">Education</h3>

                <div class="resume-item">
                    <h4>Artificial Intelligence &amp; Machine Learning</h4>
                    <p><em>Fanshawe College &mdash; London, ON &middot; Currently studying &middot; Post-Graduate Co-op Certificate</em></p>
                    <p><em>GAP5 culmination</em></p>
                    <p>
                        One-year program focused on building, managing, and administering systems that analyze big data
                        and convert it into autonomous tasks. Covers highly in-demand skills in AI, machine learning,
                        and data-driven automation.
                    </p>
                </div>

                <div class="resume-item">
                    <h4>Bachelor&rsquo;s Degree in Computer Science</h4>
                    <h5>1997 &ndash; 2003</h5>
                    <p><em>National Autonomous University of Nicaragua UNAN &ndash; Le&oacute;n, Nicaragua</em></p>
                </div>

                <div class="resume-item">
                    <h4>Cloud Architecture</h4>
                    <p><em>Intellipaat, Mississauga, ON</em></p>
                </div>

                <div class="resume-item">
                    <h4>Computer Networking, Maintenance &amp; Web Development</h4>
                    <p><em>Le&oacute;n, Nicaragua</em></p>
                </div>

            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

                <h3 class="resume-title">Professional Experience</h3>

                <div class="resume-item">
                    <h4>PHP / Web Developer</h4>
                    <h5>2007 &ndash; 2022</h5>
                    <p><em>J&amp;B Importers &mdash; Remote</em></p>
                    <ul>
                        <li>Developed and maintained large-scale B2B and e-commerce applications serving customers across North America.</li>
                        <li>Designed and implemented custom PHP applications, APIs, and database-driven business solutions.</li>
                        <li>Integrated SQL Server, MySQL, UPS APIs, payment gateways, and third-party business services.</li>
                        <li>Optimized application performance and database queries, significantly reducing response times.</li>
                        <li>Managed Linux and Windows hosting environments, deployments, troubleshooting, and production support.</li>
                        <li>Collaborated with business stakeholders to translate operational requirements into technical solutions.</li>
                    </ul>
                </div>

                <div class="resume-item">
                    <h4>Web Developer</h4>
                    <h5>2023</h5>
                    <p><em>Haya Solutions &mdash; Remote</em></p>
                    <ul>
                        <li>Built and implemented RESTful APIs using CodeIgniter to integrate with third-party services.</li>
                        <li>Improved development time by 20% through cleaner architecture and reusable components.</li>
                        <li>Developed custom functions to extend features and support client requirements.</li>
                    </ul>
                </div>

                <div class="resume-item">
                    <h4>Drupal Developer</h4>
                    <h5>2024 &ndash; 2025</h5>
                    <p><em>Y Partners Inc. &mdash; Remote</em></p>
                    <ul>
                        <li>Created, maintained, and optimized Drupal CMS features to improve speed and stability.</li>
                        <li>Worked with front-end teams to build modern, mobile-friendly interfaces using Twig and Bootstrap.</li>
                        <li>Built custom Drupal modules to support business logic and new system functionality.</li>
                        <li>Reduced load time by 30% through optimization and content-structure improvements.</li>
                    </ul>
                </div>

            </div>

        </div>
    </div>

</section>
