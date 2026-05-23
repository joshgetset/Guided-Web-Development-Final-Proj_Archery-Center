@extends('layouts.app', ['activePage' => 'contact'])

@section('title', 'Contact Us · ' . config('app.name', 'Archery Adventures'))

@section('content')
    <div class="contact-page">
        <section class="contact-form-band bg-white">
            <div class="mx-auto w-full max-w-4xl px-6 py-16 sm:py-20 lg:px-10">
                <div class="contact-form-header text-center">
                    <p class="contact-eyebrow">Get in touch</p>
                    <h1 class="mt-3 font-heading text-4xl font-bold text-[#1B1B18] sm:text-5xl">Contact Us</h1>
                    <p class="mx-auto mt-4 max-w-xl text-base leading-8 text-[#5C4033]/85">
                        Any questions or remarks? Just write us a message and our team will respond as soon as possible.
                    </p>
                </div>

                <form id="contactForm" class="contact-form-card mt-10 rounded-[32px] border border-[#5C4033]/10 bg-[#F5F5DC]/40 p-8 shadow-[0_24px_60px_rgba(92,64,51,0.08)] sm:p-10" novalidate>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div class="contact-field">
                            <label for="contactEmail" class="contact-label">Email</label>
                            <input type="email" id="contactEmail" name="email" placeholder="Enter a valid email address" class="contact-input w-full" required />
                        </div>
                        <div class="contact-field">
                            <label for="contactName" class="contact-label">Name</label>
                            <input type="text" id="contactName" name="name" placeholder="Enter your name" class="contact-input w-full" required />
                        </div>
                    </div>
                    <div class="contact-field mt-6">
                        <label for="contactMessage" class="contact-label">Message</label>
                        <textarea id="contactMessage" name="message" rows="5" placeholder="Write your message here..." class="contact-input contact-textarea w-full resize-y" required></textarea>
                    </div>
                    <p id="contactFormError" class="mt-4 hidden text-sm font-medium text-[#991b1b]"></p>
                    <button type="submit" id="contactSubmitBtn" class="contact-submit-btn mt-8 w-full">SUBMIT</button>
                </form>
            </div>
        </section>

        <section class="contact-info-band bg-[#E8E8E3]">
            <div class="mx-auto w-full max-w-7xl px-6 py-16 sm:py-20 lg:px-10">
                <div class="grid gap-6 md:grid-cols-3">
                    <article class="contact-info-card">
                        <div class="contact-info-icon">
                            <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </div>
                        <h2 class="contact-info-title">Social Media</h2>
                        <p class="contact-info-highlight">ArcheryAdventures_Official</p>
                        <p class="contact-info-text">Follow us for updates, events, and range highlights.</p>
                    </article>

                    <article class="contact-info-card">
                        <div class="contact-info-icon">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <h2 class="contact-info-title">Phone (Landline)</h2>
                        <p class="contact-info-highlight">+63 912 345 6789</p>
                        <p class="contact-info-text">+63 918 252 3336</p>
                    </article>

                    <article class="contact-info-card">
                        <div class="contact-info-icon">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h2 class="contact-info-title">Our Office Location</h2>
                        <p class="contact-info-highlight">Archery Adventures Center</p>
                        <p class="contact-info-text">Brgy. San Roque, Sogod, Southern Leyte</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="contact-reviews-band bg-[#F5F5DC]">
            <div class="mx-auto w-full max-w-7xl px-6 py-16 sm:py-20 lg:px-10">
                <div class="text-center">
                    <p class="contact-eyebrow">Reviews</p>
                    <h2 class="mt-3 font-heading text-3xl font-bold text-[#1B1B18] sm:text-4xl">Share your Archery Center experience</h2>
                    <p class="mx-auto mt-4 max-w-2xl text-base leading-8 text-[#5C4033]/85">
                        Rate your visit and tell us what you enjoyed.
                    </p>
                </div>

                <div class="mt-12 grid gap-10 xl:grid-cols-[minmax(0,1fr)_minmax(0,1.15fr)] xl:items-start">
                    <form id="reviewForm" class="contact-review-form rounded-[32px] border border-[#5C4033]/10 bg-white p-8 shadow-[0_24px_60px_rgba(92,64,51,0.08)] sm:p-10" novalidate>
                        <div class="flex items-center gap-3 border-b border-[#5C4033]/10 pb-6">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#228B22]/10 text-2xl text-[#228B22]">★</div>
                            <div>
                                <p class="text-sm font-semibold text-[#1B1B18]">Write a review</p>
                                <p class="text-xs text-[#5C4033]/70">Help others discover Archery Adventures</p>
                            </div>
                        </div>

                        <p class="contact-label mt-6">Your rating</p>
                        <div id="reviewStarRating" class="review-star-rating mt-3 flex gap-2" role="radiogroup" aria-label="Star rating">
                            @for ($star = 1; $star <= 5; $star++)
                                <button type="button" class="review-star-btn text-3xl leading-none transition hover:scale-110" data-rating="{{ $star }}" aria-label="{{ $star }} star{{ $star > 1 ? 's' : '' }}">★</button>
                            @endfor
                        </div>
                        <input type="hidden" id="reviewRatingValue" name="rating" value="0" />

                        <div class="contact-field mt-6">
                            <label for="reviewComment" class="contact-label">Your review</label>
                            <textarea id="reviewComment" name="comment" rows="5" placeholder="Tell us about your experience at the archery center..." class="contact-input contact-textarea w-full resize-y" required></textarea>
                        </div>
                        <p id="reviewFormError" class="mt-4 hidden text-sm font-medium text-[#991b1b]"></p>
                        <p class="mt-3 text-xs leading-6 text-[#5C4033]/70">
                            Guests appear as Guest_(date and time). Signed-in members use their account name.
                        </p>
                        <button type="submit" id="reviewSubmitBtn" class="contact-submit-btn contact-submit-btn--outline mt-6 w-full sm:w-auto sm:min-w-[12rem]">SUBMIT REVIEW</button>
                    </form>

                    <aside class="contact-reviews-panel min-w-0 rounded-[32px] border border-[#5C4033]/10 bg-white p-6 shadow-[0_24px_60px_rgba(92,64,51,0.08)] sm:p-8">
                        <div class="flex flex-wrap items-end justify-between gap-4 border-b border-[#5C4033]/10 pb-6">
                            <div>
                                <h3 class="font-heading text-xl font-bold text-[#1B1B18]">Recent reviews</h3>
                                <p class="mt-1 text-sm text-[#5C4033]/70">Showing <span id="reviewsVisibleCount">0</span> of <span id="reviewsFilteredCount">0</span> reviews</p>
                            </div>
                        </div>

                        <p class="contact-label mt-6">Filter by rating</p>
                        <div id="reviewRatingFilters" class="mt-3 flex flex-wrap gap-2">
                            <button type="button" class="review-filter-btn is-active" data-filter="all" aria-pressed="true">
                                <span>All</span>
                                <span class="review-filter-count" data-count-for="all">{{ $totalReviews }}</span>
                            </button>
                            @for ($star = 5; $star >= 1; $star--)
                                <button type="button" class="review-filter-btn" data-filter="{{ $star }}" aria-pressed="false">
                                    <span class="review-filter-stars" aria-hidden="true">{{ str_repeat('★', $star) }}</span>
                                    <span class="review-filter-count" data-count-for="{{ $star }}">{{ $ratingCounts[$star] }}</span>
                                </button>
                            @endfor
                        </div>

                        <div id="recentReviewsList" class="mt-6 space-y-4"></div>

                        <button type="button" id="reviewsReadMore" class="contact-read-more hidden">
                            Read more
                        </button>
                        <button type="button" id="reviewsReadLess" class="contact-read-more hidden">
                            Show less
                        </button>
                    </aside>
                </div>
            </div>
        </section>
    </div>

    <script id="contact-data" type="application/json"><?php echo json_encode([
        'reviews' => $reviewsForJs ?? [],
        'ratingCounts' => $ratingCounts ?? ['all' => 0, 5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0],
    ]); ?></script>

    @include('partials.contact-modals')
@endsection

@push('scripts')
    @vite(['resources/js/contact.js'])
@endpush
