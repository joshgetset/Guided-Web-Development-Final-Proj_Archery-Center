// Modal Management
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast fixed bottom-6 right-6 z-50 max-w-sm rounded-3xl px-5 py-4 text-sm font-semibold shadow-xl transition duration-300 ${type === 'error' ? 'bg-[#fee2e2] text-[#991b1b] border border-[#fecaca]' : 'bg-[#ecfdf5] text-[#166534] border border-[#bbf7d0]'}`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('opacity-0');
    }, 2200);

    setTimeout(() => {
        toast.remove();
    }, 2600);
}

function formatUserInitials(name) {
    if (!name) {
        return 'U';
    }
    const parts = name.trim().split(' ').filter(Boolean);
    if (parts.length === 0) {
        return name.slice(0, 2).toUpperCase();
    }
    const initials = parts.slice(0, 2).map((part) => part.charAt(0).toUpperCase()).join('');
    return initials;
}

function setFormMessage(container, message) {
    if (!container) {
        return;
    }
    if (!message) {
        container.classList.add('hidden');
        container.textContent = '';
        return;
    }
    container.textContent = message;
    container.classList.remove('hidden');
}

function evaluatePasswordStrength(password) {
    const tests = {
        length: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /[0-9]/.test(password),
        special: /[!@#$%^&*(),.?":{}|<>]/.test(password),
    };

    const passed = Object.values(tests).filter(Boolean).length;
    const score = Math.min(100, passed * 20);
    let label = 'Weak';
    let color = '#ef4444';

    if (passed >= 4) {
        label = 'Acceptable';
        color = '#f59e0b';
    }
    if (passed === 5) {
        label = 'Strong';
        color = '#22c55e';
    }

    return { score, label, color, tests };
}

const PASSWORD_EYE_ICON = '<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>';
const PASSWORD_EYE_SLASH_ICON = '<svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>';

function togglePasswordVisibility(button, input) {
    if (!button || !input) {
        return;
    }
    button.addEventListener('click', () => {
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;
        button.innerHTML = type === 'password' ? PASSWORD_EYE_ICON : PASSWORD_EYE_SLASH_ICON;
    });
}

function updatePasswordStrengthUI(password) {
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthLabel = document.getElementById('passwordStrengthLabel');
    if (!strengthBar || !strengthLabel) {
        return;
    }

    const { score, label, color } = evaluatePasswordStrength(password);
    strengthBar.style.width = `${score}%`;
    strengthBar.style.backgroundColor = color;
    strengthLabel.textContent = label;
}

function updateAuthButton(user, openLoginModal) {
    const authButtonContainer = document.getElementById('authButtonContainer');
    if (!authButtonContainer) {
        return;
    }

    if (!user) {
        authButtonContainer.innerHTML = `
            <button id="navLoginBtn" class="rounded-full bg-[#DAA520] px-5 py-2 font-semibold text-[#1B1B18] transition hover:bg-[#ffc107]">Login</button>
        `;
        const loginButton = document.getElementById('navLoginBtn');
        if (loginButton) {
            loginButton.addEventListener('click', openLoginModal);
        }
        return;
    }

    const initials = formatUserInitials(user.name);
    authButtonContainer.innerHTML = `
        <div class="relative" id="userMenuWrapper">
            <button id="userMenuButton" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[#DAA520] text-[#1B1B18] font-semibold shadow-sm transition hover:shadow-md">${initials}</button>
            <div id="userMenu" class="hidden absolute right-0 top-full mt-3 min-w-[200px] overflow-hidden rounded-3xl border border-[#5C4033]/10 bg-white shadow-2xl">
                <div class="border-b border-[#E5E7EB] px-4 py-3 text-sm text-[#5C4033]">Signed in as <span class="font-semibold text-[#1B1B18]">${user.name}</span></div>
                <button id="logoutBtn" class="w-full px-4 py-3 text-left text-sm font-semibold text-[#228B22] transition hover:bg-[#F5F5DC]/80">Logout</button>
            </div>
        </div>
    `;

    const menuButton = document.getElementById('userMenuButton');
    const userMenu = document.getElementById('userMenu');
    const logoutBtn = document.getElementById('logoutBtn');

    menuButton?.addEventListener('click', () => {
        if (userMenu) {
            userMenu.classList.toggle('hidden');
        }
    });

    logoutBtn?.addEventListener('click', async () => {
        const response = await fetch('/api/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
        });

        if (response.ok) {
            updateAuthButton(null, openLoginModal);
            showToast('Logged out successfully', 'success');
            document.dispatchEvent(new CustomEvent('archery:auth-changed'));
        }
    });
}

async function fetchCurrentUser(openLoginModal) {
    try {
        const response = await fetch('/api/user', {
            headers: {
                Accept: 'application/json',
            },
        });
        if (!response.ok) {
            updateAuthButton(null, openLoginModal);
            return;
        }
        const data = await response.json();
        if (data?.user) {
            updateAuthButton(data.user, openLoginModal);
        } else {
            updateAuthButton(null, openLoginModal);
        }
    } catch (error) {
        updateAuthButton(null, openLoginModal);
    }
}

function setupModals() {
    const loginModal = document.getElementById('loginModal');
    if (!loginModal) {
        return null;
    }
    const signupModal = document.getElementById('signupModal');
    const heroBookBtn = document.getElementById('heroBookBtn');
    const switchToSignup = document.getElementById('switchToSignup');
    const switchToLogin = document.getElementById('switchToLogin');
    const loginError = document.getElementById('loginError');
    const signupError = document.getElementById('signupError');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');
    const loginPasswordInput = document.getElementById('loginPassword');
    const signupPasswordInput = document.getElementById('signupPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const loginPasswordToggle = document.getElementById('loginPasswordToggle');
    const signupPasswordToggle = document.getElementById('signupPasswordToggle');
    const confirmPasswordToggle = document.getElementById('confirmPasswordToggle');

    togglePasswordVisibility(loginPasswordToggle, loginPasswordInput);
    togglePasswordVisibility(signupPasswordToggle, signupPasswordInput);
    togglePasswordVisibility(confirmPasswordToggle, confirmPasswordInput);

    signupPasswordInput?.addEventListener('input', (event) => {
        updatePasswordStrengthUI(event.target.value);
    });

    const openLoginModal = () => {
        loginModal.classList.remove('hidden');
        loginModal.classList.add('flex');
        signupModal.classList.add('hidden');
        signupModal.classList.remove('flex');
        setFormMessage(loginError, '');
        setFormMessage(signupError, '');
    };

    const openSignupModal = () => {
        signupModal.classList.remove('hidden');
        signupModal.classList.add('flex');
        loginModal.classList.add('hidden');
        loginModal.classList.remove('flex');
        setFormMessage(loginError, '');
        setFormMessage(signupError, '');
    };

    const closeModals = () => {
        loginModal.classList.add('hidden');
        loginModal.classList.remove('flex');
        signupModal.classList.add('hidden');
        signupModal.classList.remove('flex');
    };

    heroBookBtn?.addEventListener('click', openLoginModal);
    switchToSignup?.addEventListener('click', (e) => {
        e.preventDefault();
        openSignupModal();
    });
    switchToLogin?.addEventListener('click', (e) => {
        e.preventDefault();
        openLoginModal();
    });

    document.addEventListener('click', (e) => {
        if (e.target === loginModal) closeModals();
        if (e.target === signupModal) closeModals();
    });

    fetchCurrentUser(openLoginModal);

    loginForm?.addEventListener('submit', async (e) => {
        e.preventDefault();
        setFormMessage(loginError, '');
        const email = document.getElementById('loginEmail').value.trim();
        const password = document.getElementById('loginPassword').value;
        if (!email || !password) {
            setFormMessage(loginError, 'Email and password are required.');
            return;
        }
        const payload = {
            email,
            password,
        };

        try {
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
                body: JSON.stringify(payload),
            });

            const data = await response.json();
            if (!response.ok) {
                setFormMessage(loginError, data.message || 'Invalid login details.');
                return;
            }
            showToast(data.message || 'Sign in successful', 'success');
            updateAuthButton(data.user, openLoginModal);
            document.dispatchEvent(new CustomEvent('archery:auth-changed'));
            setTimeout(closeModals, 1200);
        } catch (error) {
            setFormMessage(loginError, 'Unable to sign in. Please try again.');
        }
    });

    signupForm?.addEventListener('submit', async (e) => {
        e.preventDefault();
        setFormMessage(signupError, '');
        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const email = document.getElementById('signupEmail').value.trim();
        const phoneNumber = document.getElementById('phoneNumber').value.trim();
        const archeryStatus = document.getElementById('archeryStatus').value;
        const password = document.getElementById('signupPassword').value;
        const passwordConfirmation = document.getElementById('confirmPassword').value;

        const errors = [];
        if (!firstName) {
            errors.push('First name is required.');
        }
        if (!lastName) {
            errors.push('Last name is required.');
        }
        if (!email) {
            errors.push('Email is required.');
        }
        if (!phoneNumber) {
            errors.push('Phone number is required.');
        }
        if (!archeryStatus) {
            errors.push('Current archery status is required.');
        }
        if (!password) {
            errors.push('Password is required.');
        }
        if (password !== passwordConfirmation) {
            errors.push('Passwords do not match.');
        }

        const { tests } = evaluatePasswordStrength(password);
        if (!tests.length || !tests.uppercase || !tests.lowercase || !tests.number || !tests.special) {
            errors.push('Password must be at least 8 characters and include one uppercase letter, one number, and one special character.');
        }

        if (errors.length > 0) {
            setFormMessage(signupError, errors.join(' '));
            return;
        }

        const payload = {
            first_name: firstName,
            last_name: lastName,
            email,
            phone_number: phoneNumber,
            archery_status: archeryStatus,
            password,
            password_confirmation: passwordConfirmation,
        };

        try {
            const response = await fetch('/api/signup', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
                body: JSON.stringify(payload),
            });

            const data = await response.json();
            if (!response.ok) {
                const message = data.message || (data.errors ? Object.entries(data.errors).map(([key, value]) => `${key.replace('_', ' ')}: ${value.join(' ')}`).join(' ') : 'Signup validation failed.');
                setFormMessage(signupError, message);
                return;
            }

            showToast(data.message || 'Account created successfully. Please sign in.', 'success');
            openLoginModal();
        } catch (error) {
            setFormMessage(signupError, 'Unable to create account. Please try again.');
        }
    });

    return openLoginModal;
}

window.addEventListener('DOMContentLoaded', () => {
    window.archeryOpenLoginModal = setupModals();
    const carousels = document.querySelectorAll('.carousel-container');

    carousels.forEach((wrapper) => {
        const scrollArea = wrapper.querySelector('.carousel-scroll');
        const buttonLeft = wrapper.querySelector('.carousel-arrow-left');
        const buttonRight = wrapper.querySelector('.carousel-arrow-right');
        const items = scrollArea?.querySelectorAll('.carousel-item') ?? [];
        let currentIndex = 0;

        if (!scrollArea || !buttonLeft || !buttonRight || items.length === 0) {
            return;
        }

        const updateButtonVisibility = () => {
            const overflow = scrollArea.scrollWidth > scrollArea.clientWidth + 4;
            buttonLeft.classList.toggle('hidden', !overflow);
            buttonRight.classList.toggle('hidden', !overflow);
        };

        const scrollToIndex = (index) => {
            const target = items[index];
            if (!target) {
                return;
            }
            target.scrollIntoView({ behavior: 'smooth', inline: 'start', block: 'nearest' });
        };

        buttonLeft.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            scrollToIndex(currentIndex);
        });

        buttonRight.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % items.length;
            scrollToIndex(currentIndex);
        });

        scrollArea.addEventListener('scroll', updateButtonVisibility);
        window.addEventListener('resize', updateButtonVisibility);
        updateButtonVisibility();
    });

    const featuredProgramCard = document.querySelector('#featuredProgramCard');
    if (featuredProgramCard) {
        const featuredPrograms = [
            {
                label: 'Featured program',
                title: 'Beginner Lessons',
                description: 'Step into the range with expert instructors and premium equipment. Perfect for first-timers and weekend warriors.',
                points: [
                    { icon: '🎯', title: 'Focused coaching', subtitle: 'Personal form feedback' },
                    { icon: '🏹', title: 'Modern equipment', subtitle: 'All gear included' },
                    { icon: '🌿', title: 'Outdoor energy', subtitle: 'Urban range atmosphere' },
                ],
            },
            {
                label: 'Featured program',
                title: 'Advanced Training',
                description: 'Push your bow skills with precision drills, strength work, and competition-ready coaching for rising archers.',
                points: [
                    { icon: '🎯', title: 'Precision drills', subtitle: 'Sharpen accuracy and form' },
                    { icon: '💪', title: 'Power development', subtitle: 'Improve release strength' },
                    { icon: '🏆', title: 'Competition focus', subtitle: 'Train for events and challenges' },
                ],
            },
            {
                label: 'Featured program',
                title: 'Group Events',
                description: 'Bring friends, family, or teammates for a guided archery session that blends coaching, challenge, and fun.',
                points: [
                    { icon: '🤝', title: 'Team-focused', subtitle: 'Group drills and games' },
                    { icon: '🎉', title: 'Event ready', subtitle: 'Perfect for parties and meetups' },
                    { icon: '👥', title: 'All skill levels', subtitle: 'Supportive coaching for everyone' },
                ],
            },
        ];

        const label = document.querySelector('#featuredProgramLabel');
        const title = document.querySelector('#featuredProgramTitle');
        const description = document.querySelector('#featuredProgramDescription');
        const pointsContainer = document.querySelector('#featuredProgramPoints');
        const button = document.querySelector('#featuredProgramButton');
        let activeFeaturedIndex = 0;

        const renderFeatured = (index) => {
            const featured = featuredPrograms[index];
            if (!featured || !label || !title || !description || !pointsContainer || !button) {
                return;
            }

            label.textContent = featured.label;
            title.textContent = featured.title;
            description.textContent = featured.description;
            pointsContainer.innerHTML = featured.points
                .map(
                    (point) => `
                        <div class="flex items-start gap-4 rounded-3xl border border-[#5C4033]/10 bg-[#F5F5DC] p-4">
                            <span class="icon-mark">${point.icon}</span>
                            <div>
                                <p class="font-semibold text-[#1B1B18]">${point.title}</p>
                                <p class="text-sm text-[#5C4033]/80">${point.subtitle}</p>
                            </div>
                        </div>
                    `,
                )
                .join('');
            button.textContent = 'Reserve a slot';
        };

        const animateFeatured = (index) => {
            featuredProgramCard.classList.add('fade-out');
            setTimeout(() => {
                renderFeatured(index);
                featuredProgramCard.classList.remove('fade-out');
                featuredProgramCard.classList.add('fade-in');
                setTimeout(() => featuredProgramCard.classList.remove('fade-in'), 350);
            }, 250);
        };

        featuredProgramCard.classList.add('featured-fade');
        renderFeatured(activeFeaturedIndex);
        setInterval(() => {
            activeFeaturedIndex = (activeFeaturedIndex + 1) % featuredPrograms.length;
            animateFeatured(activeFeaturedIndex);
        }, 5000);
    }

    const heroSlides = document.querySelectorAll('.hero-slide');
    let heroActiveIndex = 0;

    if (heroSlides.length > 0) {
        const switchHeroSlide = (nextIndex) => {
            const current = heroSlides[heroActiveIndex];
            const next = heroSlides[nextIndex];
            if (!current || !next || nextIndex === heroActiveIndex) {
                return;
            }

            current.classList.remove('active');
            current.classList.add('prev');
            next.classList.remove('prev');
            next.classList.add('active');
            heroActiveIndex = nextIndex;

            setTimeout(() => {
                current.classList.remove('prev');
            }, 700);
        };

        setInterval(() => {
            const nextIndex = (heroActiveIndex + 1) % heroSlides.length;
            switchHeroSlide(nextIndex);
        }, 5000);
    }
});
