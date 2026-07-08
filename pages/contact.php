<?php

declare(strict_types=1);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = (string) $_SESSION['csrf_token'];

$recaptchaSiteKey = defined('RECAPTCHA_V3_SITE_KEY') ? (string) RECAPTCHA_V3_SITE_KEY : '';
$recaptchaEnabled = $recaptchaSiteKey !== '';
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
                            <p><a href="mailto:ruizerwin@hotmail.com">ruizerwin@hotmail.com</a></p>
                        </div>
                    </div>

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-phone flex-shrink-0"></i>
                        <div>
                            <h3>Call / WhatsApp</h3>
                            <p>
                                <a href="tel:+14165053876">+1 (416) 505-3876</a>
                            </p>
                            <p class="mb-0">
                                <a href="https://wa.me/14165053876" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                            </p>
                        </div>
                    </div>

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                        <i class="bi bi-shield-check flex-shrink-0"></i>
                        <div>
                            <h3>Secure Contact</h3>
                            <p>
                                <?php if ($recaptchaEnabled): ?>
                                    Protected with reCAPTCHA v3, server-side validation, CSRF token, and honeypot spam filtering.
                                <?php else: ?>
                                    Protected with server-side validation, CSRF token, and honeypot spam filtering.
                                <?php endif; ?>
                            </p>
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
                            <?php if ($recaptchaEnabled): ?>
                            <p class="contact-legal-note mb-0">
                                This site is protected by reCAPTCHA and the Google
                                <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Privacy Policy</a>
                                and
                                <a href="https://policies.google.com/terms" target="_blank" rel="noopener noreferrer">Terms of Service</a>
                                apply.
                            </p>
                            <?php else: ?>
                            <p class="contact-legal-note mb-0">
                                Messages are protected with server-side validation, CSRF token, and honeypot spam filtering.
                            </p>
                            <?php endif; ?>
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
</section>

<?php if ($recaptchaEnabled): ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= rawurlencode($recaptchaSiteKey); ?>" async defer></script>
<?php endif; ?>
<script>
    (function() {
        const form = document.getElementById('contactForm');
        const tokenField = document.getElementById('g-recaptcha-response');
        const submitBtn = document.getElementById('contactSubmitBtn');
        const recaptchaSiteKey = <?= json_encode($recaptchaSiteKey, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;

        if (!form || !submitBtn) {
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

        function sendForm() {
            return fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            }).then(function(response) {
                return response.text().then(function(text) {
                    return {
                        ok: response.ok,
                        text: text.trim()
                    };
                });
            });
        }

        function handleResult(result) {
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

            if (tokenField) {
                tokenField.value = '';
            }

            if (successBox) {
                successBox.style.display = 'block';
            }

            setTimeout(function() {
                if (successBox) {
                    successBox.style.display = 'none';
                }
            }, 5000);
        }

        function handleError(error) {
            if (loading) {
                loading.style.display = 'none';
            }

            submitBtn.disabled = false;

            if (errorBox) {
                errorBox.style.display = 'block';
                errorBox.textContent = error.message || 'Something went wrong. Please try again.';
            }
        }

        function waitForRecaptcha(maxAttempts) {
            return new Promise(function(resolve, reject) {
                if (!recaptchaSiteKey) {
                    resolve();
                    return;
                }

                let attempts = 0;

                function check() {
                    if (window.grecaptcha && typeof window.grecaptcha.execute === 'function') {
                        window.grecaptcha.ready(resolve);
                        return;
                    }

                    attempts += 1;

                    if (attempts >= maxAttempts) {
                        reject(new Error('Security verification failed to load. Please refresh the page and try again.'));
                        return;
                    }

                    setTimeout(check, 100);
                }

                check();
            });
        }

        function submitWithRecaptcha() {
            return waitForRecaptcha(100).then(function() {
                if (!recaptchaSiteKey) {
                    return sendForm();
                }

                return window.grecaptcha.execute(recaptchaSiteKey, {
                        action: 'contact_form'
                    })
                    .then(function(token) {
                        if (tokenField) {
                            tokenField.value = token;
                        }

                        return sendForm();
                    });
            });
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            hideMessages();

            if (loading) {
                loading.style.display = 'block';
            }

            submitBtn.disabled = true;

            submitWithRecaptcha()
                .then(handleResult)
                .catch(handleError);
        });
    })();
</script>
