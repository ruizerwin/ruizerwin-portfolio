<section id="contact" class="section-block section-alt">
    <div class="container">
        <div class="section-heading">
            <h2>Contact</h2>
            <p>Let's talk about your project, system improvements, support, or a new idea.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="contact-info">
                    <div class="info-item">
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <h3>Location</h3>
                            <p>{{ $portfolio['location'] }}</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-linkedin"></i>
                        <div>
                            <h3>LinkedIn</h3>
                            <p><a href="{{ $portfolio['linkedin'] }}" target="_blank" rel="noopener noreferrer">linkedin.com/in/ruizerwin</a></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-envelope"></i>
                        <div>
                            <h3>Email</h3>
                            <p>
                                <a href="mailto:{{ $portfolio['email'] }}">{{ $portfolio['email'] }}</a>
                                <button type="button" class="copy-btn" data-copy="{{ $portfolio['email'] }}" aria-label="Copy email address">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-phone"></i>
                        <div>
                            <h3>Call / WhatsApp</h3>
                            <p><a href="tel:{{ $portfolio['phone_tel'] }}">{{ $portfolio['phone'] }}</a></p>
                            <p><a href="{{ $portfolio['whatsapp'] }}" target="_blank" rel="noopener noreferrer">WhatsApp</a></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <h3>Secure Contact</h3>
                            <p>
                                @if ($recaptchaSiteKey !== '')
                                    Protected with reCAPTCHA v3, server-side validation, CSRF token, and honeypot spam filtering.
                                @else
                                    Protected with server-side validation, CSRF token, and honeypot spam filtering.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <form
                    id="contactForm"
                    class="contact-form"
                    method="post"
                    action="{{ route('contact.store') }}"
                    novalidate>
                    @csrf

                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="">
                    <input type="hidden" name="recaptcha_action" value="contact_form">

                    <div class="d-none" aria-hidden="true">
                        <label for="company_website">Leave this field empty</label>
                        <input type="text" name="company_website" id="company_website" tabindex="-1" autocomplete="off" value="">
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="contact_name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="contact_name" name="name" maxlength="100" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contact_email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="contact_email" name="email" maxlength="150" required>
                        </div>
                        <div class="col-12">
                            <label for="contact_subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="contact_subject" name="subject" maxlength="150" required>
                        </div>
                        <div class="col-12">
                            <label for="contact_message" class="form-label">Message</label>
                            <textarea class="form-control" id="contact_message" name="message" rows="7" maxlength="3000" required></textarea>
                        </div>
                        <div class="col-12">
                            <p class="form-legal">This site may use reCAPTCHA. Google Privacy Policy and Terms of Service apply.</p>
                            <div class="form-status" id="contactStatus" hidden></div>
                            <button type="submit" class="btn btn-accent" id="contactSubmitBtn">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
