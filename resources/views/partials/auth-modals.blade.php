            <!-- Login Modal -->
            <div id="loginModal" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm">
                <div class="w-full max-w-md rounded-[32px] bg-white/95 shadow-2xl">
                    <div class="space-y-6 p-8">
                        <div class="text-center">
                            <h2 class="text-3xl font-heading font-bold text-[#1B1B18]">Welcome Back</h2>
                            <p class="mt-2 text-sm text-[#5C4033]/70">Sign in to your archery account</p>
                        </div>

                        <form id="loginForm" class="space-y-4">
                            <div id="loginError" class="hidden rounded-3xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"></div>

                            <div class="form-group relative">
                                <label for="loginEmail" class="text-sm font-semibold text-[#1B1B18]">Email</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    </span>
                                    <input type="email" name="email" id="loginEmail" placeholder="your@email.com" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-4 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                </div>
                            </div>

                            <div class="form-group relative">
                                <label for="loginPassword" class="text-sm font-semibold text-[#1B1B18]">Password</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </span>
                                    <input type="password" name="password" id="loginPassword" placeholder="Enter your password" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-11 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                    <button type="button" id="loginPasswordToggle" class="absolute inset-y-0 right-3 flex items-center text-[#5C4033]/80 transition hover:text-[#1B1B18]" aria-label="Toggle password visibility">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="w-full rounded-full bg-[#228B22] py-3 font-semibold text-white transition hover:bg-[#1a6b1a]">Sign In</button>

                            <div class="text-center">
                                <p class="text-sm text-[#5C4033]/70">
                                    Don't have an account?
                                    <button type="button" id="switchToSignup" class="font-semibold text-[#228B22] transition hover:text-[#1a6b1a]">Sign Up</button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- SignUp Modal -->
            <div id="signupModal" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4 backdrop-blur-sm overflow-y-auto">
                <div class="my-auto w-full max-w-md rounded-[32px] bg-white/95 shadow-2xl">
                    <div class="space-y-6 p-8">
                        <div class="text-center">
                            <h2 class="text-3xl font-heading font-bold text-[#1B1B18]">Join the Range</h2>
                            <p class="mt-2 text-sm text-[#5C4033]/70">Create your archery account</p>
                        </div>

                        <form id="signupForm" class="space-y-4">
                            <div id="signupError" class="hidden rounded-3xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"></div>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <div class="form-group">
                                    <label for="firstName" class="text-sm font-semibold text-[#1B1B18]">First Name</label>
                                    <div class="relative mt-2">
                                        <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        </span>
                                        <input type="text" name="first_name" id="firstName" placeholder="John" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-4 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastName" class="text-sm font-semibold text-[#1B1B18]">Last Name</label>
                                    <div class="relative mt-2">
                                        <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                        </span>
                                        <input type="text" name="last_name" id="lastName" placeholder="Doe" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-4 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="signupEmail" class="text-sm font-semibold text-[#1B1B18]">Email</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    </span>
                                    <input type="email" name="email" id="signupEmail" placeholder="your@email.com" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-4 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phoneNumber" class="text-sm font-semibold text-[#1B1B18]">Phone Number</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                    </span>
                                    <input type="tel" name="phone_number" id="phoneNumber" placeholder="+1 (555) 123-4567" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-4 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="archeryStatus" class="text-sm font-semibold text-[#1B1B18]">Current Archery Status</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke-width="2" /><circle cx="12" cy="12" r="5" stroke-width="2" /><circle cx="12" cy="12" r="1.5" stroke-width="2" /></svg>
                                    </span>
                                    <select name="archery_status" id="archeryStatus" required class="w-full appearance-none rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-10 py-3 text-sm transition focus:border-[#228B22] focus:bg-white focus:outline-none">
                                        <option value="" disabled selected>Select your status</option>
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advanced">Advanced</option>
                                        <option value="professional">Professional</option>
                                    </select>
                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-[#5C4033]/70" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="signupPassword" class="text-sm font-semibold text-[#1B1B18]">Password</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </span>
                                    <input type="password" name="password" id="signupPassword" placeholder="Create a strong password" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-11 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                    <button type="button" id="signupPasswordToggle" class="absolute inset-y-0 right-3 flex items-center text-[#5C4033]/80 transition hover:text-[#1B1B18]" aria-label="Toggle password visibility">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>
                                </div>
                                <div id="passwordStrength" class="mt-3 flex items-center gap-3 text-sm font-medium text-[#5C4033]">
                                    <span class="font-semibold">Strength:</span>
                                    <div class="h-2 w-full overflow-hidden rounded-full bg-[#E5E7EB]">
                                        <div id="passwordStrengthBar" class="h-full w-0 rounded-full bg-red-500 transition-all duration-200"></div>
                                    </div>
                                    <span id="passwordStrengthLabel" class="min-w-[80px] text-xs font-semibold uppercase"></span>
                                </div>
                                <p id="passwordRequirements" class="mt-2 text-xs text-[#5C4033]/80">At least 8 characters, one uppercase, one number, one special character.</p>
                            </div>

                            <div class="form-group">
                                <label for="confirmPassword" class="text-sm font-semibold text-[#1B1B18]">Confirm Password</label>
                                <div class="relative mt-2">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#5C4033]/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                    </span>
                                    <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Confirm your password" required class="w-full rounded-2xl border border-[#5C4033]/10 bg-[#F5F5DC]/50 pl-11 pr-11 py-3 text-sm transition placeholder:text-[#5C4033]/40 focus:border-[#228B22] focus:bg-white focus:outline-none" />
                                    <button type="button" id="confirmPasswordToggle" class="absolute inset-y-0 right-3 flex items-center text-[#5C4033]/80 transition hover:text-[#1B1B18]" aria-label="Toggle password visibility">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="w-full rounded-full bg-[#228B22] py-3 font-semibold text-white transition hover:bg-[#1a6b1a]">Create Account</button>

                            <div class="text-center">
                                <p class="text-sm text-[#5C4033]/70">
                                    Already have an account?
                                    <button type="button" id="switchToLogin" class="font-semibold text-[#228B22] transition hover:text-[#1a6b1a]">Sign In</button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
