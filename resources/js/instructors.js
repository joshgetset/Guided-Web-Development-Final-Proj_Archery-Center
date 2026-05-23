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
    const icon = type === 'error' ? '!' : '✓';
    showToast(`${title}: ${message}`, type);
}

function parseInstructorsData() {
    const el = document.getElementById('instructorsData');
    if (!el) {
        return [];
    }
    try {
        return JSON.parse(el.textContent || '[]');
    } catch {
        return [];
    }
}

const instructorState = {
    instructors: [],
    filteredInstructors: [],
    activeInstructor: null,
    modalCarouselIndex: 0,
    filters: {
        query: '',
        experience: '',
        rating: '',
    },
};

function findTopInstructor() {
    return instructorState.instructors.reduce((top, instructor) => {
        if (!top || instructor.rating > top.rating) {
            return instructor;
        }
        return top;
    }, null);
}

function getInstructorInitials(instructor) {
    return `${instructor.first_name.slice(0, 1)}${instructor.last_name.slice(0, 1)}`;
}

function renderTopInstructor() {
    const top = findTopInstructor();
    if (!top) {
        return;
    }

    document.getElementById('topRankedImage').style.backgroundImage = top.image_url ? `url('${top.image_url}')` : '';
    document.getElementById('topRankedName').textContent = `${top.first_name} ${top.last_name}`;
    document.getElementById('topRankedTitle').textContent = top.title;
    document.getElementById('topRankedRating').textContent = `${top.rating.toFixed(2)}/5`;    
    document.getElementById('topRankedExperience').textContent = `${top.experience_years}+ yrs`;
    document.getElementById('topRankedQuote').textContent = top.quote;
    document.getElementById('viewTopInstructorBtn').addEventListener('click', () => openInstructorModal(top.id));
}

function matchesExperience(instructor, experienceFilter) {
    if (!experienceFilter) {
        return true;
    }
    if (experienceFilter === '1-3') {
        return instructor.experience_years >= 1 && instructor.experience_years <= 3;
    }
    if (experienceFilter === '4-6') {
        return instructor.experience_years >= 4 && instructor.experience_years <= 6;
    }
    if (experienceFilter === '7+') {
        return instructor.experience_years >= 7;
    }
    return true;
}

function matchesRating(instructor, ratingFilter) {
    if (!ratingFilter) {
        return true;
    }
    return instructor.rating >= Number(ratingFilter);
}

function matchesQuery(instructor, query) {
    if (!query) {
        return true;
    }
    const normalized = query.toLowerCase();
    return instructor.first_name.toLowerCase().includes(normalized) || instructor.last_name.toLowerCase().includes(normalized);
}

function hasActiveInstructorFilters() {
    const { query, experience, rating } = instructorState.filters;
    return Boolean(query.trim() || experience || rating);
}

function applyInstructorFilters() {
    const { query, experience, rating } = instructorState.filters;
    instructorState.filteredInstructors = instructorState.instructors.filter((instructor) => {
        return matchesQuery(instructor, query) && matchesExperience(instructor, experience) && matchesRating(instructor, rating);
    });
    renderInstructorCards();
}

function renderInstructorEmptyState() {
    return `
        <div class="instructor-carousel-empty flex w-full min-w-full items-center justify-center rounded-[28px] border border-dashed border-[#5C4033]/20 bg-[#F5F5DC]/60 px-6 py-12 text-center text-sm leading-7 text-[#5C4033]/85">
            No instructors match your filters. Try adjusting your search or filter options.
        </div>
    `;
}

