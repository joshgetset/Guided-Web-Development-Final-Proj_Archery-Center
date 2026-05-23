{{-- Class detail modal --}}
<div id="classDetailModal" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm overflow-y-auto">
    <div class="my-auto w-full max-w-3xl rounded-[32px] bg-white/95 shadow-2xl">
        <div class="relative">
            <button type="button" id="classDetailClose" class="absolute right-4 top-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-black/40 text-white transition hover:bg-black/60" aria-label="Close">&times;</button>

            <div class="class-modal-carousel relative h-64 overflow-hidden rounded-t-[32px] bg-[#1B1B18]/5 sm:h-80">
                <div id="classCarouselTrack" class="flex h-full transition-transform duration-500 ease-out"></div>
                <button type="button" id="classCarouselPrev" class="absolute left-3 top-1/2 z-10 -translate-y-1/2 rounded-full bg-black/40 p-2 text-white hover:bg-black/60" aria-label="Previous image">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 rotate-180"><path fill="currentColor" d="M9.29 6.71a1 1 0 0 1 1.42 0l5 5a1 1 0 0 1 0 1.42l-5 5a1 1 0 1 1-1.42-1.42L13.59 12 9.29 7.71a1 1 0 0 1 0-1.42z"/></svg>
                </button>
                <button type="button" id="classCarouselNext" class="absolute right-3 top-1/2 z-10 -translate-y-1/2 rounded-full bg-black/40 p-2 text-white hover:bg-black/60" aria-label="Next image">
                    <svg viewBox="0 0 24 24" class="h-5 w-5"><path fill="currentColor" d="M9.29 6.71a1 1 0 0 1 1.42 0l5 5a1 1 0 0 1 0 1.42l-5 5a1 1 0 1 1-1.42-1.42L13.59 12 9.29 7.71a1 1 0 0 1 0-1.42z"/></svg>
                </button>
                <div id="classCarouselDots" class="absolute bottom-3 left-0 right-0 flex justify-center gap-2"></div>
            </div>

            <div class="space-y-5 p-6 sm:p-8">
                <div>
                    <span id="classDetailBadge" class="badge-pill"></span>
                    <h3 id="classDetailTitle" class="mt-3 text-3xl font-heading font-bold text-[#1B1B18]"></h3>
                    <p id="classDetailPrice" class="mt-2 text-lg font-semibold text-[#228B22]"></p>
                </div>
                <div class="mt-4 grid gap-6 sm:grid-cols-2">
                    <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                        <p class="text-sm font-semibold text-[#1B1B18]">Instructor</p>
                        <p id="classDetailInstructor" class="mt-2 text-sm leading-7 text-[#5C4033]/85"></p>
                    </div>
                    <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                        <p class="text-sm font-semibold text-[#1B1B18]">Why this class?</p>
                        <ul id="classDetailBenefits" class="mt-3 space-y-2 text-sm leading-7 text-[#5C4033]/85"></ul>
                    </div>
                </div>
                <p id="classDetailDescription" class="mt-6 text-sm leading-7 text-[#5C4033]/85"></p>
                <div class="rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 p-5">
                    <p class="text-sm font-semibold text-[#1B1B18]">Prerequisites</p>
                    <p id="classDetailPrerequisites" class="mt-2 text-sm leading-7 text-[#5C4033]/85"></p>
                </div>
                <div>
                    <label for="classSessionSelect" class="text-sm font-semibold text-[#1B1B18]">Select session</label>
                    <select id="classSessionSelect" class="mt-2 w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 px-4 py-3 text-sm focus:border-[#228B22] focus:bg-white focus:outline-none"></select>
                </div>
                <button type="button" id="classBookNowBtn" class="w-full rounded-full bg-[#228B22] py-3 font-semibold text-white transition hover:bg-[#1a6b1a]">Book Now</button>
            </div>
        </div>
    </div>
</div>

{{-- Confirm booking modal --}}
<div id="confirmBookModal" class="modal fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm">
    <div class="w-full max-w-md rounded-[32px] bg-white p-8 shadow-2xl">
        <h3 class="text-xl font-heading font-bold text-[#1B1B18]">Confirm booking</h3>
        <p id="confirmBookMessage" class="mt-4 text-sm leading-7 text-[#5C4033]/85"></p>
        <div class="mt-6 flex flex-wrap gap-3">
            <button type="button" id="confirmBookCancel" class="flex-1 rounded-full border border-[#5C4033]/20 px-5 py-3 text-sm font-semibold text-[#5C4033] transition hover:bg-[#F5F5DC]">Go back</button>
            <button type="button" id="confirmBookYes" class="flex-1 rounded-full bg-[#228B22] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1a6b1a]">Yes, book it</button>
        </div>
    </div>
</div>

{{-- Alert popup --}}
<div id="alertModal" class="modal fixed inset-0 z-[70] hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm">
    <div class="w-full max-w-sm rounded-[32px] bg-white p-8 text-center shadow-2xl">
        <div id="alertModalIcon" class="mx-auto flex h-14 w-14 items-center justify-center rounded-full text-2xl"></div>
        <h3 id="alertModalTitle" class="mt-4 text-xl font-heading font-bold text-[#1B1B18]"></h3>
        <p id="alertModalMessage" class="mt-3 text-sm leading-7 text-[#5C4033]/85"></p>
        <button type="button" id="alertModalClose" class="mt-6 w-full rounded-full bg-[#228B22] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1a6b1a]">OK</button>
    </div>
</div>
