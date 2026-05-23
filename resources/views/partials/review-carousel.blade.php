@foreach ($carouselReviews as $review)
    <article class="carousel-item carousel-card soft-card p-8">
        <div class="mb-4 flex gap-1 text-[#DAA520]" aria-label="{{ $review->rating }} out of 5 stars">
            @for ($star = 1; $star <= 5; $star++)
                <span class="text-xl leading-none {{ $star <= $review->rating ? 'text-[#DAA520]' : 'text-[#5C4033]/20' }}">★</span>
            @endfor
        </div>
        <p class="text-sm leading-7 text-[#5C4033]/85">"{{ $review->body }}"</p>
        <p class="mt-6 font-semibold text-[#1B1B18]">{{ $review->reviewer_name }}</p>
    </article>
@endforeach