function renderInstructorCards() {
    const carousel = document.getElementById('instructorCarousel');
    const carouselShell = document.querySelector('.instructor-carousel-shell');
    const carouselControls = document.getElementById('instructorCarouselControls');
    const count = document.getElementById('instructorCount');
    if (!carousel || !count) {
        return;
    }

    const instructors = instructorState.filteredInstructors;
    const filtersActive = hasActiveInstructorFilters();
    count.textContent = filtersActive
        ? `${instructors.length} matching instructor${instructors.length === 1 ? '' : 's'}`
        : `${instructors.length} instructor${instructors.length === 1 ? '' : 's'} available`;

    const carouselPrev = document.getElementById('instructorCarouselPrev');
    const carouselNext = document.getElementById('instructorCarouselNext');

    carouselShell?.classList.remove('hidden');

    if (!instructors.length && filtersActive) {
        carousel.innerHTML = renderInstructorEmptyState();
        carouselControls?.classList.add('hidden');
        carouselPrev?.classList.add('hidden');
        carouselNext?.classList.add('hidden');
        return;
    }

    if (!instructors.length) {
        carousel.innerHTML = '';
        carouselShell?.classList.add('hidden');
        carouselControls?.classList.add('hidden');
        return;
    }

    carouselControls?.classList.remove('hidden');
    carouselPrev?.classList.remove('hidden');
    carouselNext?.classList.remove('hidden');
    carousel.innerHTML = instructors
        .map(
            (instructor) => `
                <article class="group instructor-card flex h-full flex-col overflow-hidden rounded-[32px] border border-[#5C4033]/10 bg-white shadow-[0_25px_70px_rgba(92,64,51,0.08)] transition duration-300 hover:shadow-[0_35px_85px_rgba(92,64,51,0.15)]">
                    <div class="h-44 shrink-0 bg-cover bg-center ${instructor.image_url ? '' : 'bg-[#F5F5DC]'}" style="background-image: url('${instructor.image_url || ''}')">
                        ${instructor.image_url ? '' : '<div class="flex h-full items-center justify-center text-5xl">🏹</div>'}
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-xs uppercase tracking-[0.28em] text-[#5C4033]/70">${instructor.title}</p>
                                <h4 class="mt-2 text-lg font-heading font-semibold text-[#1B1B18]">${instructor.first_name} ${instructor.last_name}</h4>
                            </div>
                            <div class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-3xl bg-[#228B22]/10 text-sm font-semibold text-[#228B22]">${instructor.rating.toFixed(1)}</div>
                        </div>
                        <p class="instructor-bio-clamp mt-3 flex-1 text-sm leading-6 text-[#5C4033]/85">${instructor.short_bio}</p>
                        <div class="mt-5 flex flex-wrap gap-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#228B22]/90">
                            <span>${instructor.experience_years}+ yrs</span>
                            <span>${instructor.rating.toFixed(1)} rating</span>
                        </div>
                        <button type="button" data-view-instructor="${instructor.id}" class="mt-4 inline-flex w-full items-center justify-center rounded-full border border-[#228B22] bg-[#228B22]/10 px-4 py-2.5 text-sm font-semibold text-[#228B22] transition hover:bg-[#228B22] hover:text-white">View profile</button>
                    </div>
                </article>
            `,
        )
        .join('');

    attachInstructorViewButtons(carousel);
}

function attachInstructorViewButtons(context = document) {
    context.querySelectorAll('[data-view-instructor]').forEach((button) => {
        if (button.dataset.instructorViewAttached) {
            return;
        }
        button.dataset.instructorViewAttached = '1';
        button.addEventListener('click', () => {
            openInstructorModal(Number(button.dataset.viewInstructor));
        });
    });
}

function getInstructorGallery(instructor) {
    const images = [];
    if (instructor.image_url) {
        images.push(instructor.image_url);
    }
    return images;
}

function renderInstructorDetailImage(instructor) {
    const imageEl = document.getElementById('instructorDetailImage');
    if (!imageEl) {
        return;
    }

    if (instructor.image_url) {
        imageEl.style.backgroundImage = `url('${instructor.image_url}')`;
        imageEl.textContent = '';
    } else {
        imageEl.style.backgroundImage = '';
        imageEl.innerHTML = '<div class="flex h-full w-full items-center justify-center text-4xl text-[#5C4033]/80">🏹</div>';
    }
}

