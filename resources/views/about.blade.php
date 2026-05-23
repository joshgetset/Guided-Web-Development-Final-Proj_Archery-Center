@extends('layouts.app', ['activePage' => 'about'])

@section('title', 'About Us · ' . config('app.name', 'Archery Adventures'))

@section('content')
    <section class="about-hero about-hero--fullbleed hero-section relative min-h-[32rem] w-full overflow-hidden bg-[#141412] sm:min-h-[36rem] lg:min-h-[40rem]">
        <div class="hero-carousel about-hero-carousel absolute inset-0 h-full w-full">
            @foreach ($heroSlides as $index => $slide)
                @if ($slide['image'])
                    <div class="hero-slide about-hero-slide {{ $index === 0 ? 'active' : '' }}">
                        <img
                            src="{{ $slide['image'] }}"
                            alt=""
                            class="about-hero-slide__img"
                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                            decoding="async"
                        />
                    </div>
                @else
                    <div class="hero-slide hero-slide--placeholder {{ $index === 0 ? 'active' : '' }}"></div>
                @endif
            @endforeach
            <div class="hero-carousel-scrim hero-carousel-scrim--about" aria-hidden="true"></div>
        </div>

        <div class="about-hero-content relative z-20 mx-auto flex min-h-[32rem] max-w-7xl items-center px-6 py-16 sm:min-h-[36rem] sm:py-20 lg:min-h-[40rem] lg:px-10">
            <div class="max-w-3xl text-white">
                @foreach ($heroSlides as $index => $slide)
                    <div class="about-hero-caption {{ $index === 0 ? 'active' : '' }}" data-about-hero-caption="{{ $index }}">
                        <p class="text-sm uppercase tracking-[0.3em] text-[#F5F5DC]/85">{{ $slide['badge'] }}</p>
                        <h1 class="mt-4 font-heading text-4xl font-bold leading-tight sm:text-5xl">{{ $slide['title'] }}</h1>
                        <p class="mt-5 max-w-2xl text-base leading-8 text-white/85 sm:text-lg">{{ $slide['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="about-page">
        <section class="about-intro mx-auto w-full max-w-7xl px-6 py-14 text-center sm:py-16 lg:px-10 lg:py-20">
            <h2 class="font-heading text-5xl font-bold leading-tight text-[#1B1B18] sm:text-6xl">About Us</h2>
            <p class="mx-auto mt-6 max-w-3xl text-justify text-base leading-8 text-[#5C4033]/85 sm:text-lg">
                Archery Adventures is a community-focused urban range where beginners, families, and competitive archers train with confidence. We combine expert coaching, modern equipment, and a welcoming atmosphere so every visit feels purposeful and fun.
            </p>
        </section>

        <section class="about-team-band bg-[#F5F5DC]">
            <div class="mx-auto w-full max-w-7xl px-6 py-16 sm:py-20 lg:px-10">
                <p class="text-sm uppercase tracking-[0.28em] text-[#5C4033]/70">{{ $team['label'] }}</p>
                <h2 class="mt-4 max-w-3xl font-heading text-4xl font-bold leading-tight text-[#1B1B18] sm:text-5xl">{{ $team['title'] }}</h2>
                <p class="mt-6 max-w-3xl text-base leading-8 text-[#5C4033]/85">{{ $team['body'] }}</p>

                <div class="about-staff-grid mt-12 grid gap-8 md:grid-cols-3">
                    @foreach ($team['members'] as $member)
                        <article class="about-staff-card flex flex-col overflow-hidden border border-[#5C4033]/8 bg-white shadow-[0_18px_50px_rgba(92,64,51,0.08)]">
                            <div class="about-staff-card__image aspect-[4/5] overflow-hidden bg-[#F0F0EB]">
                                @if ($member['image'])
                                    <img src="{{ $member['image'] }}" alt="{{ $member['title'] }}" class="h-full w-full object-cover object-top" loading="lazy" />
                                @else
                                    <div class="site-image-placeholder site-image-placeholder--portrait h-full">
                                        <span class="site-image-placeholder__icon" aria-hidden="true">👤</span>
                                        <span class="site-image-placeholder__label">about_us_image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="about-staff-card__bar flex items-center bg-[#D8E8D8] px-5 py-3">
                                <span class="text-sm font-semibold tracking-[0.2em] text-[#1B1B18]">{{ $member['index'] }}</span>
                            </div>
                            <div class="about-staff-card__body flex flex-1 flex-col px-6 py-7 text-left">
                                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-[#228B22]">{{ $member['name'] }}</p>
                                <h3 class="mt-3 text-xl font-bold text-[#1B1B18]">{{ $member['title'] }}</h3>
                                <p class="mt-4 text-sm leading-7 text-[#5C4033]/85">{{ $member['description'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        @foreach ($sections as $index => $section)
            <section class="about-story-band {{ $index % 2 === 0 ? 'bg-white' : 'bg-[#F5F5DC]' }}">
                <div class="about-story-row mx-auto grid min-w-0 max-w-7xl items-center gap-10 px-6 py-16 sm:py-20 lg:grid-cols-2 lg:gap-14 lg:px-10 {{ !empty($section['reverse']) ? 'about-story-row--reverse' : '' }}">
                    <div class="about-story-media min-w-0 {{ !empty($section['reverse']) ? 'lg:order-1' : 'lg:order-2' }}">
                        <div class="about-story-media__frame h-[18rem] w-full overflow-hidden rounded-[28px] shadow-[0_30px_80px_rgba(92,64,51,0.12)] sm:h-[22rem]">
                            @if ($section['image'])
                                <img src="{{ $section['image'] }}" alt="{{ $section['label'] }}" class="h-full w-full object-cover" loading="lazy" />
                            @else
                                <div class="site-image-placeholder h-full min-h-[18rem] sm:min-h-[22rem]">
                                    <span class="site-image-placeholder__icon" aria-hidden="true">🏹</span>
                                    <span class="site-image-placeholder__label">about_us_image</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="about-story-copy min-w-0 {{ !empty($section['reverse']) ? 'lg:order-2' : 'lg:order-1' }}">
                        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-[#228B22]">{{ $section['label'] }}</p>
                        <h3 class="mt-4 font-heading text-3xl font-bold leading-tight text-[#1B1B18] sm:text-4xl">{{ $section['title'] }}</h3>
                        <p class="mt-6 text-base leading-8 text-[#5C4033]/85">{{ $section['body'] }}</p>
                        @if (!empty($section['milestones']))
                            <ul class="mt-8 space-y-4 border-t border-[#5C4033]/10 pt-8">
                                @foreach ($section['milestones'] as $milestone)
                                    <li class="text-base leading-7 text-[#5C4033]/85">{{ $milestone }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </section>
        @endforeach

        <section class="bg-[#F5F5DC]">
            <div class="mx-auto max-w-7xl px-6 pb-16 sm:pb-20 lg:px-10">
                <div class="rounded-[32px] bg-[#228B22] px-8 py-12 text-center text-white shadow-[0_30px_80px_rgba(34,139,34,0.18)] sm:px-10">
                    <p class="text-sm uppercase tracking-[0.3em] text-[#F5F5DC]/80">Visit the range</p>
                    <h3 class="mt-4 font-heading text-3xl font-bold sm:text-4xl">Ready to experience Archery Adventures?</h3>
                    <p class="mx-auto mt-4 max-w-2xl text-base leading-8 text-[#F5F5DC]/90">
                        Book a session, explore our classes, or connect with a coach to start your archery journey today.
                    </p>
                    <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                        <a href="{{ route('classes') }}" class="hero-cta bg-[#F5F5DC] text-[#1B1B18] hover:bg-[#fff7d1]">Explore classes</a>
                        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Contact us</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/about.js'])
@endpush
