@extends('layouts.app', ['activePage' => 'classes'])

@section('title', 'Classes · ' . config('app.name', 'Archery Adventures'))

@section('content')
    <main class="mx-auto max-w-7xl px-6 py-12">
        <div class="text-center">
            <p class="text-sm uppercase tracking-[0.3em] text-[#5C4033]/70">Programs &amp; training</p>
            <h2 class="mt-3 text-4xl font-heading font-bold text-[#1B1B18] md:text-5xl">Archery Classes</h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-[#5C4033]/85">
                Browse available sessions with expert coaching, compare class benefits, and reserve your next time on the range.
            </p>
        </div>

        {{-- My Classes (logged in only) --}}
        <section id="myClassesSection" class="mt-14 hidden">
            <div class="soft-card rounded-[32px] border border-[#5C4033]/10 bg-white p-6 shadow-[0_30px_80px_rgba(92,64,51,0.06)] md:p-8">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.25em] text-[#5C4033]/70">Your schedule</p>
                        <h3 class="mt-2 text-2xl font-heading font-bold text-[#1B1B18]">My Classes Enrolled</h3>
                        <p class="mt-1 text-sm text-[#5C4033]/75">Track incoming sessions, completed classes, and cancellations in one place.</p>
                    </div>
                    <p id="myClassesSummary" class="text-sm text-[#5C4033]/80"></p>
                </div>

                <div class="mt-6 flex flex-wrap gap-2" role="tablist" aria-label="Booking categories">
                    <button type="button" data-booking-tab="upcoming" class="booking-tab booking-tab-active">Incoming</button>
                    <button type="button" data-booking-tab="completed" class="booking-tab">Completed</button>
                    <button type="button" data-booking-tab="cancelled" class="booking-tab">Cancelled</button>
                </div>

                <div id="myClassesPanels" class="mt-6 space-y-4">
                    <div data-booking-panel="upcoming" class="booking-panel"></div>
                    <div data-booking-panel="completed" class="booking-panel hidden"></div>
                    <div data-booking-panel="cancelled" class="booking-panel hidden"></div>
                </div>
            </div>
        </section>

        {{-- Available classes --}}
        <section class="mt-14">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-[#5C4033]/70">Book your next session</p>
                    <h3 class="mt-2 text-2xl font-heading font-bold text-[#1B1B18]">Available Classes</h3>
                </div>
            </div>

            <div id="availableClassesGrid" class="mt-8 grid gap-6 sm:grid-cols-2 xl:grid-cols-4"></div>
        </section>
    </main>

    @include('partials.class-modals')

    <script id="classesData" type="application/json">{!! $classesJson !!}</script>
@endsection

@push('scripts')
    @vite(['resources/js/classes.js'])
@endpush