function renderInstructorModalCarousel(instructor) {
    const track = document.getElementById('instructorModalCarouselTrack');
    const dots = document.getElementById('instructorModalCarouselDots');
    const prev = document.getElementById('instructorModalCarouselPrev');
    const next = document.getElementById('instructorModalCarouselNext');
    const images = getInstructorGallery(instructor);

    if (!track) {
        return;
    }

    if (!images.length) {
        track.innerHTML = `<div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-[#228B22]/15 to-[#DAA520]/10 text-6xl">🏹</div>`;
        if (dots) {
            dots.innerHTML = '';
        }
        prev?.classList.add('hidden');
        next?.classList.add('hidden');
        return;
    }

    track.innerHTML = images
        .map(
            (url) =>
                `<div class="h-full w-full shrink-0 bg-cover bg-center" style="background-image:url('${url}'); min-width:100%"></div>`,
        )
        .join('');

    if (dots) {
        dots.innerHTML =
            images.length > 1
                ? images
                      .map(
                          (_, i) =>
                              `<button type="button" data-instructor-carousel-dot="${i}" class="h-2 w-2 rounded-full ${i === 0 ? 'bg-white' : 'bg-white/50'}" aria-label="Slide ${i + 1}"></button>`,
                      )
                      .join('')
                : '';
    }

    const showNav = images.length > 1;
    prev?.classList.toggle('hidden', !showNav);
    next?.classList.toggle('hidden', !showNav);

    const updateCarousel = () => {
        track.style.transform = `translateX(-${instructorState.modalCarouselIndex * 100}%)`;
        dots?.querySelectorAll('[data-instructor-carousel-dot]').forEach((dot, i) => {
            dot.classList.toggle('bg-white', i === instructorState.modalCarouselIndex);
            dot.classList.toggle('bg-white/50', i !== instructorState.modalCarouselIndex);
        });
    };

    instructorState._updateInstructorCarousel = updateCarousel;
    instructorState._instructorCarouselImages = images;
    updateCarousel();
}

function populateInstructorModal(instructor) {
    const modal = document.getElementById('instructorDetailModal');
    if (!modal || !instructor) {
        return;
    }

    const badge = document.getElementById('instructorDetailBadge');
    if (badge) {
        badge.textContent = instructor.title;
    }

    document.getElementById('instructorDetailName').textContent = `${instructor.first_name} ${instructor.last_name}`;
    document.getElementById('instructorDetailTitle').textContent = instructor.specialty;
    document.getElementById('instructorDetailRating').textContent = `${instructor.rating.toFixed(2)} / 5 average rating`;
    document.getElementById('instructorDetailExperience').textContent = `${instructor.experience_years} years of coaching experience`;
    document.getElementById('instructorDetailSpecialty').textContent = instructor.specialty;
    document.getElementById('instructorDetailBio').textContent = instructor.full_bio;
    document.getElementById('instructorDetailQuote').textContent = `"${instructor.quote}"`;

    renderInstructorDetailImage(instructor);

    const certifications = document.getElementById('instructorDetailCertifications');
    const achievements = document.getElementById('instructorDetailAchievements');

    if (certifications) {
        certifications.innerHTML = instructor.certifications
            .map((cert) => `<li class="flex gap-2"><span class="mt-1 inline-block h-2 w-2 rounded-full bg-[#228B22]"></span>${cert}</li>`)
            .join('');
    }

    if (achievements) {
        achievements.innerHTML = instructor.achievements
            .map((achievement) => `<li class="flex gap-2"><span class="mt-1 inline-block h-2 w-2 rounded-full bg-[#228B22]"></span>${achievement}</li>`)
            .join('');
    }

    instructorState.modalCarouselIndex = 0;
    renderInstructorModalCarousel(instructor);
}

