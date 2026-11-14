<section id="services" class="section-block">
    <div class="container">
        <div class="section-heading">
            <h2>Services</h2>
            <p>APIs, cloud delivery, product improvement, and early AI feature prototyping.</p>
        </div>

        <div class="row g-4">
            @foreach ($portfolio['services'] as $service)
                <div class="col-lg-4 col-md-6">
                    <article class="service-card">
                        <div class="feature-icon"><i class="bi {{ $service['icon'] }}"></i></div>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['text'] }}</p>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
