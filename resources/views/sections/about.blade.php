<section id="about" class="section-block">
    <div class="container">
        <div class="section-heading">
            <h2>About</h2>
            <p>{{ $portfolio['about']['intro'] }}</p>
        </div>

        <div class="row g-5 align-items-center">
            <div class="col-lg-4 text-center">
                <img
                    src="{{ asset('images/profile-erwin.jpg') }}"
                    alt="{{ $portfolio['name'] }}"
                    class="about-photo"
                    loading="lazy">
            </div>

            <div class="col-lg-8">
                <h3 class="about-title">{{ $portfolio['about']['title'] }}</h3>
                <p class="about-copy">{{ $portfolio['about']['paragraph_1'] }}</p>
                <p class="about-copy">{{ $portfolio['about']['paragraph_2'] }}</p>

                <div class="education-banner">
                    <div class="education-icon"><i class="bi bi-mortarboard"></i></div>
                    <div>
                        <h4>{{ $portfolio['about']['education_notice']['title'] }}</h4>
                        <p class="education-meta">{{ $portfolio['about']['education_notice']['meta'] }}</p>
                        <p>{{ $portfolio['about']['education_notice']['text'] }}</p>
                        <p class="education-location">
                            <i class="bi bi-geo-alt"></i>
                            {{ $portfolio['about']['education_notice']['location'] }}
                        </p>
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <ul class="fact-list">
                            @foreach ($portfolio['about']['facts_left'] as $label => $value)
                                <li><strong>{{ $label }}:</strong> <span>{{ $value }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="fact-list">
                            @foreach ($portfolio['about']['facts_right'] as $label => $value)
                                <li><strong>{{ $label }}:</strong> <span>{{ $value }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mini-grid">
                    @foreach ($portfolio['about']['mini'] as $mini)
                        <article class="mini-card">
                            <h4>{{ $mini['value'] }}</h4>
                            <p>{{ $mini['label'] }}</p>
                        </article>
                    @endforeach
                </div>

                <p class="about-summary">{{ $portfolio['about']['summary'] }}</p>

                <div class="action-row">
                    <a href="#ai-lab" class="btn btn-accent">Explore AI Lab</a>
                    <a href="#contact" class="btn btn-outline-dark">Contact Me</a>
                    <a href="{{ $portfolio['linkedin'] }}" class="btn btn-outline-dark" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                </div>
            </div>
        </div>
    </div>
</section>
