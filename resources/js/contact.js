const REVIEWS_DISPLAY_LIMIT = 2;
const REVIEWS_ITEMS_PER_PAGE = 5;

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}

function loadContactData() {
    const dataEl = document.getElementById('contact-data');
    let data = null;

    if (!dataEl) {
        window.contactReviewsData = [];
        window.contactRatingCounts = { all: 0, 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 };
        return;
    }

    try {
        data = JSON.parse(dataEl.textContent || '{}');
    } catch (error) {
        data = null;
    }

    window.contactReviewsData = Array.isArray(data?.reviews) ? data.reviews : [];
    window.contactRatingCounts = data?.ratingCounts ?? { all: 0, 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 };
}

function formatInitials(name) {
    const parts = String(name).trim().split(/\s+/).filter(Boolean);
    if (parts.length === 0) {
        return 'G';
    }
    if (parts.length === 1) {
        return parts[0].slice(0, 2).toUpperCase();
    }
    return `${parts[0].charAt(0)}${parts[1].charAt(0)}`.toUpperCase();
}

function renderRatingStars(rating) {
    return Array.from({ length: 5 }, (_, index) => {
        const filled = index < rating;
        return `<span class="${filled ? 'text-[#DAA520]' : 'text-[#5C4033]/20'}">★</span>`;
    }).join('');
}

