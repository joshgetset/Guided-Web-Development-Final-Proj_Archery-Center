@php
    $activePage = $activePage ?? null;
@endphp
<header class="site-header sticky top-0 z-30 border-b border-[#1B1B18]/10 bg-[#5C4033] shadow-lg">
    <div class="site-header-inner mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-6 py-5">
        <a href="{{ url('/') }}" class="site-header-brand flex items-center gap-4">
            <img src="{{ asset('images/logo.svg') }}" alt="Archery Adventures logo" class="site-header-logo h-16 w-auto object-contain" />
            <h1 class="site-brand text-2xl font-semibold text-white sm:text-3xl">Archery Adventures</h1>
        </a>

        <nav class="site-header-nav flex flex-wrap items-center gap-6 text-sm font-semibold text-white sm:text-base">
            <a href="{{ url('/') }}" class="nav-link {{ $activePage === 'home' ? 'nav-link-active' : '' }}">Home</a>
            <a href="{{ route('classes') }}" class="nav-link {{ $activePage === 'classes' ? 'nav-link-active' : '' }}">Class</a>
            <a href="{{ route('instructors') }}" class="nav-link {{ $activePage === 'instructors' ? 'nav-link-active' : '' }}">Instructors</a>
            <a href="{{ route('about') }}" class="nav-link {{ $activePage === 'about' ? 'nav-link-active' : '' }}">About Us</a>
            <a href="{{ route('contact') }}" class="nav-link {{ $activePage === 'contact' ? 'nav-link-active' : '' }}">Contact</a>
            <div id="authButtonContainer">
                <button id="navLoginBtn" type="button" class="rounded-full bg-[#DAA520] px-5 py-2 font-semibold text-[#1B1B18] transition hover:bg-[#ffc107]">Login</button>
            </div>
        </nav>
    </div>
</header>
