@extends('layouts.app', ['activePage' => 'instructors'])

@section('title', 'Instructors · ' . config('app.name', 'Archery Adventures'))

@section('content')
    <main class="instructors-page mx-auto w-full max-w-7xl overflow-x-hidden px-4 py-10 sm:px-6 sm:py-12 lg:px-8">
        <div class="text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-[#5C4033]/70">Meet our coaches</p>
            <h2 class="mt-3 text-4xl font-heading font-bold text-[#1B1B18] md:text-5xl">Instructors you can trust.</h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-[#5C4033]/85">
                Explore certified instructors with strong experience, top ratings, and specialty coaching styles. Filter by expertise, rating, or search by name.
            </p>
        </div>

        <section class="mt-10 grid min-w-0 gap-8 xl:grid-cols-[minmax(0,1fr)_minmax(280px,300px)] xl:items-start xl:gap-10">
            <div class="rounded-[32px] border border-[#5C4033]/10 bg-white p-6 shadow-[0_30px_80px_rgba(92,64,51,0.06)] sm:p-8">
                <div class="grid min-w-0 gap-6 md:grid-cols-2 md:items-center">
                    <div class="min-w-0 space-y-5 sm:space-y-6">
                        <p class="text-sm uppercase tracking-[0.25em] text-[#5C4033]/70">Top Most Ranked Instructor</p>
                        <h3 class="text-3xl font-heading font-bold text-[#1B1B18]">Featured Coach of the Month</h3>
                        <p class="text-sm leading-7 text-[#5C4033]/85">
                            Our highest rated instructor brings elite training, competition guidance, and an inspiring coaching style to every session.
                        </p>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                                <p class="text-sm font-semibold text-[#1B1B18]">Rating</p>
                                <p id="topRankedRating" class="mt-3 text-3xl font-bold text-[#228B22]"></p>
                            </div>
                            <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                                <p class="text-sm font-semibold text-[#1B1B18]">Experience</p>
                                <p id="topRankedExperience" class="mt-3 text-3xl font-bold text-[#1B1B18]"></p>
                            </div>
                        </div>
                        <p class="text-sm leading-7 text-[#5C4033]/85" id="topRankedQuote"></p>
                        <button type="button" id="viewTopInstructorBtn" class="inline-flex rounded-full bg-[#228B22] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#1a6b1a]">View coach details</button>
                    </div>
                    <div class="relative min-w-0 overflow-hidden rounded-[32px] bg-[#1B1B18]/5 shadow-xl shadow-[#00000012]">
                        <div id="topRankedImage" class="aspect-[4/5] max-h-80 w-full bg-cover bg-center transition duration-500 ease-out sm:aspect-auto sm:h-72"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1B1B18]/80 via-[#1B1B18]/10 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <p id="topRankedName" class="text-3xl font-heading font-bold"></p>
                            <p id="topRankedTitle" class="mt-2 text-sm opacity-90"></p>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="min-w-0 xl:sticky xl:top-28 xl:self-start">
                <div class="rounded-[32px] border border-[#5C4033]/10 bg-white p-6 shadow-[0_30px_80px_rgba(92,64,51,0.06)] sm:p-8">
                    <p class="text-sm uppercase tracking-[0.25em] text-[#5C4033]/70">Why choose our team</p>
                    <h3 class="mt-3 text-2xl font-heading font-bold text-[#1B1B18]">Personalized coaching that delivers results.</h3>
                    <ul class="mt-6 space-y-4 text-sm leading-7 text-[#5C4033]/85">
                        <li class="flex gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 shrink-0 rounded-full bg-[#228B22]"></span>Expert coaches with strong competition and teaching experience.</li>
                        <li class="flex gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 shrink-0 rounded-full bg-[#228B22]"></span>Custom plans built around your goals and skill level.</li>
                        <li class="flex gap-3"><span class="mt-1 inline-flex h-2.5 w-2.5 shrink-0 rounded-full bg-[#228B22]"></span>Safe, supportive training for beginners and advanced archers alike.</li>
                    </ul>
                </div>
            </aside>

            <div class="min-w-0 xl:col-span-2">
                <div class="overflow-hidden rounded-[32px] border border-[#5C4033]/10 bg-white shadow-[0_30px_80px_rgba(92,64,51,0.06)]">
                    <div class="space-y-6 p-6 sm:p-8">
                        <div>
                            <p class="text-sm uppercase tracking-[0.25em] text-[#5C4033]/70">Find your coach</p>
                            <h3 class="mt-2 text-2xl font-heading font-bold text-[#1B1B18]">Search instructors</h3>
                        </div>
                        <div class="min-w-0">
                            <label for="instructorSearch" class="text-sm font-semibold text-[#1B1B18]">Search by name</label>
                            <input id="instructorSearch" type="search" placeholder="Search by first or last name" class="mt-3 w-full max-w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 px-4 py-3 text-sm outline-none transition focus:border-[#228B22] focus:bg-white" />
                        </div>
                        <div class="grid min-w-0 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="min-w-0">
                                <label for="experienceFilter" class="text-sm font-semibold text-[#1B1B18]">Years of experience</label>
                                <select id="experienceFilter" class="mt-3 w-full max-w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 px-4 py-3 text-sm outline-none transition focus:border-[#228B22] focus:bg-white">
                                    <option value="">All levels</option>
                                    <option value="1-3">1 - 3 years</option>
                                    <option value="4-6">4 - 6 years</option>
                                    <option value="7+">7+ years</option>
                                </select>
                            </div>
                            <div class="min-w-0">
                                <label for="ratingFilter" class="text-sm font-semibold text-[#1B1B18]">Minimum rating</label>
                                <select id="ratingFilter" class="mt-3 w-full max-w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 px-4 py-3 text-sm outline-none transition focus:border-[#228B22] focus:bg-white">
                                    <option value="">All ratings</option>
                                    <option value="4.5">4.5+</option>
                                    <option value="4.8">4.8+</option>
                                    <option value="5.0">5.0</option>
                                </select>
                            </div>
                            <div class="flex items-end sm:col-span-2 lg:col-span-1">
                                <button id="clearInstructorFilters" type="button" class="w-full rounded-full border border-[#5C4033]/15 bg-[#DAA520] px-4 py-3 text-sm font-semibold text-[#1B1B18] transition hover:bg-[#c98f1a]">Clear filters</button>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-[#5C4033]/10 px-6 pb-6 pt-8 sm:px-8 sm:pb-8">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm uppercase tracking-[0.25em] text-[#5C4033]/70">Instructor roster</p>
                                <h3 class="mt-2 text-2xl font-heading font-bold text-[#1B1B18]">Choose your coach</h3>
                            </div>
                            <p id="instructorCount" class="text-sm text-[#5C4033]/85"></p>
                        </div>

                        <div id="instructorCarouselControls" class="mt-5 flex items-center justify-end gap-3">
                            <button id="instructorCarouselPrev" type="button" class="rounded-full bg-[#1B1B18]/90 px-3 py-2 text-white transition hover:bg-[#000000de]" aria-label="Previous instructors">←</button>
                            <button id="instructorCarouselNext" type="button" class="rounded-full bg-[#1B1B18]/90 px-3 py-2 text-white transition hover:bg-[#000000de]" aria-label="Next instructors">→</button>
                        </div>

                        <div class="instructor-carousel-shell mt-5 w-full min-w-0">
                            <div id="instructorCarousel" class="instructor-carousel flex snap-x snap-mandatory gap-5 overflow-x-auto scroll-smooth pb-2">
                                <!-- instructor cards rendered by JS -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('partials.instructor-modals')

    <script id="instructorsData" type="application/json">{!! $instructorsJson !!}</script>
@endsection

@push('scripts')
    @vite(['resources/js/instructors.js'])
@endpush
