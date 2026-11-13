<section id="portfolio" class="section-block">
    <div class="container">
        <div class="section-heading">
            <h2>Selected Work</h2>
            <p>Selected production systems and integrations — the foundation I’m now combining with applied AI.</p>
        </div>

        <div class="row g-4">
            @foreach ($portfolio['projects'] as $project)
                <div class="col-lg-4 col-md-6">
                    <article class="project-card">
                        <div class="project-media">
                            <img
                                src="{{ asset($project['image']) }}"
                                alt="{{ $project['title'] }}"
                                loading="lazy">
                            <span class="impact-badge">{{ $project['impact'] }}</span>
                        </div>

                        <div class="project-body">
                            <p class="project-subtitle">{{ $project['subtitle'] }}</p>
                            <h3>{{ $project['title'] }}</h3>
                            <p>{{ $project['description'] }}</p>

                            <ul class="result-list">
                                @foreach ($project['results'] as $result)
                                    <li>{{ $result }}</li>
                                @endforeach
                            </ul>

                            <div class="stack-row">
                                @foreach ($project['tech'] as $tech)
                                    <span class="stack-chip">{{ $tech }}</span>
                                @endforeach
                            </div>

                            <p class="project-status">{{ $project['status'] }}</p>

                            <div class="action-row">
                                <button
                                    type="button"
                                    class="btn btn-accent btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#caseStudyModal"
                                    data-title="{{ $project['title'] }}"
                                    data-role="{{ $project['case_study']['role'] }}"
                                    data-challenge="{{ $project['case_study']['challenge'] }}"
                                    data-approach="{{ $project['case_study']['approach'] }}"
                                    data-outcome="{{ $project['case_study']['outcome'] }}">
                                    Case Study
                                </button>
                                <a href="#contact" class="btn btn-outline-dark btn-sm">Ask for Details</a>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="caseStudyModal" tabindex="-1" aria-labelledby="caseStudyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content case-modal">
                <div class="modal-header">
                    <div>
                        <p class="modal-kicker mb-1">Case Study</p>
                        <h5 class="modal-title" id="caseStudyModalLabel">Project</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="case-block">
                        <h6>Role</h6>
                        <p data-case-role></p>
                    </div>
                    <div class="case-block">
                        <h6>Challenge</h6>
                        <p data-case-challenge></p>
                    </div>
                    <div class="case-block">
                        <h6>Approach</h6>
                        <p data-case-approach></p>
                    </div>
                    <div class="case-block">
                        <h6>Outcome</h6>
                        <p data-case-outcome></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#contact" class="btn btn-outline-dark" data-bs-dismiss="modal">Discuss a Similar Project</a>
                    <button type="button" class="btn btn-accent" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>