function openInstructorModal(instructorId) {
    const instructor = instructorState.instructors.find((item) => item.id === instructorId);
    if (!instructor) {
        showAlert('Not found', 'Unable to load instructor profile.', 'error');
        return;
    }
    instructorState.activeInstructor = instructor;
    populateInstructorModal(instructor);
    const modal = document.getElementById('instructorDetailModal');
    modal?.classList.remove('hidden');
    modal?.classList.add('flex');
}

function closeInstructorModal() {
    const modal = document.getElementById('instructorDetailModal');
    modal?.classList.add('hidden');
    modal?.classList.remove('flex');
}

function setupInstructorFilters() {
    const searchInput = document.getElementById('instructorSearch');
    const experienceSelect = document.getElementById('experienceFilter');
    const ratingSelect = document.getElementById('ratingFilter');
    const clearButton = document.getElementById('clearInstructorFilters');

    if (searchInput) {
        searchInput.addEventListener('input', (event) => {
            instructorState.filters.query = event.target.value;
            applyInstructorFilters();
        });
    }

    if (experienceSelect) {
        experienceSelect.addEventListener('change', (event) => {
            instructorState.filters.experience = event.target.value;
            applyInstructorFilters();
        });
    }

    if (ratingSelect) {
        ratingSelect.addEventListener('change', (event) => {
            instructorState.filters.rating = event.target.value;
            applyInstructorFilters();
        });
    }

    if (clearButton) {
        clearButton.addEventListener('click', () => {
            instructorState.filters = { query: '', experience: '', rating: '' };
            if (searchInput) {
                searchInput.value = '';
            }
            if (experienceSelect) {
                experienceSelect.value = '';
            }
            if (ratingSelect) {
                ratingSelect.value = '';
            }
            applyInstructorFilters();
        });
    }
}

function setupCarouselControls() {
    const carousel = document.getElementById('instructorCarousel');
    const prev = document.getElementById('instructorCarouselPrev');
    const next = document.getElementById('instructorCarouselNext');

    if (!carousel) {
        return;
    }

    const scrollAmount = () => carousel.clientWidth - 120;

    prev?.addEventListener('click', () => {
        carousel.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
    });

    next?.addEventListener('click', () => {
        carousel.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
    });
}

function setupInstructorModalCarousel() {
    document.getElementById('instructorModalCarouselPrev')?.addEventListener('click', () => {
        const images = instructorState._instructorCarouselImages || [];
        if (images.length < 2) {
            return;
        }
        instructorState.modalCarouselIndex = (instructorState.modalCarouselIndex - 1 + images.length) % images.length;
        instructorState._updateInstructorCarousel?.();
    });

    document.getElementById('instructorModalCarouselNext')?.addEventListener('click', () => {
        const images = instructorState._instructorCarouselImages || [];
        if (images.length < 2) {
            return;
        }
        instructorState.modalCarouselIndex = (instructorState.modalCarouselIndex + 1) % images.length;
        instructorState._updateInstructorCarousel?.();
    });

    document.getElementById('instructorModalCarouselDots')?.addEventListener('click', (event) => {
        const dot = event.target.closest('[data-instructor-carousel-dot]');
        if (!dot) {
            return;
        }
        instructorState.modalCarouselIndex = Number(dot.dataset.instructorCarouselDot);
        instructorState._updateInstructorCarousel?.();
    });
}

function setupModalHandlers() {
    document.getElementById('instructorDetailClose')?.addEventListener('click', closeInstructorModal);
    document.getElementById('instructorDetailModal')?.addEventListener('click', (event) => {
        if (event.target.id === 'instructorDetailModal') {
            closeInstructorModal();
        }
    });
    setupInstructorModalCarousel();
}

window.addEventListener('DOMContentLoaded', () => {
    instructorState.instructors = parseInstructorsData();
    instructorState.filteredInstructors = [...instructorState.instructors];
    renderTopInstructor();
    applyInstructorFilters();
    setupInstructorFilters();
    setupCarouselControls();
    setupModalHandlers();
});
