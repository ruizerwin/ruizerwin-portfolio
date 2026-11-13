<footer class="site-footer">
    <div class="container footer-inner">
        <h2 class="footer-name">{{ $portfolio['name'] }}</h2>
        <p class="footer-text">
            {{ $portfolio['role'] }} · Laravel &amp; cloud experience · Applied AI/ML at Fanshawe College · London, ON
        </p>

        <div class="social-row">
            <a href="{{ $portfolio['linkedin'] }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="{{ $portfolio['github'] }}" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="bi bi-github"></i></a>
            <a href="{{ $portfolio['facebook'] }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="{{ $portfolio['instagram'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
        </div>

        <p class="footer-copy">
            Copyright <strong>{{ $portfolio['name'] }}</strong> All Rights Reserved {{ date('Y') }}
        </p>
        <p class="footer-credits">Built with Laravel 13, Bootstrap 5 &amp; AWS Lightsail</p>
    </div>
</footer>
