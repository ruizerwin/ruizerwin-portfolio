<header class="site-header" id="siteHeader">
    <div class="container header-inner">
        <a href="#home" class="brand-mark">{{ $portfolio['name'] }}</a>

        <button
            class="nav-toggle d-lg-none"
            type="button"
            id="navToggle"
            aria-expanded="false"
            aria-controls="siteNav"
            aria-label="Open menu">
            <i class="bi bi-list"></i>
        </button>

        <nav class="site-nav" id="siteNav" aria-label="Primary">
            <ul>
                @foreach ($portfolio['nav'] as $item)
                    <li>
                        <a href="{{ $item['href'] }}" @if($item['href'] === '#home') class="is-active" @endif>
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>
