@extends('layouts.app')

@section('title', config('app.name', 'Archery Adventures'))

@section('content')
    <main id="home" class="relative">
                <section class="hero-section relative overflow-hidden bg-[#000] w-full">
                    <div class="hero-carousel absolute inset-0 h-full">
                        @forelse ($homepageHeroImages as $index => $heroImage)
                            <div
                                class="hero-slide {{ $index === 0 ? 'active' : '' }}"
                                style="background-image: url('{{ $heroImage }}');"
                            ></div>
                        @empty
                            <div class="hero-slide hero-slide--placeholder active"></div>
                        @endforelse
                        <div class="hero-carousel-scrim" aria-hidden="true"></div>
                    </div>

                    <div class="hero-content relative z-20 mx-auto max-w-7xl px-6 py-16 sm:py-20 lg:px-10 lg:py-24">
                        <div class="grid gap-10 lg:grid-cols-[1.3fr_0.9fr] lg:items-start">
                            <div class="text-white">
                                <div class="hero-headline">
                                    <span class="badge-pill text-white/95 bg-white/10">Forest-powered archery studio</span>
                                    <h1 class="mt-6 text-4xl font-heading font-bold leading-tight text-white sm:text-5xl">
                                        Welcome to Archery Adventures: your urban bow & arrow experience.
                                    </h1>
                                    <p class="mt-6 max-w-2xl text-base leading-8 text-white/85 sm:text-lg">
                                        Discover beginner lessons, advanced training, group events, and range rentals all designed for archers who want skill, style, and great outdoor energy.
                                    </p>

                                    <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:items-center">
                                        <button id="heroBookBtn" class="hero-cta">Book Now</button>
                                        <a href="#classes" class="inline-flex items-center justify-center rounded-full border border-white/80 bg-white/10 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/20">
                                            Explore Programs
                                        </a>
                                    </div>
                                </div>

                                <div class="hero-stats mt-10 grid gap-4 sm:grid-cols-3">
                                    <div class="soft-card bg-white/95 p-6 backdrop-blur-sm">
                                        <p class="text-3xl font-heading text-[#228B22]">18+</p>
                                        <p class="mt-3 text-sm text-[#5C4033]/85">Years teaching archery</p>
                                    </div>
                                    <div class="soft-card bg-white/95 p-6 backdrop-blur-sm">
                                        <p class="text-3xl font-heading text-[#228B22]">4</p>
                                        <p class="mt-3 text-sm text-[#5C4033]/85">Training programs</p>
                                    </div>
                                    <div class="soft-card bg-white/95 p-6 backdrop-blur-sm">
                                        <p class="text-3xl font-heading text-[#228B22]">100%</p>
                                        <p class="mt-3 text-sm text-[#5C4033]/85">Safety-first coaching</p>
                                    </div>
                                </div>
                            </div>

                            <div class="relative">
                                <div class="absolute -right-8 top-10 h-32 w-32 rounded-full bg-[#228B22]/10 blur-3xl"></div>
                                <div id="featuredProgramCard" class="soft-card relative overflow-hidden rounded-[42px] border border-[#5C4033]/10 p-8 lg:p-10 featured-fade bg-white/95">
                                    <div class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r from-[#228B22] via-[#DAA520] to-[#228B22] opacity-80"></div>
                                    <span id="featuredProgramLabel" class="badge-pill">Featured program</span>
                                    <h3 id="featuredProgramTitle" class="mt-6 text-3xl font-heading font-bold text-[#1B1B18]">Beginner Lessons</h3>
                                    <p id="featuredProgramDescription" class="mt-4 text-sm leading-7 text-[#5C4033]/85">
                                        Step into the range with expert instructors and premium equipment. Perfect for first-timers and weekend warriors.
                                    </p>

                                    <div id="featuredProgramPoints" class="mt-8 space-y-4">
                                        <div class="flex items-start gap-4 rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC] p-4">
                                            <span class="icon-mark">🎯</span>
                                            <div>
                                                <p class="font-semibold text-[#1B1B18]">Focused coaching</p>
                                                <p class="text-sm text-[#5C4033]/80">Personal form feedback</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-4 rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC] p-4">
                                            <span class="icon-mark">🏹</span>
                                            <div>
                                                <p class="font-semibold text-[#1B1B18]">Modern equipment</p>
                                                <p class="text-sm text-[#5C4033]/80">All gear included</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-4 rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC] p-4">
                                            <span class="icon-mark">🌿</span>
                                            <div>
                                                <p class="font-semibold text-[#1B1B18]">Outdoor energy</p>
                                                <p class="text-sm text-[#5C4033]/80">Urban range atmosphere</p>
                                            </div>
                                        </div>
                                    </div>

                                    <a id="featuredProgramButton" href="#classes" class="hero-cta mt-8 w-full justify-center">Reserve a slot</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="mx-auto w-full max-w-7xl px-6 lg:px-10 pb-16">
                    <section id="classes" class="mt-24">
                        <div class="text-center">
                        <p class="badge-pill mx-auto">Explore our archery programs</p>
                        <h2 class="mt-6 text-3xl font-heading font-bold text-[#1B1B18] sm:text-4xl">Programs built for every skill level.</h2>
                        <p class="mx-auto mt-4 max-w-2xl text-base leading-8 text-[#5C4033]/85">
                            Choose from beginner sessions, advanced training, private parties, and equipment rentals — all crafted for an unforgettable urban archery experience.
                        </p>
                    </div>

                    <div class="carousel-container mt-12 relative">
                        <button type="button" class="carousel-arrow carousel-arrow-left absolute left-0 top-1/2 z-10 -translate-y-1/2 rounded-full bg-[#1B1B18]/90 p-3 text-white shadow-lg transition hover:bg-[#000000de] hidden" aria-label="Scroll classes left">
                            <svg viewBox="0 0 24 24" class="h-5 w-5 rotate-180"><path fill="currentColor" d="M9.29 6.71a1 1 0 0 1 1.42 0l5 5a1 1 0 0 1 0 1.42l-5 5a1 1 0 1 1-1.42-1.42L13.59 12 9.29 7.71a1 1 0 0 1 0-1.42z"/></svg>
                        </button>
                        <button type="button" class="carousel-arrow carousel-arrow-right absolute right-0 top-1/2 z-10 -translate-y-1/2 rounded-full bg-[#1B1B18]/90 p-3 text-white shadow-lg transition hover:bg-[#000000de] hidden" aria-label="Scroll classes right">
                            <svg viewBox="0 0 24 24" class="h-5 w-5"><path fill="currentColor" d="M9.29 6.71a1 1 0 0 1 1.42 0l5 5a1 1 0 0 1 0 1.42l-5 5a1 1 0 1 1-1.42-1.42L13.59 12 9.29 7.71a1 1 0 0 1 0-1.42z"/></svg>
                        </button>
                        <div class="carousel-scroll" id="classCarousel">
                            @foreach ($classes as $class)
                                <article class="carousel-item carousel-card soft-card overflow-hidden rounded-[32px] border border-[#5C4033]/10 bg-white p-0 shadow-[0_30px_80px_rgba(92,64,51,0.06)]">
                                    <div class="class-image-frame h-56">
                                        @if ($class['image_url'])
                                            <img
                                                src="{{ $class['image_url'] }}"
                                                alt="{{ $class['name'] }}"
                                                class="class-image-frame__img"
                                                loading="lazy"
                                                decoding="async"
                                            />
                                        @else
                                            <div class="site-image-placeholder site-image-placeholder--class h-full min-h-0">
                                                <span class="site-image-placeholder__icon" aria-hidden="true">🏹</span>
                                                <span class="site-image-placeholder__label">Upload to class_image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-8">
                                        <span class="badge-pill">{{ $class['badge'] }}</span>
                                        <h3 class="mt-5 text-2xl font-heading font-semibold text-[#1B1B18]">{{ $class['name'] }}</h3>
                                        <p class="mt-4 text-sm leading-7 text-[#5C4033]/85">{{ $class['short_description'] }}</p>
                                        <p class="mt-5 text-lg font-semibold text-[#228B22]">{{ $class['price_label'] }}</p>
                                        <button type="button" data-view-class="{{ $class['id'] }}" class="mt-6 inline-flex text-sm font-semibold text-[#228B22] transition hover:text-[#1a6b1a]">
                                            View Class →
                                        </button>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    </section>

                <section id="testimonials" class="mt-24">
                    <div class="text-center">
                        <p class="text-sm uppercase tracking-[0.3em] text-[#5C4033]/70">What our archers say</p>
                        <h2 class="mt-4 text-3xl font-heading font-bold text-[#1B1B18] sm:text-4xl">Trusted by players across the city.</h2>
                    </div>

                    <div class="carousel-container mt-10 relative">
                        <button type="button" class="carousel-arrow carousel-arrow-left absolute left-0 top-1/2 z-10 -translate-y-1/2 rounded-full bg-[#1B1B18]/90 p-3 text-white shadow-lg transition hover:bg-[#000000de] hidden" aria-label="Scroll reviews left">
                            <svg viewBox="0 0 24 24" class="h-5 w-5 rotate-180"><path fill="currentColor" d="M9.29 6.71a1 1 0 0 1 1.42 0l5 5a1 1 0 0 1 0 1.42l-5 5a1 1 0 1 1-1.42-1.42L13.59 12 9.29 7.71a1 1 0 0 1 0-1.42z"/></svg>
                        </button>
                        <button type="button" class="carousel-arrow carousel-arrow-right absolute right-0 top-1/2 z-10 -translate-y-1/2 rounded-full bg-[#1B1B18]/90 p-3 text-white shadow-lg transition hover:bg-[#000000de] hidden" aria-label="Scroll reviews right">
                            <svg viewBox="0 0 24 24" class="h-5 w-5"><path fill="currentColor" d="M9.29 6.71a1 1 0 0 1 1.42 0l5 5a1 1 0 0 1 0 1.42l-5 5a1 1 0 1 1-1.42-1.42L13.59 12 9.29 7.71a1 1 0 0 1 0-1.42z"/></svg>
                        </button>
                        <div class="carousel-scroll" id="reviewCarousel">
                            @if ($carouselReviews->isNotEmpty())
                                @include('partials.review-carousel', ['carouselReviews' => $carouselReviews])
                            @else
                                <article class="carousel-item carousel-card soft-card p-8">
                                    <p class="text-sm leading-7 text-[#5C4033]/85">Share your experience on our Contact page — reviews with 4 stars or above appear here.</p>
                                </article>
                            @endif
                        </div>
                    </div>
                </section>

                <section id="instructors" class="mt-24">
                    <div class="text-center">
                        <p class="badge-pill mx-auto">Meet our instructors</p>
                        <h2 class="mt-6 text-3xl font-heading font-bold text-[#1B1B18] sm:text-4xl">The crew behind every arrow.</h2>
                        <p class="mx-auto mt-4 max-w-2xl text-base leading-8 text-[#5C4033]/85">
                            Each instructor blends tournament experience with calm, encouraging teaching so every student feels supported — with our top instructors.
                        </p>
                    </div>

                    <div class="mt-8 grid gap-6 sm:grid-cols-3">
                        @foreach (($instructors ?? []) as $inst)
                            <article class="soft-card p-6 text-center">
                                <img src="{{ $inst['image_url'] }}" alt="{{ $inst['first_name'] }} {{ $inst['last_name'] }}" class="mx-auto mb-4 h-28 w-28 rounded-full object-cover" />
                                <h3 class="text-xl font-heading font-semibold text-[#1B1B18]">{{ $inst['first_name'] }} {{ $inst['last_name'] }}</h3>
                                <p class="mt-2 text-sm leading-7 text-[#5C4033]/80">"{{ $inst['quote'] }}"</p>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section id="about" class="mt-24 rounded-[32px] border border-[#5C4033]/10 bg-white/80 p-10 shadow-[0_30px_80px_rgba(92,64,51,0.08)]">
                    <div class="grid gap-8 lg:grid-cols-2 lg:items-center">
                        <div>
                            <p class="badge-pill">About Archery Adventures</p>
                            <h2 class="mt-5 text-3xl font-heading font-bold text-[#1B1B18] sm:text-4xl">A modern archery home built for welcoming learners.</h2>
                            <p class="mt-6 text-base leading-8 text-[#5C4033]/85">
                                Our space blends indoor comfort with outdoor spirit so every visit feels fresh, safe, and inspiring. We serve first timers, families, competitive shooters, and event groups.
                            </p>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="soft-card p-5">
                                <p class="text-sm uppercase tracking-[0.2em] text-[#5C4033]/70">Why choose us</p>
                                <p class="mt-3 text-sm leading-7 text-[#5C4033]/85">Coaching, gear, and environment designed around archery growth.</p>
                            </div>
                            <div class="soft-card p-5">
                                <p class="text-sm uppercase tracking-[0.2em] text-[#5C4033]/70">Our promise</p>
                                <p class="mt-3 text-sm leading-7 text-[#5C4033]/85">Fun, focus, and a safe learning path on every visit.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="contact" class="mt-24 rounded-[32px] bg-[#228B22] px-8 py-12 text-white shadow-[0_30px_80px_rgba(34,139,34,0.18)]">
                    <div class="mx-auto max-w-3xl text-center">
                        <p class="text-sm uppercase tracking-[0.3em] text-[#F5F5DC]/80">Ready to book?</p>
                        <h2 class="mt-4 text-3xl font-heading font-bold sm:text-4xl">Get in touch and lock in your next session.</h2>
                        <p class="mx-auto mt-4 max-w-2xl text-base leading-8 text-[#F5F5DC]/90">
                            Send us a message and we’ll help you choose the perfect program for your skills and schedule.
                        </p>
                        <div class="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                            <a href="{{ route('contact') }}" class="hero-cta bg-[#F5F5DC] text-[#1B1B18] hover:bg-[#fff7d1]">Contact Us</a>
                            <a href="tel:+639123456789" class="inline-flex items-center justify-center rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Call +63 912 345 6789</a>
                        </div>
                    </div>
                </section>
                </div>

                @include('partials.class-modals')
            </main>

            <!-- Login Modal -->
            <div id="loginModal" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm">
                <div class="w-full max-w-md rounded-[32px] bg-white/95 shadow-2xl">
                    <div class="space-y-6 p-8">
                        <div class="text-center">
                            <h2 class="text-3xl font-heading font-bold text-[#1B1B18]">Welcome Back</h2>
                            <p class="mt-2 text-sm text-[#5C4033]/70">Sign in to your archery account</p>
                        </div>

                        <form id="loginForm" class="space-y-4">
                            <div id="loginError" class="hidden rounded-3xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"></div>

                            <div class="form-group relative">
                                <label for="loginEmail" class="text-sm font-semibold text-[#1B1B18]">Email</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    </span>
                                    <input type="email" name="email" id="loginEmail" placeholder="your@email.com" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-4 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                </div>
                            </div>

                            <div class="form-group relative">
                                <label for="loginPassword" class="text-sm font-semibold text-[#1B1B18]">Password</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </span>
                                    <input type="password" name="password" id="loginPassword" placeholder="Enter your password" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-11 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                    <button type="button" id="loginPasswordToggle" class="absolute inset-y-0 right-3 flex items-center text-[#5C4033]/80 transition hover:text-[#1B1B18]" aria-label="Toggle password visibility">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="w-full rounded-full bg-[#228B22] py-3 font-semibold text-white transition hover:bg-[#1a6b1a]">Sign In</button>

                            <div class="text-center">
                                <p class="text-sm text-[#5C4033]/70">
                                    Don't have an account?
                                    <button type="button" id="switchToSignup" class="font-semibold text-[#228B22] transition hover:text-[#1a6b1a]">Sign Up</button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- SignUp Modal -->
            <div id="signupModal" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm overflow-y-auto">
                <div class="my-auto w-full max-w-md rounded-[32px] bg-white/95 shadow-2xl">
                    <div class="space-y-6 p-8">
                        <div class="text-center">
                            <h2 class="text-3xl font-heading font-bold text-[#1B1B18]">Join the Range</h2>
                            <p class="mt-2 text-sm text-[#5C4033]/70">Create your archery account</p>
                        </div>

                        <form id="signupForm" class="space-y-4">
                            <div id="signupError" class="hidden rounded-3xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"></div>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <div class="form-group">
                                    <label for="firstName" class="text-sm font-semibold text-[#1B1B18]">First Name</label>
                                    <div class="relative mt-2">
                                        <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        </span>
                                        <input type="text" name="first_name" id="firstName" placeholder="John" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-4 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastName" class="text-sm font-semibold text-[#1B1B18]">Last Name</label>
                                    <div class="relative mt-2">
                                        <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                        </span>
                                        <input type="text" name="last_name" id="lastName" placeholder="Doe" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-4 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="signupEmail" class="text-sm font-semibold text-[#1B1B18]">Email</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    </span>
                                    <input type="email" name="email" id="signupEmail" placeholder="your@email.com" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-4 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phoneNumber" class="text-sm font-semibold text-[#1B1B18]">Phone Number</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                    </span>
                                    <input type="tel" name="phone_number" id="phoneNumber" placeholder="+1 (555) 123-4567" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-4 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="archeryStatus" class="text-sm font-semibold text-[#1B1B18]">Current Archery Status</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke-width="2" /><circle cx="12" cy="12" r="5" stroke-width="2" /><circle cx="12" cy="12" r="1.5" stroke-width="2" /></svg>
                                    </span>
                                    <select name="archery_status" id="archeryStatus" required class="w-full appearance-none rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-10 py-3 text-sm transition focus:border-[#228B22] focus:bg-white focus:outline-none">
                                        <option value="" disabled selected>Select your status</option>
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advanced">Advanced</option>
                                        <option value="professional">Professional</option>
                                    </select>
                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-[#5C4033]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="signupPassword" class="text-sm font-semibold text-[#1B1B18]">Password</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </span>
                                    <input type="password" name="password" id="signupPassword" placeholder="Create a strong password" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-11 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                    <button type="button" id="signupPasswordToggle" class="absolute inset-y-0 right-3 flex items-center text-[#5C4033]/80 transition hover:text-[#1B1B18]" aria-label="Toggle password visibility">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>
                                </div>
                                <div id="passwordStrength" class="mt-3 flex items-center gap-3 text-sm font-medium text-[#5C4033]">
                                    <span class="font-semibold">Strength:</span>
                                    <div class="h-2 w-full overflow-hidden rounded-full bg-[#E5E7EB]">
                                        <div id="passwordStrengthBar" class="h-full w-0 rounded-full bg-red-500 transition-all duration-200"></div>
                                    </div>
                                    <span id="passwordStrengthLabel" class="min-w-[80px] text-xs font-semibold uppercase"></span>
                                </div>
                                <p id="passwordRequirements" class="mt-2 text-xs text-[#5C4033]/80">At least 8 characters, one uppercase, one number, one special character.</p>
                            </div>

                            <div class="form-group">
                                <label for="confirmPassword" class="text-sm font-semibold text-[#1B1B18]">Confirm Password</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                    </span>
                                    <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Confirm your password" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-11 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                    <button type="button" id="confirmPasswordToggle" class="absolute inset-y-0 right-3 flex items-center text-[#5C4033]/80 transition hover:text-[#1B1B18]" aria-label="Toggle password visibility">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="w-full rounded-full bg-[#228B22] py-3 font-semibold text-white transition hover:bg-[#1a6b1a]">Create Account</button>

                            <div class="text-center">
                                <p class="text-sm text-[#5C4033]/70">
                                    Already have an account?
                                    <button type="button" id="switchToLogin" class="font-semibold text-[#228B22] transition hover:text-[#1a6b1a]">Sign In</button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @push('scripts')
        @vite(['resources/js/classes.js'])
    @endpush
@endsection