function showContactAlert(title, message, type = 'success') {
    const modal = document.getElementById('contactAlertModal');
    const icon = document.getElementById('contactAlertModalIcon');
    const titleEl = document.getElementById('contactAlertModalTitle');
    const messageEl = document.getElementById('contactAlertModalMessage');

    if (!modal || !icon || !titleEl || !messageEl) {
        return;
    }

    icon.className = `mx-auto flex h-14 w-14 items-center justify-center rounded-full text-2xl ${type === 'error' ? 'bg-[#fee2e2] text-[#991b1b]' : 'bg-[#ecfdf5] text-[#166534]'}`;
    icon.textContent = type === 'error' ? '!' : '✓';
    titleEl.textContent = title;
    messageEl.textContent = message;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function hideContactAlert() {
    const modal = document.getElementById('contactAlertModal');
    modal?.classList.add('hidden');
    modal?.classList.remove('flex');
}

function renderStarButtons(container, rating) {
    const buttons = container?.querySelectorAll('.review-star-btn') ?? [];
    buttons.forEach((button) => {
        const value = Number(button.dataset.rating);
        const active = value <= rating;
        button.classList.toggle('is-active', active);
        button.classList.toggle('text-[#DAA520]', active);
        button.classList.toggle('text-[#5C4033]/25', !active);
        button.setAttribute('aria-pressed', active ? 'true' : 'false');
    });
}

function computeRatingCounts(reviews) {
    const counts = { all: reviews.length };
    for (let star = 1; star <= 5; star += 1) {
        counts[star] = reviews.filter((review) => review.rating === star).length;
    }
    return counts;
}

function createReviewListManager() {
    const listEl = document.getElementById('recentReviewsList');
    const readMoreBtn = document.getElementById('reviewsReadMore');
    const readLessBtn = document.getElementById('reviewsReadLess');
    const filtersEl = document.getElementById('reviewRatingFilters');
    const visibleCountEl = document.getElementById('reviewsVisibleCount');
    const filteredCountEl = document.getElementById('reviewsFilteredCount');

    if (!listEl) {
        return null;
    }

    let reviews = Array.isArray(window.contactReviewsData) ? [...window.contactReviewsData] : [];
    let activeFilter = 'all';
    let expanded = false;
    let currentPage = 1;

    const getFilteredReviews = () => {
        if (activeFilter === 'all') {
            return reviews;
        }
        return reviews.filter((review) => review.rating === Number(activeFilter));
    };

    const updateFilterCounts = () => {
        const counts = computeRatingCounts(reviews);
        filtersEl?.querySelectorAll('.review-filter-count').forEach((badge) => {
            const key = badge.dataset.countFor;
            if (key === 'all') {
                badge.textContent = String(counts.all);
            } else {
                badge.textContent = String(counts[Number(key)] ?? 0);
            }
        });

    };

    const renderReviewCard = (review) => {
        const featured = review.show_on_carousel
            ? '<span class="review-featured-badge">Featured on homepage</span>'
            : '';
        const dateLine = review.created_at
            ? `<p class="review-card-date">${escapeHtml(review.created_at)}</p>`
            : '';

        return `
            <article class="review-list-card" data-review-id="${review.id}" data-rating="${review.rating}">
                <div class="review-card-header">
                    <div class="review-card-avatar" aria-hidden="true">${escapeHtml(formatInitials(review.reviewer_name))}</div>
                    <div class="review-card-meta min-w-0 flex-1">
                        <p class="review-card-name">${escapeHtml(review.reviewer_name)}</p>
                        ${dateLine}
                    </div>
                    <div class="review-card-stars" aria-label="${review.rating} out of 5 stars">${renderRatingStars(review.rating)}</div>
                </div>
                <p class="review-card-body">"${escapeHtml(review.body)}"</p>
                ${featured}
            </article>
        `;
    };

    const renderPagination = (filtered) => {
        const parent = listEl.parentNode;
        const existing = document.getElementById('reviewsPagination');
        if (!expanded || filtered.length <= REVIEWS_ITEMS_PER_PAGE) {
            if (existing) existing.remove();
            return;
        }

        const totalPages = Math.ceil(filtered.length / REVIEWS_ITEMS_PER_PAGE);
        let html = '';
        html += '<div id="reviewsPagination" class="reviews-pagination mt-4">';
        // left arrow (hidden on first page)
        if (currentPage > 1) {
            html += `<button type="button" class="reviews-page-prev" aria-label="Previous page">‹</button>`;
        }
        for (let i = 1; i <= totalPages; i += 1) {
            html += `<button type="button" class="reviews-page-btn ${i === currentPage ? 'is-active' : ''}" data-page="${i}">${i}</button>`;
        }
        // right arrow (hidden on last page)
        if (currentPage < totalPages) {
            html += `<button type="button" class="reviews-page-next" aria-label="Next page">›</button>`;
        }
        html += '</div>';

        if (existing) {
            existing.innerHTML = html;
        } else {
            const wrapper = document.createElement('div');
            wrapper.innerHTML = html;
            parent.insertBefore(wrapper.firstElementChild, readMoreBtn);
        }

        const pagEl = document.getElementById('reviewsPagination');
        pagEl.querySelectorAll('.reviews-page-btn').forEach((btn) => {
            btn.addEventListener('click', () => {
                currentPage = Number(btn.dataset.page);
                render();
            });
        });

        pagEl.querySelector('.reviews-page-prev')?.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage -= 1;
                render();
            }
        });

        pagEl.querySelector('.reviews-page-next')?.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage += 1;
                render();
            }
        });
    };

    const render = () => {
        const filtered = getFilteredReviews();
        let visible = [];
        if (!expanded) {
            visible = filtered.slice(0, REVIEWS_DISPLAY_LIMIT);
        } else {
            if (filtered.length <= REVIEWS_ITEMS_PER_PAGE) {
                visible = filtered.slice(0, filtered.length);
            } else {
                const start = (currentPage - 1) * REVIEWS_ITEMS_PER_PAGE;
                visible = filtered.slice(start, start + REVIEWS_ITEMS_PER_PAGE);
            }
        }

        if (visible.length === 0) {
            const emptyMessage = activeFilter === 'all'
                ? 'No reviews yet. Be the first to share your experience!'
                : `No ${activeFilter}-star reviews yet. Try another filter or submit your own.`;
            listEl.innerHTML = `<p class="review-list-empty">${emptyMessage}</p>`;
        } else {
            listEl.innerHTML = visible.map(renderReviewCard).join('');
        }

        if (visibleCountEl) visibleCountEl.textContent = String(visible.length);
        if (filteredCountEl) filteredCountEl.textContent = String(filtered.length);

        const hasMore = filtered.length > REVIEWS_DISPLAY_LIMIT;
        readMoreBtn?.classList.toggle('hidden', expanded || !hasMore);
        readLessBtn?.classList.toggle('hidden', !expanded);

        filtersEl?.querySelectorAll('.review-filter-btn').forEach((button) => {
            const isActive = button.dataset.filter === String(activeFilter);
            button.classList.toggle('is-active', isActive);
            button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        updateFilterCounts();
        renderPagination(filtered);
    };

    const setFilter = (filter) => {
        activeFilter = filter;
        expanded = false;
        currentPage = 1;
        render();
    };

    const addReview = (review) => {
        reviews = [
            {
                ...review,
                created_at: review.created_at ?? new Date().toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric',
                }),
            },
            ...reviews,
        ];
        activeFilter = 'all';
        expanded = false;
        currentPage = 1;
        render();
    };

    filtersEl?.querySelectorAll('.review-filter-btn').forEach((button) => {
        button.addEventListener('click', () => {
            setFilter(button.dataset.filter ?? 'all');
        });
    });

    readMoreBtn?.addEventListener('click', () => {
        expanded = true;
        currentPage = 1;
        render();
    });

    readLessBtn?.addEventListener('click', () => {
        expanded = false;
        currentPage = 1;
        render();
        listEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    render();

    return { addReview, render };
}

function setupStarRating() {
    const container = document.getElementById('reviewStarRating');
    const hiddenInput = document.getElementById('reviewRatingValue');
    if (!container || !hiddenInput) {
        return;
    }

    let selectedRating = 0;

    container.querySelectorAll('.review-star-btn').forEach((button) => {
        button.addEventListener('mouseenter', () => {
            renderStarButtons(container, Number(button.dataset.rating));
        });

        button.addEventListener('mouseleave', () => {
            renderStarButtons(container, selectedRating);
        });

        button.addEventListener('click', () => {
            selectedRating = Number(button.dataset.rating);
            hiddenInput.value = String(selectedRating);
            renderStarButtons(container, selectedRating);
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('contactAlertModalClose')?.addEventListener('click', hideContactAlert);
    document.getElementById('contactAlertModal')?.addEventListener('click', (event) => {
        if (event.target.id === 'contactAlertModal') {
            hideContactAlert();
        }
    });

    loadContactData();
    setupStarRating();
    const reviewList = createReviewListManager();

    const contactForm = document.getElementById('contactForm');
    const contactError = document.getElementById('contactFormError');
    const contactSubmitBtn = document.getElementById('contactSubmitBtn');

    contactForm?.addEventListener('submit', async (event) => {
        event.preventDefault();
        contactError?.classList.add('hidden');

        const payload = {
            email: document.getElementById('contactEmail')?.value?.trim() ?? '',
            name: document.getElementById('contactName')?.value?.trim() ?? '',
            message: document.getElementById('contactMessage')?.value?.trim() ?? '',
        };

        if (!payload.email || !payload.name || !payload.message) {
            if (contactError) {
                contactError.textContent = 'Please complete all fields before submitting.';
                contactError.classList.remove('hidden');
            }
            return;
        }

        contactSubmitBtn.disabled = true;
        contactSubmitBtn.textContent = 'SENDING...';

        try {
            const response = await fetch('/api/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
                credentials: 'same-origin',
                body: JSON.stringify(payload),
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Unable to send your message. Please try again.');
            }

            contactForm.reset();
            showContactAlert('Message sent', data.message ?? 'Your message has been sent successfully.', 'success');
        } catch (error) {
            showContactAlert('Message failed', error.message ?? 'Unable to send your message. Please try again.', 'error');
        } finally {
            contactSubmitBtn.disabled = false;
            contactSubmitBtn.textContent = 'SUBMIT';
        }
    });

    const reviewForm = document.getElementById('reviewForm');
    const reviewError = document.getElementById('reviewFormError');
    const reviewSubmitBtn = document.getElementById('reviewSubmitBtn');
    const ratingInput = document.getElementById('reviewRatingValue');
    const starContainer = document.getElementById('reviewStarRating');

    reviewForm?.addEventListener('submit', async (event) => {
        event.preventDefault();
        reviewError?.classList.add('hidden');

        const rating = Number(ratingInput?.value ?? 0);
        const comment = document.getElementById('reviewComment')?.value?.trim() ?? '';

        if (rating < 1) {
            if (reviewError) {
                reviewError.textContent = 'Please select a star rating before submitting.';
                reviewError.classList.remove('hidden');
            }
            return;
        }

        if (comment.length < 10) {
            if (reviewError) {
                reviewError.textContent = 'Please write at least 10 characters in your review.';
                reviewError.classList.remove('hidden');
            }
            return;
        }

        reviewSubmitBtn.disabled = true;
        reviewSubmitBtn.textContent = 'SUBMITTING...';

        try {
            const response = await fetch('/api/reviews', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
                credentials: 'same-origin',
                body: JSON.stringify({ rating, comment }),
            });

            const data = await response.json();

            if (!response.ok) {
                const validationMessage = data.errors
                    ? Object.values(data.errors).flat().join(' ')
                    : data.message;
                throw new Error(validationMessage || 'Unable to submit your review. Please try again.');
            }

            reviewForm.reset();
            ratingInput.value = '0';
            renderStarButtons(starContainer, 0);
            reviewList?.addReview(data.review);
            showContactAlert('Review submitted', data.message ?? 'Thank you for your review!', 'success');
        } catch (error) {
            showContactAlert('Review failed', error.message ?? 'Unable to submit your review. Please try again.', 'error');
        } finally {
            reviewSubmitBtn.disabled = false;
            reviewSubmitBtn.textContent = 'SUBMIT REVIEW';
        }
    });
});
