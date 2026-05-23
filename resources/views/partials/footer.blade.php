<footer class="border-t border-[#5C4033]/10 bg-white/90 text-[#1B1B18]">
    <div class="mx-auto max-w-7xl px-6 py-16 grid gap-10 lg:grid-cols-[1.4fr_1fr_1fr]">
        <div>
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.svg') }}" alt="Archery Adventures logo" class="h-12 w-12 rounded-3xl border border-[#DAA520] bg-white/10 p-2 shadow-sm shadow-[#00000026] object-contain" />
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-[#5C4033]/70">Archery</p>
                    <p class="mt-1 text-xl font-heading font-bold text-[#1B1B18]">Adventures</p>
                </div>
            </a>
            <p class="mt-6 max-w-sm text-sm leading-7 text-[#5C4033]/80">
                Learn archery with expert-led lessons, advanced training, group events, and flexible range rentals in a welcoming studio experience.
            </p>
        </div>

        <div class="grid gap-4">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-[#5C4033]/70">Explore</p>
            <a href="{{ url('/') }}" class="text-sm text-[#5C4033]/80 transition hover:text-[#228B22]">Home</a>
            <a href="{{ route('classes') }}" class="text-sm text-[#5C4033]/80 transition hover:text-[#228B22]">Classes</a>
            <a href="{{ route('instructors') }}" class="text-sm text-[#5C4033]/80 transition hover:text-[#228B22]">Instructors</a>
            <a href="{{ route('about') }}" class="text-sm text-[#5C4033]/80 transition hover:text-[#228B22]">About Us</a>
            <a href="{{ route('contact') }}" class="text-sm text-[#5C4033]/80 transition hover:text-[#228B22]">Contact</a>
        </div>

        <div class="grid gap-4">
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-[#5C4033]/70">Contact</p>
            <p class="text-sm text-[#5C4033]/80">hello@archeryAdventures_Official</p>
            <p class="text-sm text-[#5C4033]/80">+639709671826</p>
            <p class="text-sm text-[#5C4033]/80">Brgy. San Roque, Sogod, Southern Leyte</p>
        </div>
    </div>

    <div class="border-t border-[#5C4033]/10 bg-[#F5F5DC]/80 py-6 text-center text-sm text-[#5C4033]/70">
        © 2026 All Rights Reserved. Josiah Joed Getes
    </div>
</footer>
