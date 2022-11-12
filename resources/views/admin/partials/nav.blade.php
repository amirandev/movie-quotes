<section class="leftbar" id="leftbar_menu">
    <div class="sidebar-logo">
        <a href="{{ route('home') }}" class="text-uppercase">{{ __('main.quotesFromMovies') }}</a>
    </div>

    <div class="leftbar-links m-2">
        <a href="{{ route('home') }}">
            <i class="las la-home lbm"></i>
            <span class="leftabr-cattitle">{{ __('main.home') }}</span>
        </a>

        <a href="{{ route('dashboard') }}" class="{{ routeActive('dashboard') }}">
            <i class="las la-tachometer-alt lbm"></i>
            <span class="leftabr-cattitle">{{ __('main.dashboard') }}</span>
        </a>

        <a href="{{ route('admin.directors') }}" class="{{ routeActive('admin.directors') }}">
            <i class="las la-users lbm"></i>
            <span class="leftabr-cattitle">{{ __('main.directors') }}</span>
        </a>

        <a href="{{ route('admin.movies') }}" class="{{ routeActive('admin.movies') }}">
            <i class="las la-film lbm"></i>
            <span class="leftabr-cattitle">{{ __('main.movies') }}</span>
        </a>

        <a href="{{ route('admin.quotes') }}" class="{{ routeActive('admin.quotes') }}">
            <i class="las la-quote-right lbm"></i>
            <span class="leftabr-cattitle">{{ __('main.quotes') }}</span>
        </a>
    </div>
</section>

