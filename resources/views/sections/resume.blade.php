<section id="resume" class="section-block section-alt">
    <div class="container">
        <div class="section-heading">
            <h2>Resume</h2>
            <p>{{ $portfolio['resume']['summary_title'] }}</p>
        </div>

        <div class="action-row resume-actions">
            @if ($resumeAvailable)
                <a href="{{ asset($portfolio['resume_pdf']) }}" class="btn btn-accent" target="_blank" rel="noopener">
                    <i class="bi bi-download"></i> Download PDF Resume
                </a>
            @endif
            <a href="{{ $portfolio['linkedin'] }}" class="btn btn-outline-dark" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-linkedin"></i> Connect on LinkedIn
            </a>
            <a href="#contact" class="btn btn-outline-dark">
                <i class="bi bi-envelope"></i> Get in Touch
            </a>
        </div>

        {{-- 1) Summary first: who you are --}}
        <article class="resume-card resume-summary-card">
            <div class="resume-summary-top">
                <div>
                    <h3 class="resume-person-name">{{ $portfolio['name'] }}</h3>
                    <p class="resume-role">{{ $portfolio['resume']['summary_title'] }}</p>
                </div>
                <ul class="contact-mini contact-mini-inline">
                    <li>London, ON</li>
                    <li><a href="tel:{{ $portfolio['phone_tel'] }}">{{ $portfolio['phone'] }}</a></li>
                    <li><a href="mailto:{{ $portfolio['email'] }}">{{ $portfolio['email'] }}</a></li>
                    <li><a href="{{ $portfolio['website'] }}" target="_blank" rel="noopener noreferrer">www.ruizerwin.com</a></li>
                </ul>
            </div>
            <p class="resume-summary-text">{{ $portfolio['resume']['summary'] }}</p>
        </article>

        {{-- 2) Experience next: strongest hiring signal --}}
        <div class="resume-block">
            <div class="resume-block-head">
                <h3>Professional Experience</h3>
                <p>Work history in order of most recent role.</p>
            </div>

            <div class="experience-list">
                @foreach ($portfolio['resume']['experience'] as $job)
                    <article class="experience-item">
                        <div class="experience-meta">
                            <span class="experience-dates">{{ $job['dates'] }}</span>
                            <span class="experience-company">{{ $job['company'] }}</span>
                        </div>
                        <h4 class="experience-title">{{ $job['title'] }}</h4>
                        <ul class="experience-bullets">
                            @foreach ($job['bullets'] as $bullet)
                                <li>{{ $bullet }}</li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>

        {{-- 3) Skills in one clear panel with labeled rows --}}
        <div class="resume-block">
            <div class="resume-block-head">
                <h3>Technical Skills</h3>
                <p>Grouped by area so recruiters can scan quickly.</p>
            </div>

            <article class="resume-card skills-panel">
                @foreach ($portfolio['resume']['skill_groups'] as $group => $skills)
                    <div class="skill-row {{ str_contains(strtolower($group), 'learning') ? 'skill-row-learning' : '' }}">
                        <div class="skill-row-label">{{ $group }}</div>
                        <div class="stack-row">
                            @foreach ($skills as $skill)
                                <span class="stack-chip">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </article>
        </div>

        {{-- 4) Education last, clean timeline style --}}
        <div class="resume-block">
            <div class="resume-block-head">
                <h3>Education and Training</h3>
                <p>Formal education first, then short courses.</p>
            </div>

            <div class="education-list">
                @foreach ($portfolio['resume']['education'] as $item)
                    <article class="education-item">
                        <div class="education-dates">{{ $item['dates'] ?? '' }}</div>
                        <div class="education-body">
                            <h4>{{ $item['title'] }}</h4>
                            @if (!empty($item['credential']))
                                <p class="education-credential">{{ $item['credential'] }}</p>
                            @endif
                            <p class="education-school">{{ $item['meta'] }}</p>
                            @if (!empty($item['text']))
                                <p class="education-note">{{ $item['text'] }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach

                @if (!empty($portfolio['resume']['additional_training']))
                    <article class="education-item education-item-extra">
                        <div class="education-dates">Extra</div>
                        <div class="education-body">
                            <h4>Additional Training</h4>
                            <ul class="training-list">
                                @foreach ($portfolio['resume']['additional_training'] as $training)
                                    <li>{{ $training }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </article>
                @endif
            </div>
        </div>
    </div>
</section>
