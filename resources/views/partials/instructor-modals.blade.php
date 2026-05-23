{{-- Instructor detail modal (matches class modal styling) --}}
<div id="instructorDetailModal" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm overflow-y-auto">
    <div class="my-auto w-full max-w-3xl rounded-[32px] bg-white/95 shadow-2xl">
        <div class="relative">
            <button type="button" id="instructorDetailClose" class="absolute right-4 top-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-black/40 text-white transition hover:bg-black/60" aria-label="Close">&times;</button>

            <div class="space-y-5 p-6 sm:p-8">
                <div class="grid gap-6 lg:grid-cols-[1fr_auto] items-start">
                    <div>
                        <span id="instructorDetailBadge" class="badge-pill"></span>
                        <h3 id="instructorDetailName" class="mt-3 text-3xl font-heading font-bold text-[#1B1B18]"></h3>
                        <p id="instructorDetailTitle" class="mt-2 text-lg font-semibold text-[#228B22]"></p>
                    </div>

                    <div class="flex justify-end">
                        <div class="h-44 w-44 overflow-hidden rounded-[28px] border border-[#5C4033]/10 bg-[#F5F5DC]/50 shadow-sm">
                            <div id="instructorDetailImage" class="h-full w-full"></div>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                        <p class="text-sm font-semibold text-[#1B1B18]">Rating</p>
                        <p id="instructorDetailRating" class="mt-2 text-sm leading-7 text-[#5C4033]/85"></p>
                    </div>
                    <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                        <p class="text-sm font-semibold text-[#1B1B18]">Experience</p>
                        <p id="instructorDetailExperience" class="mt-2 text-sm leading-7 text-[#5C4033]/85"></p>
                    </div>
                </div>

                <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                    <p class="text-sm font-semibold text-[#1B1B18]">Specialty</p>
                    <p id="instructorDetailSpecialty" class="mt-2 text-sm leading-7 text-[#5C4033]/85"></p>
                </div>

                <p id="instructorDetailBio" class="text-sm leading-7 text-[#5C4033]/85"></p>

                <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                    <p class="text-sm font-semibold text-[#1B1B18]">Coach quote</p>
                    <p id="instructorDetailQuote" class="mt-2 text-sm italic leading-7 text-[#5C4033]/85"></p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                        <p class="text-sm font-semibold text-[#1B1B18]">Certifications</p>
                        <ul id="instructorDetailCertifications" class="mt-3 space-y-2 text-sm leading-7 text-[#5C4033]/85"></ul>
                    </div>
                    <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                        <p class="text-sm font-semibold text-[#1B1B18]">Achievements</p>
                        <ul id="instructorDetailAchievements" class="mt-3 space-y-2 text-sm leading-7 text-[#5C4033]/85"></ul>
                    </div>
                </div>

                <a href="{{ route('classes') }}" class="inline-flex w-full items-center justify-center rounded-full bg-[#228B22] py-3 font-semibold text-white transition hover:bg-[#1a6b1a]">View classes</a>
            </div>
        </div>
    </div>
</div>
