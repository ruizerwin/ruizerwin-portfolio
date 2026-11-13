<section id="highlights" class="section-block section-alt">
    <div class="container">
        <div class="section-heading">
            <h2>Why work with me</h2>
            <p>Production experience plus an active AI/ML path — practical, honest, and future-focused.</p>
        </div>

        <div class="row g-4">
            @foreach ($portfolio['highlights'] as $item)
                <div class="col-lg-4 col-md-6">
                    <article class="feature-card">
                        <div class="feature-icon"><i class="bi {{ $item['icon'] }}"></i></div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </article>
                </div>
            @endforeach
        </div>

        <div class="cta-band">
            <p>Freelance · Contract · Remote — based in London, Ontario</p>
            <div class="action-row justify-content-center">
                <a href="#contact" class="btn btn-accent">Start a Conversation</a>
            </div>
        </div>
    </div>
</section>
