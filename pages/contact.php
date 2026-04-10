<?php

declare(strict_types=1);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = (string) $_SESSION['csrf_token'];

$recaptchaSiteKey = defined('CONTACT_RECAPTCHA_SITE_KEY') ? (string) CONTACT_RECAPTCHA_SITE_KEY : '';
?>

<section id="contact" class="contact section">

    <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Let's talk about your website, system improvements, support, or a new project.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

            <div class="col-lg-5">
                <div class="contact-info-wrap">

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h3>Location</h3>
                            <p>London, Ontario, Canada</p>
                        </div>
                    </div>

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h3>Email</h3>
                            <p>ruizerwin@hotmail.com</p>
                        </div>
                    </div>

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-phone flex-shrink-0"></i>
                        <div>
                            <h3>Call / WhatsApp</h3>
                            <p>416-505-3876</p>
                        </div>
                    </div>

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                        <i class="bi bi-shield-check flex-shrink-0"></i>
                        <div>
                            <h3>Secure Contact</h3>
                            <p>Protected with server-side validation, CSRF token, honeypot, and background spam protection.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-7">
                <form
                    action="forms/contact_submit.php"
                    method="post"
                    class="php-email-form contact-form-card"
                    id="contactForm"
                    novalidate>
                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">

                    <input
                        type="hidden"
                        name="g-recaptcha-response"
                        id="g-recaptcha-response"
                        value="">

                    <input
                        type="hidden"
                        name="recaptcha_action"
                        value="contact_form">

                    <div class="d-none" aria-hidden="true">
                        <label for="company_website">Leave this field empty</label>
                        <input
                            type="text"
                            name="company_website"
                            id="company_website"
                            tabindex="-1"
                            autocomplete="off"
                            value="">
                    </div>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label for="contact_name" class="form-label">Your Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                id="contact_name"
                                maxlength="100"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="contact_email" class="form-label">Your Email</label>
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                id="contact_email"
                                maxlength="150"
                                required>
                        </div>

                        <div class="col-md-12">
                            <label for="contact_subject" class="form-label">Subject</label>
                            <input
                                type="text"
                                class="form-control"
                                name="subject"
                                id="contact_subject"
                                maxlength="150"
                                required>
                        </div>

                        <div class="col-md-12">
                            <label for="contact_message" class="form-label">Message</label>
                            <textarea
                                class="form-control"
                                name="message"
                                id="contact_message"
                                rows="7"
                                maxlength="3000"
                                required></textarea>
                        </div>

                        <div class="col-md-12">
                            <p class="contact-legal-note mb-0">
                                This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.
                            </p>
                        </div>

                        <div class="col-md-12">
                            <div class="loading">Sending...</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent successfully. Thank you!</div>
                        </div>

                        <div class="col-md-12 text-start">
                            <button type="submit" id="contactSubmitBtn">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <?php if (!empty($_GET['sent'])): ?>
        <div class="alert alert-success">Message sent!</div>
    <?php endif; ?>
</section>

<?php if ($recaptchaSiteKey !== ''): ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= rawurlencode($recaptchaSiteKey); ?>"></script>
    <script>
        (function() {
            const form = document.getElementById('contactForm');
            const tokenField = document.getElementById('g-recaptcha-response');
            const submitBtn = document.getElementById('contactSubmitBtn');
            const recaptchaSiteKey = <?= json_encode($recaptchaSiteKey, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;

            if (!form || !tokenField || !submitBtn || !window.grecaptcha) {
                return;
            }

            const loading = form.querySelector('.loading');
            const errorBox = form.querySelector('.error-message');
            const successBox = form.querySelector('.sent-message');

            function hideMessages() {
                if (loading) {
                    loading.style.display = 'none';
                }

                if (errorBox) {
                    errorBox.style.display = 'none';
                    errorBox.textContent = '';
                }

                if (successBox) {
                    successBox.style.display = 'none';
                }
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                hideMessages();

                if (loading) {
                    loading.style.display = 'block';
                }

                submitBtn.disabled = true;

                grecaptcha.ready(function() {
                    grecaptcha.execute(recaptchaSiteKey, {
                            action: 'contact_form'
                        })
                        .then(function(token) {
                            tokenField.value = token;

                            return fetch(form.action, {
                                method: 'POST',
                                body: new FormData(form)
                            });
                        })
                        .then(function(response) {
                            return response.text().then(function(text) {
                                return {
                                    ok: response.ok,
                                    text: text.trim()
                                };
                            });
                        })
                        .then(function(result) {
                            if (loading) {
                                loading.style.display = 'none';
                            }

                            submitBtn.disabled = false;

                            if (!result.ok) {
                                throw new Error(result.text || 'Unable to send your message right now.');
                            }

                            if (result.text !== 'OK') {
                                throw new Error(result.text || 'Unexpected server response.');
                            }

                            form.reset();
                            tokenField.value = '';

                            if (successBox) {
                                successBox.style.display = 'block';
                            }

                            setTimeout(function() {
                                if (successBox) {
                                    successBox.style.display = 'none';
                                }
                            }, 5000);
                        })
                        .catch(function(error) {
                            if (loading) {
                                loading.style.display = 'none';
                            }

                            submitBtn.disabled = false;

                            if (errorBox) {
                                errorBox.style.display = 'block';
                                errorBox.textContent = error.message || 'Something went wrong. Please try again.';
                            }
                        });
                });
            });
        })();
    </script>
<?php endif; ?>
