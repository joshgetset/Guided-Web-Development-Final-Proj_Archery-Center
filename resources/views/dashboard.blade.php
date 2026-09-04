@extends('layouts.admin')

@section('title', 'Dashboard · ' . config('app.name', 'Archery Adventures'))

@section('content')
    <div class="min-h-screen bg-[#EDF1F5] text-[#1B1B18]">
        <div class="relative flex min-h-screen">
            <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-20 w-64 transform border-r border-white/10 bg-[#5C4033] px-4 py-6 text-white transition-all duration-300 ease-in-out overflow-hidden flex flex-col">
                <div>
                    <div class="flex items-center gap-3 px-1">
                        <img src="{{ asset('images/logo.svg') }}" alt="Archery Adventures logo" class="h-9 w-9 flex-shrink-0 rounded-3xl bg-white/10 p-2" />
                        <div class="sidebar-text">
                            <p class="text-sm font-semibold text-white">Archery</p>
                            <p class="text-xs text-[#CBD5E1]/60">Dashboard</p>
                        </div>
                    </div>

                    <nav class="mt-6 space-y-0 text-sm font-medium text-[#CBD5E1]">
                        <a href="#overview" class="sidebar-link flex items-center gap-3 rounded-lg bg-white px-2 py-1.5 text-[#1B1B18] transition hover:bg-white/95" aria-current="page">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Overview</span>
                        </a>
                        <a href="#classes" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.423 2 15.5c0 5.078 4.5 9.247 10 9.247s10-4.169 10-9.247c0-5.077-4.5-9.247-10-9.247z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Classes</span>
                        </a>
                        <a href="#instructors" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M7.667 8.879a6 6 0 1110.666 0M12 12.5v.005M12.5 16.5h-1a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Instructors</span>
                        </a>
                        <a href="/dashboard/bookings" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m4 0H5" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Bookings</span>
                        </a>
                        <a href="#stats" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 12h6m-6 4h8m-8-8h10M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Statistics</span>
                        </a>
                        <a href="#activity" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Activity</span>
                        </a>
                        <a href="#tools" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197 3.197a4 4 0 01-1.414 1.414l-1.732.577a1 1 0 00-.57 1.569l.776 1.165a1 1 0 001.311.318l1.733-.866a4 4 0 011.828-.461l3.197-3.197m1.414-1.414l2.121-2.121a2 2 0 10-2.828-2.828l-2.121 2.121" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Tools</span>
                        </a>
                    </nav>
                </div>

                <div class="mt-auto pt-6">
                    <button id="logoutBtn" class="flex w-full items-center gap-3 rounded-full bg-[#EF4444] px-3 py-2 text-sm font-semibold text-white transition hover:bg-[#DC2626]">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-transparent text-current">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                            </svg>
                        </span>
                        <span class="sidebar-text">Sign out</span>
                    </button>
                </div>
            </aside>

            <div id="dashboardContent" class="flex-1 transition-all duration-300" style="padding-left:18rem;">
                <header class="sticky top-0 z-10 border-b border-slate-200 bg-[#F5F5DC] px-6 py-4 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <button id="sidebarToggle" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[#228B22] text-white shadow transition hover:bg-[#1a6b1a]" aria-label="Toggle sidebar" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div>
                            <p class="text-sm text-[#5C4033]/80">Admin Dashboard</p>
                            <h1 class="text-2xl font-semibold text-[#1B1B18]">Dashboard</h1>
                        </div>

                        <div class="hidden items-center gap-3 rounded-3xl bg-white px-4 py-3 shadow-sm sm:flex">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-[#DAA520] text-sm font-semibold text-[#1B1B18]">{{ strtoupper(substr($user->first_name ?? $user->name, 0, 1)) }}</span>
                            <div>
                                <p class="text-sm font-semibold text-[#1B1B18]">{{ $user->first_name ?? $user->name }}</p>
                                <p class="text-xs text-[#5C4033]/80">Administrator</p>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="px-6 py-8">
                    <section id="overview" class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(92,64,51,0.08)]">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm uppercase tracking-[0.2em] text-[#5C4033]/70">Overview</p>
                                <h2 class="mt-3 text-3xl font-bold text-[#1B1B18]">Welcome back, {{ $user->first_name ?? $user->name }}</h2>
                            </div>
                            <div class="rounded-3xl bg-[#E8F5E9] px-5 py-4 text-sm font-semibold text-[#166534]">Admin access enabled</div>
                        </div>

                        <div class="mt-8 grid gap-6 xl:grid-cols-3">
                            <article class="rounded-[28px] border border-slate-200 bg-[#F9FAF8] p-6">
                                <p class="text-sm text-[#5C4033]/80">Total Users</p>
                                <p class="mt-3 text-3xl font-bold text-[#1B1B18]">{{ $totalUsers ?? 0 }}</p>
                                <p class="mt-2 text-sm text-[#5C4033]/80">Registered users on the platform.</p>
                            </article>
                            <article class="rounded-[28px] border border-slate-200 bg-[#F9FAF8] p-6">
                                <p class="text-sm text-[#5C4033]/80">Recent Activity</p>
                                <p class="mt-3 text-3xl font-bold text-[#1B1B18]">--</p>
                                <p class="mt-2 text-sm text-[#5C4033]/80">Monitor bookings, messages, and reviews here.</p>
                            </article>
                            <article class="rounded-[28px] border border-slate-200 bg-[#F9FAF8] p-6">
                                <p class="text-sm text-[#5C4033]/80">Admin Tools</p>
                                <p class="mt-3 text-3xl font-bold text-[#1B1B18]">--</p>
                                <p class="mt-2 text-sm text-[#5C4033]/80">Use this page to manage site content and users.</p>
                            </article>
                        </div>
                    </section>

                    <section id="classes" class="mt-8 rounded-[32px] border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(92,64,51,0.08)]">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                            <div>
                                <p class="text-sm uppercase tracking-[0.2em] text-[#5C4033]/70">Classes</p>
                                <h3 class="mt-3 text-2xl font-bold text-[#1B1B18]">Manage class catalog</h3>
                            </div>
                            <div class="rounded-full bg-[#E8F5E9] px-4 py-2 text-sm font-semibold text-[#166534]">{{ $classes->count() }} classes</div>
                        </div>

                        <div class="mt-8 grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
                            <div>
                                <h4 class="text-lg font-semibold text-[#1B1B18]">Current classes</h4>
                                <div class="mt-4 space-y-3">
                                    @forelse ($classes as $class)
                                        <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-[#F8FAFB] p-4">
                                            <div>
                                                <div class="text-sm font-semibold text-[#1B1B18]">{{ $class->name }}</div>
                                                <div class="mt-1 text-xs text-[#5C4033]/75">{{ $class->badge }} · {{ $class->price_label }} · {{ $class->duration_minutes }} min</div>
                                            </div>
                                            <span class="rounded-full px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.15em] {{ $class->is_active ? 'bg-[#E8F5E9] text-[#166534]' : 'bg-[#FDECEC] text-[#B91C1C]' }}">
                                                {{ $class->is_active ? 'Active' : 'Hidden' }}
                                            </span>
                                        </div>
                                    @empty
                                        <div class="rounded-2xl border border-dashed border-slate-300 bg-[#F8FAFB] p-6 text-sm text-[#5C4033]/75">
                                            No classes yet. Create your first class below.
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <form method="POST" action="{{ route('dashboard.classes.store') }}" class="rounded-[28px] border border-slate-200 bg-[#F8FAFB] p-6">
                                @csrf
                                <h4 class="text-lg font-semibold text-[#1B1B18]">Add a new class</h4>

                                <div class="mt-5 space-y-4">
                                    <div>
                                        <label for="slug" class="mb-1 block text-sm font-medium text-[#1B1B18]">Slug</label>
                                        <input id="slug" name="slug" type="text" required class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" placeholder="beginner-essentials" />
                                    </div>

                                    <div>
                                        <label for="badge" class="mb-1 block text-sm font-medium text-[#1B1B18]">Badge</label>
                                        <input id="badge" name="badge" type="text" required class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" placeholder="Beginner" />
                                    </div>

                                    <div>
                                        <label for="name" class="mb-1 block text-sm font-medium text-[#1B1B18]">Class name</label>
                                        <input id="name" name="name" type="text" required class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" placeholder="Beginner Essentials" />
                                    </div>

                                    <div>
                                        <label for="short_description" class="mb-1 block text-sm font-medium text-[#1B1B18]">Short description</label>
                                        <textarea id="short_description" name="short_description" required rows="2" class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" placeholder="Intro class for first-time archers"></textarea>
                                    </div>

                                    <div>
                                        <label for="full_description" class="mb-1 block text-sm font-medium text-[#1B1B18]">Full description</label>
                                        <textarea id="full_description" name="full_description" required rows="3" class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" placeholder="Detailed class description"></textarea>
                                    </div>

                                    <div>
                                        <label for="prerequisites" class="mb-1 block text-sm font-medium text-[#1B1B18]">Prerequisites</label>
                                        <textarea id="prerequisites" name="prerequisites" required rows="2" class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" placeholder="No prior experience"></textarea>
                                    </div>

                                    <div class="grid gap-4 sm:grid-cols-2">
                                        <div>
                                            <label for="price_label" class="mb-1 block text-sm font-medium text-[#1B1B18]">Price label</label>
                                            <input id="price_label" name="price_label" type="text" required class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" placeholder="$45 / session" />
                                        </div>
                                        <div>
                                            <label for="price_cents" class="mb-1 block text-sm font-medium text-[#1B1B18]">Price cents</label>
                                            <input id="price_cents" name="price_cents" type="number" min="0" value="0" class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" />
                                        </div>
                                    </div>

                                    <div class="grid gap-4 sm:grid-cols-2">
                                        <div>
                                            <label for="duration_minutes" class="mb-1 block text-sm font-medium text-[#1B1B18]">Duration (minutes)</label>
                                            <input id="duration_minutes" name="duration_minutes" type="number" min="15" value="60" class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" />
                                        </div>
                                        <div>
                                            <label for="sort_order" class="mb-1 block text-sm font-medium text-[#1B1B18]">Sort order</label>
                                            <input id="sort_order" name="sort_order" type="number" min="0" value="0" class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" />
                                        </div>
                                    </div>

                                    <div>
                                        <label for="cta_text" class="mb-1 block text-sm font-medium text-[#1B1B18]">CTA text</label>
                                        <input id="cta_text" name="cta_text" type="text" value="View Class" class="w-full rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-[#1B1B18] outline-none focus:border-[#228B22]" />
                                    </div>

                                    <label class="flex items-center gap-3 text-sm text-[#1B1B18]">
                                        <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 rounded border-slate-300 text-[#228B22] focus:ring-[#228B22]" />
                                        Active on public site
                                    </label>

                                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-[#228B22] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1a6b1a]">
                                        Save class
                                    </button>
                                </div>
                            </form>
                        </div>
                    </section>

                    <section id="stats" class="mt-8 grid gap-6 xl:grid-cols-[minmax(0,1.5fr)_minmax(0,1fr)]">
                        <article class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(92,64,51,0.08)]">
                            <h3 class="text-xl font-semibold text-[#1B1B18]">Site Summary</h3>
                            <p class="mt-3 text-sm leading-7 text-[#5C4033]/85">Keep an eye on bookings, recent messages, and system health from this dashboard.</p>
                        </article>
                        <article class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(92,64,51,0.08)]">
                            <h3 class="text-xl font-semibold text-[#1B1B18]">Quick Actions</h3>
                            <div class="mt-6 space-y-3">
                                <button class="w-full rounded-3xl border border-slate-200 bg-[#F5F5DC] px-4 py-3 text-left text-sm font-semibold text-[#1B1B18] transition hover:bg-[#E9F0E1]">Review Bookings</button>
                                <button class="w-full rounded-3xl border border-slate-200 bg-[#F5F5DC] px-4 py-3 text-left text-sm font-semibold text-[#1B1B18] transition hover:bg-[#E9F0E1]">Manage Reviews</button>
                            </div>
                        </article>
                    </section>

                    <section id="activity" class="mt-8 rounded-[32px] border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(92,64,51,0.08)]">
                        <h3 class="text-xl font-semibold text-[#1B1B18]">Recent Activity</h3>
                        <div class="mt-3 text-sm leading-7 text-[#5C4033]/85">
                            @if(isset($recentBookings) && $recentBookings->count())
                                <ul class="space-y-3">
                                    @foreach($recentBookings as $booking)
                                        <li class="flex items-center justify-between rounded-lg border p-3">
                                            <div>
                                                <div class="text-sm font-semibold">{{ $booking->user->first_name ?? $booking->user->name }} — {{ $booking->archeryClass->name ?? 'Class' }}</div>
                                                <div class="text-xs text-[#5C4033]/80">{{ $booking->classSession?->starts_at?->format('M j, Y g:i A') ?? '—' }} · {{ $booking->displayStatus() }}</div>
                                            </div>
                                            <div class="text-xs text-[#5C4033]/70">Booked {{ $booking->booked_at->diffForHumans() }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No recent bookings yet.</p>
                            @endif
                        </div>
                    </section>

                    <section id="tools" class="mt-8 rounded-[32px] border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(92,64,51,0.08)]">
                        <h3 class="text-xl font-semibold text-[#1B1B18]">Tools</h3>
                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-[28px] border border-slate-200 bg-[#F8FAFB] p-6">
                                <p class="text-sm text-[#5C4033]/80">Manage admin accounts</p>
                                <p class="mt-3 text-sm text-[#5C4033]/80">Create and maintain admin users.</p>
                            </div>
                            <div class="rounded-[28px] border border-slate-200 bg-[#F8FAFB] p-6">
                                <p class="text-sm text-[#5C4033]/80">Monitor reviews</p>
                                <p class="mt-3 text-sm text-[#5C4033]/80">Track customer feedback and latest ratings.</p>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sidebar = document.getElementById('adminSidebar');
                const content = document.getElementById('dashboardContent');
                const toggle = document.getElementById('sidebarToggle');
                const logoutBtn = document.getElementById('logoutBtn');
                const sidebarTextItems = sidebar ? sidebar.querySelectorAll('.sidebar-text') : [];
                const sidebarLinks = sidebar ? sidebar.querySelectorAll('.sidebar-link') : [];

                let minimized = false;

                function updateSidebarState() {
                    if (!sidebar || !content) {
                        return;
                    }

                    sidebar.classList.toggle('w-64', !minimized);
                    sidebar.classList.toggle('w-16', minimized);
                    sidebar.classList.toggle('px-4', !minimized);
                    sidebar.classList.toggle('px-3', minimized);

                    sidebarTextItems.forEach(function (item) {
                        item.classList.toggle('hidden', minimized);
                    });
                    if (logoutBtn) {
                        logoutBtn.classList.toggle('w-full', !minimized);
                        logoutBtn.classList.toggle('w-12', minimized);
                        logoutBtn.classList.toggle('h-12', minimized);
                        logoutBtn.classList.toggle('rounded-full', !minimized);
                        logoutBtn.classList.toggle('rounded-2xl', minimized);
                        logoutBtn.classList.toggle('gap-3', !minimized);
                        logoutBtn.classList.toggle('gap-0', minimized);
                        logoutBtn.classList.toggle('px-3', !minimized);
                        logoutBtn.classList.toggle('px-0', minimized);
                        logoutBtn.classList.toggle('py-2', !minimized);
                        logoutBtn.classList.toggle('py-0', minimized);
                        logoutBtn.classList.toggle('justify-center', minimized);
                        logoutBtn.classList.toggle('mx-auto', minimized);
                    }
                    sidebarLinks.forEach(function (link) {
                        const isActive = link.getAttribute('aria-current') === 'page';
                        link.classList.toggle('justify-start', !minimized);
                        link.classList.toggle('justify-center', minimized);
                        link.classList.toggle('gap-3', !minimized);
                        link.classList.toggle('gap-0', minimized);
                        
                        if (isActive) {
                            link.classList.toggle('px-2', !minimized);
                            link.classList.toggle('py-1.5', !minimized);
                        } else {
                            link.classList.toggle('px-3', !minimized);
                            link.classList.toggle('py-1', !minimized);
                        }
                        link.classList.toggle('px-0', minimized);
                        link.classList.toggle('py-0', minimized);
                        
                        link.classList.toggle('w-full', !minimized);
                        link.classList.toggle('w-10', minimized);
                        link.classList.toggle('h-10', minimized);
                        link.classList.toggle('mx-auto', minimized);
                        if (isActive) {
                            link.classList.toggle('rounded-lg', !minimized);
                            link.classList.toggle('rounded-2xl', minimized);
                        } else {
                            link.classList.toggle('rounded-full', !minimized);
                            link.classList.toggle('rounded-2xl', minimized);
                        }
                        link.classList.toggle('bg-white', isActive);
                        link.classList.toggle('text-white', !isActive);
                    });

                    content.style.paddingLeft = minimized ? '3.5rem' : '16rem';
                    toggle?.setAttribute('aria-expanded', String(!minimized));
                }

                toggle?.addEventListener('click', function () {
                    minimized = !minimized;
                    updateSidebarState();
                });

                updateSidebarState();

                logoutBtn?.addEventListener('click', async function () {
                    try {
                        const response = await fetch('/api/logout', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                Accept: 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                        });
                        if (response.ok) {
                            window.location.href = '/';
                        }
                    } catch (error) {
                        console.error(error);
                    }
                });
            });
        </script>
    @endpush
@endsection
