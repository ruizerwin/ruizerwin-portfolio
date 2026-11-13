<section id="home" class="hero-section hero-centered">
    <img
        src="{{ asset('images/home_bg.jpg') }}"
        alt=""
        class="hero-bg"
        fetchpriority="high">

    <div class="hero-overlay" aria-hidden="true"></div>

    <div class="container hero-content">
        <p class="hero-status reveal">{{ $portfolio['hero']['status'] }}</p>
        <p class="hero-kicker reveal">{{ $portfolio['hero']['badge'] }}</p>

        <h1 class="hero-name reveal">
            <span class="hero-name-line">Erwin D.</span>
            <span class="hero-name-line hero-name-emphasis">Padilla</span>
        </h1>

        <p class="hero-lead reveal">{{ $portfolio['hero']['lead'] }}</p>

        <div class="hero-actions reveal">
            <a href="#ai-lab" class="btn btn-accent">Explore AI Lab</a>
            <a href="#contact" class="btn btn-ghost">Contact Me</a>
        </div>

        <div class="hero-secondary reveal">
            <a href="{{ $portfolio['linkedin'] }}" class="hero-text-link" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-linkedin"></i> LinkedIn
            </a>
            <a href="#portfolio" class="hero-text-link">
                <i class="bi bi-briefcase"></i> View Work
            </a>
        </div>

        <p class="hero-availability reveal">{{ $portfolio['hero']['availability'] }}</p>
    </div>
</section>

<section class="hero-support" aria-label="Modern focus areas">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-7">
                <h2 class="support-title">What I’m building toward</h2>
                <ul class="benefit-list">
                    @foreach ($portfolio['hero']['benefits'] as $benefit)
                        <li><i class="bi bi-check2"></i><span>{{ $benefit }}</span></li>
                    @endforeach
                </ul>

                <p class="typed-line">
                    <span class="typed-label">Focused on:</span>
                    <span
                        class="typed-target"
                        data-typed-items="{{ implode(',', $portfolio['hero']['typed']) }}"></span>
                </p>

                <div class="stack-groups">
                    <div>
                        <p class="stack-group-label">Core now</p>
                        <div class="stack-row">
                            @foreach ($portfolio['hero']['stack_core'] as $item)
                                <span class="stack-chip">{{ $item }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <p class="stack-group-label">Building now</p>
                        <div class="stack-row">
                            @foreach ($portfolio['hero']['stack_learning'] as $item)
                                <span class="stack-chip stack-chip-learning">{{ $item }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="stats-grid stats-grid-modern">
                    @foreach ($portfolio['stats'] as $stat)
                        <article class="stat-card">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{ $stat['label'] }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="social-row support-social">
                    <a href="{{ $portfolio['linkedin'] }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="{{ $portfolio['github'] }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="bi bi-github"></i></a>
                    <a href="{{ $portfolio['facebook'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="{{ $portfolio['instagram'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
