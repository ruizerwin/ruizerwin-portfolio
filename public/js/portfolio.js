/**
 * Portfolio 2.0 front-end behavior
 * - mobile nav toggle
 * - active section highlighting
 * - typed specialties rotation
 * - case study modal filling
 * - contact form AJAX + optional reCAPTCHA
 * - scroll-to-top button
 */
(function () {
    'use strict';

    const header = document.getElementById('siteHeader');
    const nav = document.getElementById('siteNav');
    const navToggle = document.getElementById('navToggle');
    const scrollTopBtn = document.getElementById('scrollTopBtn');

    // Toggle mobile navigation open/closed.
    if (navToggle && nav) {
        navToggle.addEventListener('click', function () {
            const open = nav.classList.toggle('is-open');
            navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });

        // Close mobile nav after clicking a link.
        nav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                nav.classList.remove('is-open');
                navToggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    // Highlight the nav item for the section currently in view.
    const sections = document.querySelectorAll('main section[id]');
    const navLinks = document.querySelectorAll('.site-nav a');

    function updateActiveNav() {
        let current = 'home';

        sections.forEach(function (section) {
            const top = section.offsetTop - 120;
            if (window.scrollY >= top) {
                current = section.id;
            }
        });

        navLinks.forEach(function (link) {
            const href = link.getAttribute('href') || '';
            link.classList.toggle('is-active', href === '#' + current);
        });

        if (scrollTopBtn) {
            scrollTopBtn.classList.toggle('is-visible', window.scrollY > 400);
        }
    }

    window.addEventListener('scroll', updateActiveNav, { passive: true });
    updateActiveNav();

    // Smooth scroll back to top.
    if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Simple typed text rotation for specialties.
    const typedTarget = document.querySelector('.typed-target');
    if (typedTarget) {
        const items = (typedTarget.getAttribute('data-typed-items') || '')
            .split(',')
            .map(function (item) { return item.trim(); })
            .filter(Boolean);

        let index = 0;

        function showTyped() {
            if (!items.length) {
                return;
            }

            typedTarget.textContent = items[index];
            index = (index + 1) % items.length;
        }

        showTyped();
        window.setInterval(showTyped, 2600);
    }

    // Fill Bootstrap modal with case study content from button data attributes.
    const caseModal = document.getElementById('caseStudyModal');
    if (caseModal) {
        caseModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) {
                return;
            }

            caseModal.querySelector('.modal-title').textContent = button.getAttribute('data-title') || 'Project';
            caseModal.querySelector('[data-case-role]').textContent = button.getAttribute('data-role') || '';
            caseModal.querySelector('[data-case-challenge]').textContent = button.getAttribute('data-challenge') || '';
            caseModal.querySelector('[data-case-approach]').textContent = button.getAttribute('data-approach') || '';
            caseModal.querySelector('[data-case-outcome]').textContent = button.getAttribute('data-outcome') || '';
        });
    }

    // Copy email helper.
    document.querySelectorAll('[data-copy]').forEach(function (button) {
        button.addEventListener('click', async function () {
            const value = button.getAttribute('data-copy') || '';
            try {
                await navigator.clipboard.writeText(value);
                button.setAttribute('title', 'Copied');
            } catch (error) {
                button.setAttribute('title', 'Copy failed');
            }
        });
    });

    // Contact form submit with CSRF + optional reCAPTCHA v3.
    const form = document.getElementById('contactForm');
    if (!form) {
        return;
    }

    const statusBox = document.getElementById('contactStatus');
    const submitBtn = document.getElementById('contactSubmitBtn');
    const tokenField = document.getElementById('g-recaptcha-response');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    function showStatus(message, isSuccess) {
        if (!statusBox) {
            return;
        }

        statusBox.hidden = false;
        statusBox.textContent = message;
        statusBox.classList.toggle('is-success', !!isSuccess);
        statusBox.classList.toggle('is-error', !isSuccess);
    }

    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        if (submitBtn) {
            submitBtn.disabled = true;
        }

        try {
            if (window.portfolioRecaptchaSiteKey && window.grecaptcha && tokenField) {
                await new Promise(function (resolve) {
                    grecaptcha.ready(resolve);
                });

                tokenField.value = await grecaptcha.execute(window.portfolioRecaptchaSiteKey, {
                    action: 'contact_form',
                });
            }

            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new FormData(form),
            });

            const payload = await response.json().catch(function () {
                return { message: 'Unexpected server response.' };
            });

            if (!response.ok) {
                throw new Error(payload.message || 'Unable to send your message right now.');
            }

            form.reset();
            if (tokenField) {
                tokenField.value = '';
            }

            showStatus('Your message has been sent successfully. Thank you!', true);
        } catch (error) {
            showStatus(error.message || 'Something went wrong. Please try again.', false);
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
            }
        }
    });
})();
