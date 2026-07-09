/**
 * Site enhancements: toast notifications, copy-to-clipboard,
 * portfolio case-study modal, and resume download feedback.
 */
(function () {
    'use strict';

    const TOAST_DURATION = 3200;

    function createToastContainer() {
        let container = document.getElementById('siteToastContainer');

        if (!container) {
            container = document.createElement('div');
            container.id = 'siteToastContainer';
            container.className = 'site-toast-container';
            container.setAttribute('aria-live', 'polite');
            container.setAttribute('aria-atomic', 'true');
            document.body.appendChild(container);
        }

        return container;
    }

    function showToast(message, type) {
        const container = createToastContainer();
        const toast = document.createElement('div');
        const iconClass = type === 'success' ? 'bi-check-circle-fill' : 'bi-info-circle-fill';

        toast.className = 'site-toast site-toast-' + (type || 'info');
        toast.innerHTML =
            '<i class="bi ' + iconClass + '"></i><span>' + message + '</span>';

        container.appendChild(toast);

        requestAnimationFrame(function () {
            toast.classList.add('is-visible');
        });

        window.setTimeout(function () {
            toast.classList.remove('is-visible');
            window.setTimeout(function () {
                toast.remove();
            }, 250);
        }, TOAST_DURATION);
    }

    function copyText(value) {
        if (!value) {
            return Promise.reject(new Error('Nothing to copy'));
        }

        if (navigator.clipboard && navigator.clipboard.writeText) {
            return navigator.clipboard.writeText(value);
        }

        return new Promise(function (resolve, reject) {
            const textarea = document.createElement('textarea');
            textarea.value = value;
            textarea.setAttribute('readonly', '');
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();

            try {
                document.execCommand('copy');
                textarea.remove();
                resolve();
            } catch (error) {
                textarea.remove();
                reject(error);
            }
        });
    }

    function initCopyButtons() {
        document.querySelectorAll('[data-copy]').forEach(function (button) {
            button.addEventListener('click', function () {
                const value = button.getAttribute('data-copy') || '';

                copyText(value)
                    .then(function () {
                        showToast('Copied to clipboard', 'success');
                    })
                    .catch(function () {
                        showToast('Unable to copy right now', 'info');
                    });
            });
        });
    }

    function initResumeDownloads() {
        document.querySelectorAll('[data-track="resume-download"]').forEach(function (link) {
            link.addEventListener('click', function () {
                showToast('Resume download started', 'success');
            });
        });
    }

    function initPortfolioCaseStudies() {
        const modalElement = document.getElementById('portfolioCaseModal');

        if (!modalElement || typeof bootstrap === 'undefined') {
            return;
        }

        const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
        const titleEl = modalElement.querySelector('#portfolioCaseModalLabel');
        const roleEl = modalElement.querySelector('[data-case-role]');
        const challengeEl = modalElement.querySelector('[data-case-challenge]');
        const approachEl = modalElement.querySelector('[data-case-approach]');
        const outcomeEl = modalElement.querySelector('[data-case-outcome]');

        document.querySelectorAll('.btn-case-study').forEach(function (button) {
            button.addEventListener('click', function () {
                let caseStudy = {};

                try {
                    caseStudy = JSON.parse(button.getAttribute('data-case-study') || '{}');
                } catch (error) {
                    showToast('Unable to open case study', 'info');
                    return;
                }

                if (titleEl) {
                    titleEl.textContent = button.getAttribute('data-project-title') || 'Project';
                }

                if (roleEl) {
                    roleEl.textContent = caseStudy.role || '';
                }

                if (challengeEl) {
                    challengeEl.textContent = caseStudy.challenge || '';
                }

                if (approachEl) {
                    approachEl.textContent = caseStudy.approach || '';
                }

                if (outcomeEl) {
                    outcomeEl.textContent = caseStudy.outcome || '';
                }

                modal.show();
            });
        });
    }

    function initPortfolioCardTilt() {
        const cards = document.querySelectorAll('[data-portfolio-card]');

        if (!window.matchMedia('(hover: hover)').matches) {
            return;
        }

        cards.forEach(function (card) {
            card.addEventListener('mousemove', function (event) {
                const rect = card.getBoundingClientRect();
                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;
                const rotateX = ((y / rect.height) - 0.5) * -4;
                const rotateY = ((x / rect.width) - 0.5) * 4;

                card.style.transform =
                    'perspective(900px) rotateX(' + rotateX.toFixed(2) + 'deg) rotateY(' + rotateY.toFixed(2) + 'deg) translateY(-4px)';
            });

            card.addEventListener('mouseleave', function () {
                card.style.transform = '';
            });
        });
    }

    function initLinkedInPulse() {
        const linkedInButtons = document.querySelectorAll('.btn-linkedin, a[href*="linkedin.com/in/ruizerwin"]');

        linkedInButtons.forEach(function (link) {
            link.addEventListener('mouseenter', function () {
                link.classList.add('is-pulsing');
            });

            link.addEventListener('animationend', function () {
                link.classList.remove('is-pulsing');
            });
        });
    }

    window.addEventListener('load', function () {
        initCopyButtons();
        initResumeDownloads();
        initPortfolioCaseStudies();
        initPortfolioCardTilt();
        initLinkedInPulse();
    });
})();
