<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <img src="{{ asset($components->logo_apk) }}" width="50" height="50" alt="">
            <span class="app-brand-text demo menu-text fw-bold">{{ $components->nama_apk }}</span>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
        </li>
        <li class="menu-item">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-layout-dashboard"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('home.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-home-2"></i>
                <div data-i18n="Home">Home</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('about.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div data-i18n="About Me">About Me</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('services.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                <div data-i18n="Services">Services</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('news.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-news"></i>
                <div data-i18n="News">News</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('portofolio.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-photo"></i>
                <div data-i18n="Portfolio">Portfolio</div>
            </a>
        </li>   
        <li class="menu-item">
            <a href="{{ route('settings.index') }}" class="menu-link">
                <i class="ti ti-settings me-3 ti-md"></i>
                <div data-i18n="Settings">Settings</div>
            </a>
        </li>   
    </ul>
</aside>
