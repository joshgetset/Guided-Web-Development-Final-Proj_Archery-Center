function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

function showToast(message, type = 'success') {
    if (window.showToast && window.showToast !== showToast) {
        window.showToast(message, type);
        return;
    }
    const toast = document.createElement('div');
    toast.className = `toast fixed bottom-6 right-6 z-[80] max-w-sm rounded-3xl px-5 py-4 text-sm font-semibold shadow-xl transition duration-300 ${type === 'error' ? 'bg-[#fee2e2] text-[#991b1b] border border-[#fecaca]' : 'bg-[#ecfdf5] text-[#166534] border border-[#bbf7d0]'}`;
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(() => toast.classList.add('opacity-0'), 2200);
    setTimeout(() => toast.remove(), 2600);
}

function showAlert(title, message, type = 'success') {
    const modal = document.getElementById('alertModal');
    const icon = document.getElementById('alertModalIcon');
    const titleEl = document.getElementById('alertModalTitle');
    const messageEl = document.getElementById('alertModalMessage');
    if (!modal || !icon || !titleEl || !messageEl) {
        showToast(message, type);
        return;
    }

    icon.className = `mx-auto flex h-14 w-14 items-center justify-center rounded-full text-2xl ${type === 'error' ? 'bg-[#fee2e2] text-[#991b1b]' : 'bg-[#ecfdf5] text-[#166534]'}`;
    icon.textContent = type === 'error' ? '!' : '✓';
    titleEl.textContent = title;
    messageEl.textContent = message;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function hideAlert() {
    const modal = document.getElementById('alertModal');
    modal?.classList.add('hidden');
    modal?.classList.remove('flex');
}

function renderClassImage(classData, extraClass = '') {
    if (classData.is_emoji_card) {
        return `<div class="flex h-full items-center justify-center bg-gradient-to-br from-[#228B22]/15 to-[#DAA520]/10 text-[4rem] ${extraClass}">🏹</div>`;
    }
    if (classData.image_url) {
        const alt = (classData.name || 'Archery class').replace(/"/g, '&quot;');
        const imgExtra = extraClass.includes('scale') ? extraClass : `class-image-frame__img ${extraClass}`.trim();
        return `
            <div class="class-image-frame h-full w-full">
                <img src="${classData.image_url}" alt="${alt}" class="${imgExtra}" loading="lazy" decoding="async" />
            </div>
        `;
    }
    return `<div class="flex h-full items-center justify-center bg-[#F5F5DC] text-4xl ${extraClass}">🏹</div>`;
}

function renderClassCarouselSlide(url, alt = 'Class photo') {
    const safeAlt = alt.replace(/"/g, '&quot;');
    return `
        <div class="class-modal-carousel-slide">
            <img src="${url}" alt="${safeAlt}" class="class-modal-carousel-slide__img" decoding="async" />
        </div>
    `;
}

function syncModalCarouselLayout() {
    const viewport = document.querySelector('.class-modal-carousel');
    const track = document.getElementById('classCarouselTrack');
    if (!viewport || !track) {
        return 0;
    }

    const width = viewport.clientWidth;
    track.querySelectorAll('.class-modal-carousel-slide').forEach((slide) => {
        slide.style.flex = `0 0 ${width}px`;
        slide.style.width = `${width}px`;
        slide.style.maxWidth = `${width}px`;
    });

    return width;
}

const state = {
    classes: [],
    currentUser: null,
    bookings: { upcoming: [], completed: [], cancelled: [] },
    activeClass: null,
    activeSessionId: null,
    carouselIndex: 0,
    openLoginModal: null,
};

function parseClassesData() {
    const el = document.getElementById('classesData');
    if (!el) {
        return [];
    }
    try {
        return JSON.parse(el.textContent || '[]');
    } catch {
        return [];
    }
}

function renderAvailableClasses() {
    const grid = document.getElementById('availableClassesGrid');
    if (!grid) {
        return;
    }

    grid.innerHTML = state.classes
        .map(
            (cls) => `
        <article class="group soft-card flex flex-col overflow-hidden rounded-[32px] border border-[#5C4033]/10 bg-white shadow-[0_30px_80px_rgba(92,64,51,0.06)] transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-[0_38px_96px_rgba(92,64,51,0.16)] hover:ring-1 hover:ring-[#228B22]/15">
            <div class="h-48 overflow-hidden">
                ${renderClassImage(cls, 'min-h-full transition-transform duration-500 group-hover:scale-105')}
            </div>
            <div class="flex flex-1 flex-col p-6">
                <span class="badge-pill w-fit">${cls.badge}</span>
                <h4 class="mt-4 text-xl font-heading font-semibold text-[#1B1B18]">${cls.name}</h4>
                <p class="mt-2 text-sm font-semibold text-[#5C4033]/75">Instructor: ${cls.instructor_name}</p>
                <p class="mt-3 flex-1 text-sm leading-7 text-[#5C4033]/85">${cls.short_description}</p>
                <div class="mt-4 space-y-3 text-sm text-[#5C4033]/85">
                    <p class="font-semibold text-[#1B1B18]">Best for</p>
                    <ul class="space-y-2">
                        ${cls.benefits
                            .slice(0, 3)
                            .map(
                                (benefit) =>
                                    `<li class="flex gap-2"><span class="mt-1 inline-block h-2 w-2 rounded-full bg-[#228B22]"></span>${benefit}</li>`,
                            )
                            .join('')}
                    </ul>
                </div>
                <p class="mt-4 text-lg font-semibold text-[#228B22]">${cls.price_label}</p>
                <button type="button" data-view-class="${cls.id}" class="mt-5 inline-flex text-sm font-semibold text-[#228B22] transition hover:text-[#1a6b1a]">
                    ${cls.cta_text || 'View Class'} →
                </button>
            </div>
        </article>
    `,
        )
        .join('');

    attachClassViewButtons(grid);
}

function attachClassViewButtons(context = document) {
    context.querySelectorAll('[data-view-class]').forEach((btn) => {
        if (btn.dataset.classViewAttached) {
            return;
        }
        btn.dataset.classViewAttached = '1';
        btn.addEventListener('click', () => openClassModal(Number(btn.dataset.viewClass)));
    });
}

function renderBookingCard(booking) {
    const img = renderClassImage(booking.class, 'h-full min-h-[5rem] rounded-2xl');
    const cancelBtn = booking.can_cancel
        ? `<button type="button" data-cancel-booking="${booking.id}" class="rounded-full border border-red-200 px-4 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-50">Cancel</button>`
        : '';

    return `
        <article class="flex flex-col gap-4 rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC]/30 p-4 sm:flex-row sm:items-center">
            <div class="h-20 w-full shrink-0 overflow-hidden rounded-2xl sm:h-20 sm:w-28">
                ${img}
            </div>
            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="badge-pill">${booking.class.badge}</span>
                    <span class="text-xs font-semibold uppercase tracking-wide text-[#5C4033]/70">${booking.display_status}</span>
                </div>
                <h4 class="mt-2 font-heading text-lg font-semibold text-[#1B1B18]">${booking.class.name}</h4>
                <p class="mt-1 text-sm text-[#5C4033]/85">${booking.session_starts_at_label}</p>
                <p class="text-xs text-[#5C4033]/70">Booked ${booking.booked_at_label}</p>
            </div>
            <div class="shrink-0">${cancelBtn}</div>
        </article>
    `;
}

function renderMyClasses() {
    const section = document.getElementById('myClassesSection');
    const summary = document.getElementById('myClassesSummary');
    if (!section) {
        return;
    }

    if (!state.currentUser) {
        section.classList.add('hidden');
        return;
    }

    section.classList.remove('hidden');
    const total = state.bookings.upcoming.length + state.bookings.completed.length;
    if (summary) {
        summary.textContent = `${state.bookings.upcoming.length} upcoming · ${state.bookings.completed.length} completed`;
    }

    ['upcoming', 'completed', 'cancelled'].forEach((tab) => {
        const panel = document.querySelector(`[data-booking-panel="${tab}"]`);
        if (!panel) {
            return;
        }
        const items = state.bookings[tab] || [];
        if (items.length === 0) {
            panel.innerHTML = `<p class="rounded-3xl border border-dashed border-[#5C4033]/20 bg-[#F5F5DC]/40 px-6 py-10 text-center text-sm text-[#5C4033]/80">No ${tab} classes yet.</p>`;
            return;
        }
        panel.innerHTML = items.map(renderBookingCard).join('');
        panel.querySelectorAll('[data-cancel-booking]').forEach((btn) => {
            btn.addEventListener('click', () => cancelBooking(Number(btn.dataset.cancelBooking)));
        });
    });
}

async function fetchCurrentUser() {
    try {
        const response = await fetch('/api/user', { headers: { Accept: 'application/json' } });
        const data = await response.json();
        state.currentUser = data.user;
    } catch {
        state.currentUser = null;
    }
}

async function fetchBookings() {
    if (!state.currentUser) {
        state.bookings = { upcoming: [], completed: [], cancelled: [] };
        renderMyClasses();
        return;
    }

    try {
        const response = await fetch('/api/bookings', { headers: { Accept: 'application/json' } });
        const data = await response.json();
        state.bookings = data.bookings || { upcoming: [], completed: [], cancelled: [] };
    } catch {
        state.bookings = { upcoming: [], completed: [], cancelled: [] };
    }
    renderMyClasses();
}

async function openClassModal(classId) {
    try {
        const response = await fetch(`/api/classes/${classId}`, { headers: { Accept: 'application/json' } });
        const data = await response.json();
        if (!response.ok) {
            showAlert('Unable to load', data.message || 'Class not found.', 'error');
            return;
        }
        state.activeClass = data.class;
        state.carouselIndex = 0;
        populateClassModal(data.class);
        const modal = document.getElementById('classDetailModal');
        modal?.classList.remove('hidden');
        modal?.classList.add('flex');
        requestAnimationFrame(() => {
            state._updateCarousel?.();
        });
    } catch {
        showAlert('Error', 'Could not load class details. Please try again.', 'error');
    }
}

function populateClassModal(cls) {
    document.getElementById('classDetailBadge').textContent = cls.badge;
    document.getElementById('classDetailTitle').textContent = cls.name;
    document.getElementById('classDetailPrice').textContent = `${cls.price_label} · ${cls.duration_minutes} min`;
    document.getElementById('classDetailInstructor').textContent = cls.instructor_name || 'Our lead coach';
    const benefitsList = document.getElementById('classDetailBenefits');
    if (benefitsList) {
        benefitsList.innerHTML = (cls.benefits || [])
            .map(
                (benefit) =>
                    `<li class="flex gap-2"><span class="mt-1 inline-block h-2 w-2 rounded-full bg-[#228B22]"></span>${benefit}</li>`,
            )
            .join('');
    }
    document.getElementById('classDetailDescription').textContent = cls.full_description;
    document.getElementById('classDetailPrerequisites').textContent = cls.prerequisites;

    const select = document.getElementById('classSessionSelect');
    if (select) {
        if (!cls.sessions?.length) {
            select.innerHTML = '<option value="">No sessions available</option>';
            state.activeSessionId = null;
        } else {
            select.innerHTML = cls.sessions
                .map((s) => `<option value="${s.id}">${s.starts_at_label} (${s.spots_remaining} spots left)</option>`)
                .join('');
            state.activeSessionId = cls.sessions[0].id;
        }
        select.onchange = () => {
            state.activeSessionId = Number(select.value) || null;
        };
    }

    renderClassCarousel(cls);
}

function renderClassCarousel(cls) {
    const track = document.getElementById('classCarouselTrack');
    const dots = document.getElementById('classCarouselDots');
    const images = (cls.gallery?.length ? cls.gallery : cls.image_url ? [cls.image_url] : []).filter(Boolean);

    if (!track || images.length === 0) {
        if (track) {
            track.innerHTML = renderClassImage(cls, 'w-full min-h-full');
        }
        if (dots) {
            dots.innerHTML = '';
        }
        return;
    }

    track.innerHTML = images.map((url) => renderClassCarouselSlide(url, cls.name)).join('');

    dots.innerHTML = images.map((_, i) => `<button type="button" data-carousel-dot="${i}" class="h-2 w-2 rounded-full ${i === 0 ? 'bg-white' : 'bg-white/50'}" aria-label="Slide ${i + 1}"></button>`).join('');

    const updateCarousel = () => {
        const slideWidth = syncModalCarouselLayout();
        const offset = state.carouselIndex * slideWidth;
        track.style.transform = `translateX(-${offset}px)`;
        dots.querySelectorAll('[data-carousel-dot]').forEach((dot, i) => {
            dot.classList.toggle('bg-white', i === state.carouselIndex);
            dot.classList.toggle('bg-white/50', i !== state.carouselIndex);
        });
    };

    state._carouselImages = images;
    state._updateCarousel = updateCarousel;
    updateCarousel();

    requestAnimationFrame(() => {
        updateCarousel();
    });
}

function closeClassModal() {
    const modal = document.getElementById('classDetailModal');
    modal?.classList.add('hidden');
    modal?.classList.remove('flex');
}

function openConfirmBook() {
    if (!state.currentUser) {
        state.openLoginModal?.();
        showToast('Please sign in to book a class.', 'error');
        return;
    }
    if (!state.activeSessionId) {
        showAlert('No session', 'Please select an available session.', 'error');
        return;
    }

    const cls = state.activeClass;
    const sessionLabel = document.getElementById('classSessionSelect')?.selectedOptions?.[0]?.textContent || '';
    document.getElementById('confirmBookMessage').textContent = `Are you sure you want to book "${cls.name}" for ${sessionLabel}?`;
    const modal = document.getElementById('confirmBookModal');
    modal?.classList.remove('hidden');
    modal?.classList.add('flex');
}

function closeConfirmBook() {
    const modal = document.getElementById('confirmBookModal');
    modal?.classList.add('hidden');
    modal?.classList.remove('flex');
}

async function submitBooking() {
    closeConfirmBook();
    try {
        const response = await fetch('/api/bookings', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({ class_session_id: state.activeSessionId }),
        });
        const data = await response.json();
        if (!response.ok) {
            showAlert('Booking failed', data.message || 'Unable to complete booking.', 'error');
            return;
        }
        showAlert('Booked!', data.message || 'Your class has been booked successfully.', 'success');
        closeClassModal();
        await fetchBookings();
    } catch {
        showAlert('Error', 'Something went wrong. Please try again.', 'error');
    }
}

async function cancelBooking(bookingId) {
    if (!confirm('Cancel this upcoming class?')) {
        return;
    }
    try {
        const response = await fetch(`/api/bookings/${bookingId}/cancel`, {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
        });
        const data = await response.json();
        if (!response.ok) {
            showAlert('Cancellation failed', data.message || 'Unable to cancel.', 'error');
            return;
        }
        showAlert('Cancelled', data.message || 'Booking cancelled.', 'success');
        await fetchBookings();
    } catch {
        showAlert('Error', 'Could not cancel booking. Please try again.', 'error');
    }
}

function setupBookingTabs() {
    document.querySelectorAll('[data-booking-tab]').forEach((tab) => {
        tab.addEventListener('click', () => {
            const name = tab.dataset.bookingTab;
            document.querySelectorAll('[data-booking-tab]').forEach((t) => {
                t.classList.toggle('booking-tab-active', t.dataset.bookingTab === name);
            });
            document.querySelectorAll('[data-booking-panel]').forEach((panel) => {
                panel.classList.toggle('hidden', panel.dataset.bookingPanel !== name);
            });
        });
    });
}

function setupCarouselControls() {
    document.getElementById('classCarouselPrev')?.addEventListener('click', () => {
        const images = state._carouselImages || [];
        if (!images.length) {
            return;
        }
        state.carouselIndex = (state.carouselIndex - 1 + images.length) % images.length;
        state._updateCarousel?.();
    });
    document.getElementById('classCarouselNext')?.addEventListener('click', () => {
        const images = state._carouselImages || [];
        if (!images.length) {
            return;
        }
        state.carouselIndex = (state.carouselIndex + 1) % images.length;
        state._updateCarousel?.();
    });
    document.getElementById('classCarouselDots')?.addEventListener('click', (e) => {
        const dot = e.target.closest('[data-carousel-dot]');
        if (!dot) {
            return;
        }
        state.carouselIndex = Number(dot.dataset.carouselDot);
        state._updateCarousel?.();
    });
}

function setupModals() {
    setupCarouselControls();
    window.addEventListener('resize', () => {
        const modal = document.getElementById('classDetailModal');
        if (modal && !modal.classList.contains('hidden')) {
            state._updateCarousel?.();
        }
    });
    document.getElementById('classDetailClose')?.addEventListener('click', closeClassModal);
    document.getElementById('classDetailModal')?.addEventListener('click', (e) => {
        if (e.target.id === 'classDetailModal') {
            closeClassModal();
        }
    });
    document.getElementById('classBookNowBtn')?.addEventListener('click', openConfirmBook);
    document.getElementById('confirmBookCancel')?.addEventListener('click', closeConfirmBook);
    document.getElementById('confirmBookYes')?.addEventListener('click', submitBooking);
    document.getElementById('confirmBookModal')?.addEventListener('click', (e) => {
        if (e.target.id === 'confirmBookModal') {
            closeConfirmBook();
        }
    });
    document.getElementById('alertModalClose')?.addEventListener('click', hideAlert);
    document.getElementById('alertModal')?.addEventListener('click', (e) => {
        if (e.target.id === 'alertModal') {
            hideAlert();
        }
    });
}

window.addEventListener('DOMContentLoaded', async () => {
    state.classes = parseClassesData();
    renderAvailableClasses();
    attachClassViewButtons();
    setupBookingTabs();
    setupModals();

    state.openLoginModal = window.archeryOpenLoginModal || null;

    await fetchCurrentUser();
    await fetchBookings();

    document.addEventListener('archery:auth-changed', async () => {
        await fetchCurrentUser();
        await fetchBookings();
    });
});
