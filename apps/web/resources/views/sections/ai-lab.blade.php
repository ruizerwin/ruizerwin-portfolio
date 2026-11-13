<section id="ai-lab" class="section-block section-alt">
    <div class="container">
        <div class="section-heading">
            <h2>AI Lab</h2>
            <p>
                Applied learning projects from my AI &amp; Machine Learning studies.
                Honest work-in-progress — focused on practical skills, not hype.
            </p>
        </div>

        <div class="row g-4">
            @foreach ($portfolio['ai_projects'] as $project)
                <div class="col-md-6 col-lg-3">
                    <article class="ai-card">
                        <p class="ai-card-kicker">Learning project</p>
                        <h3>{{ $project['title'] }}</h3>
                        <p>{{ $project['text'] }}</p>
                        <div class="stack-row">
                            @foreach ($project['tech'] as $tech)
                                <span class="stack-chip">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

        <div class="cta-band">
            <p>Next up: a Python NLP chatbot service connected to this Laravel site.</p>
            <div class="action-row justify-content-center">
                <a href="#contact" class="btn btn-accent">Let’s build something intelligent</a>
            </div>
        </div>
    </div>
</section>
