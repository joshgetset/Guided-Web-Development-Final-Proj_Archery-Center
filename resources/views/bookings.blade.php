@extends('layouts.admin')

@section('title', 'Bookings · ' . config('app.name', 'Archery Adventures'))

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />
@endpush

@section('content')
    @php
        $calendarEvents = $bookings->map(function($b) {
            $title = ($b->archeryClass->name ?? 'Class') . ' — ' . ($b->user->first_name ?? $b->user->name);
            $start = $b->classSession ? $b->classSession->starts_at?->toIso8601String() : null;
            return ['id' => $b->id, 'title' => $title, 'start' => $start];
        })->filter(fn($e) => !empty($e['start']))->values();
    @endphp

    <div class="min-h-screen bg-[#EDF1F5] text-[#1B1B18]">
        <div class="relative flex min-h-screen">
            <aside id="adminSidebar" class="fixed inset-y-0 left-0 z-20 w-64 transform border-r border-white/10 bg-[#5C4033] px-4 py-6 text-white transition-all duration-300 ease-in-out overflow-hidden flex flex-col">
                <div>
                    <div class="flex items-center gap-3 px-1">
                        <img src="{{ asset('images/logo.svg') }}" alt="Archery Adventures logo" class="h-9 w-9 flex-shrink-0 rounded-3xl bg-white/10 p-2" />
                        <div class="sidebar-text">
                            <p class="text-sm font-semibold text-white">Archery</p>
                            <p class="text-xs text-[#CBD5E1]/60">Dashboard</p>
                        </div>
                    </div>

                    <nav class="mt-6 space-y-0 text-sm font-medium text-[#CBD5E1]">
                        <a href="/dashboard" class="sidebar-link flex items-center gap-3 rounded-lg bg-white px-2 py-1.5 text-[#1B1B18] transition hover:bg-white/95" aria-current="page">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Overview</span>
                        </a>
                        <a href="/classes" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.423 2 15.5c0 5.078 4.5 9.247 10 9.247s10-4.169 10-9.247c0-5.077-4.5-9.247-10-9.247z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Classes</span>
                        </a>
                        <a href="/instructors" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M7.667 8.879a6 6 0 1110.666 0M12 12.5v.005M12.5 16.5h-1a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h1a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Instructors</span>
                        </a>
                        <a href="/dashboard/bookings" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m4 0H5" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Bookings</span>
                        </a>
                        <a href="#stats" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 12h6m-6 4h8m-8-8h10M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Statistics</span>
                        </a>
                        <a href="#activity" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Activity</span>
                        </a>
                        <a href="#tools" class="sidebar-link inline-flex w-full items-center gap-3 rounded-full px-3 py-1 transition hover:bg-white/15 text-white">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-transparent text-current">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197 3.197a4 4 0 01-1.414 1.414l-1.732.577a1 1 0 00-.57 1.569l.776 1.165a1 1 0 001.311.318l1.733-.866a4 4 0 011.828-.461l3.197-3.197m1.414-1.414l2.121-2.121a2 2 0 10-2.828-2.828l-2.121 2.121" />
                                </svg>
                            </span>
                            <span class="sidebar-text">Tools</span>
                        </a>
                    </nav>
                </div>

                <div class="mt-auto pt-6">
                    <button id="logoutBtn" class="flex w-full items-center gap-3 rounded-full bg-[#EF4444] px-3 py-2 text-sm font-semibold text-white transition hover:bg-[#DC2626]">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-transparent text-current">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                            </svg>
                        </span>
                        <span class="sidebar-text">Sign out</span>
                    </button>
                </div>
            </aside>

            <div id="dashboardContent" class="flex-1 transition-all duration-300" style="padding-left:18rem;">
                <header class="sticky top-0 z-10 border-b border-slate-200 bg-[#F5F5DC] px-6 py-4 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <button id="sidebarToggle" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[#228B22] text-white shadow transition hover:bg-[#1a6b1a]" aria-label="Toggle sidebar" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div>
                            <p class="text-sm text-[#5C4033]/80">Bookings</p>
                            <h1 class="text-2xl font-semibold text-[#1B1B18]">Bookings</h1>
                        </div>

                        <div class="hidden items-center gap-3 rounded-3xl bg-white px-4 py-3 shadow-sm sm:flex">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-[#DAA520] text-sm font-semibold text-[#1B1B18]">{{ strtoupper(substr($user->first_name ?? $user->name, 0, 1)) }}</span>
                            <div>
                                <p class="text-sm font-semibold text-[#1B1B18]">{{ $user->first_name ?? $user->name }}</p>
                                <p class="text-xs text-[#5C4033]/80">Administrator</p>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="px-6 py-8">
                    <section class="rounded-[32px] border border-slate-200 bg-white p-8 shadow">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold text-[#1B1B18]">All Bookings</h3>
                            <div class="flex items-center gap-3">
                                <div class="inline-flex rounded-lg border bg-[#F5F5DC] p-1">
                                    <button id="listViewBtn" class="px-3 py-1 text-sm font-semibold">List</button>
                                    <button id="cardViewBtn" class="px-3 py-1 text-sm">Cards</button>
                                    <button id="calendarViewBtn" class="px-3 py-1 text-sm">Calendar</button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div id="listView">
                                <div class="rounded-lg border bg-white p-4 shadow-sm">
                                    <div class="overflow-x-auto">
                                        <table class="w-full table-auto">
                                            <thead>
                                                <tr class="text-left text-sm text-[#5C4033]/80">
                                                    <th class="px-3 py-3">#</th>
                                                    <th class="px-3 py-3">User</th>
                                                    <th class="px-3 py-3">Class</th>
                                                    <th class="px-3 py-3">Session</th>
                                                    <th class="px-3 py-3">Status</th>
                                                    <th class="px-3 py-3">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="mt-2">
                                                @foreach($bookings as $booking)
                                                    <tr class="border-t">
                                                        <td class="px-3 py-4 text-sm text-[#5C4033]/90">{{ $booking->id }}</td>
                                                        <td class="px-3 py-4 text-sm">{{ $booking->user->first_name ?? $booking->user->name }}</td>
                                                        <td class="px-3 py-4 text-sm">{{ $booking->archeryClass->name ?? '—' }}</td>
                                                        <td class="px-3 py-4 text-sm">{{ $booking->classSession?->starts_at?->format('M j, Y g:i A') ?? '—' }}</td>
                                                        <td class="px-3 py-4 text-sm"><span class="inline-block rounded-full px-3 py-1 text-xs font-medium bg-[#F3F4F6] text-[#111827]">{{ $booking->displayStatus() }}</span></td>
                                                        <td class="px-3 py-4 text-sm">
                                                            <div class="flex items-center gap-2">
                                                                <button data-id="{{ $booking->id }}" class="viewBtn rounded-md border border-[#E5E7EB] bg-white px-3 py-1 text-sm text-[#111827]">View</button>
                                                                <button data-id="{{ $booking->id }}" class="editBtn rounded-md bg-[#ECFDF5] px-3 py-1 text-sm text-[#065F46]">Edit</button>
                                                                @if($booking->isUpcoming())
                                                                    <button data-id="{{ $booking->id }}" class="cancelBtn rounded-md bg-[#FEF2F2] px-3 py-1 text-sm text-[#991B1B]">Cancel</button>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div id="cardView" class="hidden">
                                <div class="rounded-lg border bg-white p-6 shadow-sm">
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                                        @foreach($bookings as $booking)
                                            <div class="rounded-lg border p-4 bg-[#FFFFFF] shadow-sm">
                                                <div class="flex items-start gap-3">
                                                    <div class="h-20 w-20 flex-shrink-0 rounded-lg bg-gray-100 overflow-hidden">
                                                        @if($booking->archeryClass && ($img = \App\Support\SiteImage::classCardImage($booking->archeryClass->slug)))
                                                            <img src="{{ $img }}" class="h-full w-full object-cover" alt="">
                                                        @endif
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="flex items-center justify-between">
                                                            <div class="font-semibold text-lg">{{ $booking->archeryClass->name ?? '—' }}</div>
                                                            <div class="text-xs text-[#6B7280]">{{ $booking->displayStatus() }}</div>
                                                        </div>
                                                        <div class="text-sm text-[#6B7280]">{{ $booking->classSession?->starts_at?->format('l, M j · g:i A') ?? '—' }}</div>
                                                        <div class="mt-2 text-sm">{{ $booking->user->first_name ?? $booking->user->name }}</div>
                                                        <div class="mt-3 flex gap-2">
                                                            <button data-id="{{ $booking->id }}" class="viewBtn rounded-md border border-[#E5E7EB] bg-white px-3 py-1 text-sm text-[#111827]">View</button>
                                                            <button data-id="{{ $booking->id }}" class="editBtn rounded-md bg-[#ECFDF5] px-3 py-1 text-sm text-[#065F46]">Edit</button>
                                                            @if($booking->isUpcoming())
                                                                <button data-id="{{ $booking->id }}" class="cancelBtn rounded-md bg-[#FEF2F2] px-3 py-1 text-sm text-[#991B1B]">Cancel</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div id="calendarView" class="hidden">
                                <div id="calendarContainer" class="rounded-lg border bg-white p-4 shadow-sm">
                                    <div id="calendar" class="w-full" data-events='@json($calendarEvents)'></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div id="modalRoot"></div>

    @push('scripts')
        <script>
            async function fetchJson(url, opts = {}) {
                opts.headers = Object.assign({'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json', 'Content-Type': 'application/json'}, opts.headers || {});
                const res = await fetch(url, opts);
                return res.json();
            }

            document.addEventListener('DOMContentLoaded', function () {
                const viewBtns = document.querySelectorAll('.viewBtn');
                const editBtns = document.querySelectorAll('.editBtn');
                const cancelBtns = document.querySelectorAll('.cancelBtn');

                viewBtns.forEach(b => b.addEventListener('click', async (e) => {
                    const id = b.getAttribute('data-id');
                    const data = await fetchJson('/dashboard/bookings/' + id);
                    showViewModal(data.booking);
                }));

                editBtns.forEach(b => b.addEventListener('click', async (e) => {
                    const id = b.getAttribute('data-id');
                    const data = await fetchJson('/dashboard/bookings/' + id);
                    showEditModal(data.booking);
                }));

                cancelBtns.forEach(b => b.addEventListener('click', async (e) => {
                    if (!confirm('Are you sure you want to cancel this booking?')) return;
                    const id = b.getAttribute('data-id');
                    const res = await fetchJson('/dashboard/bookings/' + id + '/cancel', {method: 'POST'});
                    if (res.booking) {
                        window.location.reload();
                    } else {
                        alert('Failed to cancel booking');
                    }
                }));
            });

            function showViewModal(booking) {
                const root = document.getElementById('modalRoot');
                root.innerHTML = `
                    <div class="fixed inset-0 z-50 flex items-start justify-center pt-12">
                        <div class="absolute inset-0 bg-black/40"></div>
                        <div class="relative z-10 w-11/12 max-w-3xl rounded-xl bg-white p-6 shadow-lg">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-xl font-semibold">Booking #${booking.id}</h3>
                                    <p class="text-sm text-[#5C4033]/80">${booking.archery_class?.name ?? '—'} · ${booking.class_session?.starts_at ? new Date(booking.class_session.starts_at).toLocaleString() : '—'}</p>
                                </div>
                                <div class="text-sm text-[#5C4033]/80">Status: <span class="font-semibold">${booking.status}</span></div>
                            </div>
                            <div class="mt-4 grid grid-cols-1 gap-3 md:grid-cols-2">
                                <div>
                                    <div class="text-xs text-[#5C4033]/80">User</div>
                                    <div class="mt-1 font-semibold">${booking.user.first_name ?? booking.user.name}</div>
                                    <div class="text-xs text-[#5C4033]/80">Email: ${booking.user.email ?? '—'}</div>
                                </div>
                                <div>
                                    <div class="text-xs text-[#5C4033]/80">Booked at</div>
                                    <div class="mt-1">${booking.booked_at ?? ''}</div>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end">
                                <button onclick="document.getElementById('modalRoot').innerHTML = ''" class="rounded-md bg-[#E5E7EB] px-4 py-2">Close</button>
                            </div>
                        </div>
                    </div>
                `;
            }

            function showEditModal(booking) {
                const root = document.getElementById('modalRoot');
                root.innerHTML = `
                    <div class="fixed inset-0 z-50 flex items-start justify-center pt-12">
                        <div class="absolute inset-0 bg-black/40"></div>
                        <div class="relative z-10 w-11/12 max-w-3xl rounded-xl bg-white p-6 shadow-lg">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-semibold">Edit Booking #${booking.id}</h3>
                                <button onclick="document.getElementById('modalRoot').innerHTML = ''" class="text-[#6B7280] hover:text-[#111827]">✕</button>
                            </div>

                            <div class="mt-4 grid grid-cols-1 gap-6 md:grid-cols-2">
                                <form id="editForm" class="space-y-3">
                                    <div>
                                        <label class="block text-sm text-[#6B7280]">Status</label>
                                        <select name="status" class="mt-1 w-full rounded border p-2">
                                            <option value="upcoming" ${booking.status === 'upcoming' ? 'selected' : ''}>upcoming</option>
                                            <option value="completed" ${booking.status === 'completed' ? 'selected' : ''}>completed</option>
                                            <option value="cancelled" ${booking.status === 'cancelled' ? 'selected' : ''}>cancelled</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm text-[#6B7280]">Note (saved to history)</label>
                                        <textarea name="note" class="mt-1 w-full rounded border p-2" rows="4"></textarea>
                                    </div>
                                    <div class="flex justify-end gap-2">
                                        <button type="button" onclick="document.getElementById('modalRoot').innerHTML = ''" class="rounded-md bg-[#F3F4F6] px-4 py-2">Cancel</button>
                                        <button type="submit" class="rounded-md bg-[#10B981] text-white px-4 py-2">Save changes</button>
                                    </div>
                                </form>

                                <div>
                                    <h4 class="font-semibold">Edit History</h4>
                                    <div id="historyList" class="mt-2 text-sm text-[#5C4033]/80">Loading...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                const form = document.getElementById('editForm');
                form.addEventListener('submit', async function (e) {
                    e.preventDefault();
                    const fd = new FormData(form);
                    const payload = {status: fd.get('status'), note: fd.get('note')};
                    const res = await fetchJson('/dashboard/bookings/' + booking.id, {method: 'PUT', body: JSON.stringify(payload)});
                    if (res.booking) {
                        window.location.reload();
                    } else {
                        alert('Failed to save');
                    }
                });

                // load history
                (async function () {
                    const hist = await fetchJson('/dashboard/bookings/' + booking.id + '/history');
                    const el = document.getElementById('historyList');
                    if (!hist.history || hist.history.length === 0) {
                        el.innerText = 'No edits yet.';
                        return;
                    }
                    el.innerHTML = hist.history.map(h => `<div class="mb-2 border-b pb-2"><div class="text-xs font-semibold">${h.admin?.first_name ?? 'Admin'} — ${new Date(h.created_at).toLocaleString()}</div><div class="text-xs text-[#5C4033]/80">${JSON.stringify(h.changes)}</div></div>`).join('');
                })();
            }

            // View switches
            document.addEventListener('DOMContentLoaded', function () {
                const listBtn = document.getElementById('listViewBtn');
                const cardBtn = document.getElementById('cardViewBtn');
                const calBtn = document.getElementById('calendarViewBtn');
                const listView = document.getElementById('listView');
                const cardView = document.getElementById('cardView');
                const calendarView = document.getElementById('calendarView');

                let fcInitialized = false;
                let fcCalendar = null;

                function renderFullCalendar() {
                    if (fcInitialized) return;
                    fcInitialized = true;
                    const calendarEl = document.getElementById('calendar');
                    if (!calendarEl) return;
                    const eventsData = JSON.parse(calendarEl.getAttribute('data-events') || '[]');
                    const script = document.createElement('script');
                    script.src = 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js';
                    script.onload = function () {
                        const calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            height: 650,
                            events: eventsData,
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            eventClick: function(info) {
                                const id = info.event.id;
                                fetchJson('/dashboard/bookings/' + id).then(data => showViewModal(data.booking));
                            }
                        });
                        calendar.render();
                        fcCalendar = calendar;
                    };
                    document.body.appendChild(script);
                }

                function showView(view) {
                    listView.classList.toggle('hidden', view !== 'list');
                    cardView.classList.toggle('hidden', view !== 'cards');
                    calendarView.classList.toggle('hidden', view !== 'calendar');
                    [listBtn, cardBtn, calBtn].forEach(b => b.classList.remove('font-semibold'));
                    if (view === 'list') listBtn.classList.add('font-semibold');
                    if (view === 'cards') cardBtn.classList.add('font-semibold');
                    if (view === 'calendar') calBtn.classList.add('font-semibold');
                    if (view === 'calendar') {
                        renderFullCalendar();
                        setTimeout(() => fcCalendar?.render?.(), 100);
                    }
                }

                listBtn.addEventListener('click', () => showView('list'));
                cardBtn.addEventListener('click', () => showView('cards'));
                calBtn.addEventListener('click', () => showView('calendar'));

                showView('list');
            });

            // Sidebar toggle + logout (copied from dashboard to ensure parity)
            document.addEventListener('DOMContentLoaded', function () {
                const sidebar = document.getElementById('adminSidebar');
                const content = document.getElementById('dashboardContent');
                const toggle = document.getElementById('sidebarToggle');
                const logoutBtn = document.getElementById('logoutBtn');
                const sidebarTextItems = sidebar ? sidebar.querySelectorAll('.sidebar-text') : [];
                const sidebarLinks = sidebar ? sidebar.querySelectorAll('.sidebar-link') : [];

                let minimized = false;

                function updateSidebarState() {
                    if (!sidebar || !content) {
                        return;
                    }

                    sidebar.classList.toggle('w-64', !minimized);
                    sidebar.classList.toggle('w-16', minimized);
                    sidebar.classList.toggle('px-4', !minimized);
                    sidebar.classList.toggle('px-3', minimized);

                    sidebarTextItems.forEach(function (item) {
                        item.classList.toggle('hidden', minimized);
                    });
                    if (logoutBtn) {
                        logoutBtn.classList.toggle('w-full', !minimized);
                        logoutBtn.classList.toggle('w-12', minimized);
                        logoutBtn.classList.toggle('h-12', minimized);
                        logoutBtn.classList.toggle('rounded-full', !minimized);
                        logoutBtn.classList.toggle('rounded-2xl', minimized);
                        logoutBtn.classList.toggle('gap-3', !minimized);
                        logoutBtn.classList.toggle('gap-0', minimized);
                        logoutBtn.classList.toggle('px-3', !minimized);
                        logoutBtn.classList.toggle('px-0', minimized);
                        logoutBtn.classList.toggle('py-2', !minimized);
                        logoutBtn.classList.toggle('py-0', minimized);
                        logoutBtn.classList.toggle('justify-center', minimized);
                        logoutBtn.classList.toggle('mx-auto', minimized);
                    }
                    sidebarLinks.forEach(function (link) {
                        const isActive = link.getAttribute('aria-current') === 'page';
                        link.classList.toggle('justify-start', !minimized);
                        link.classList.toggle('justify-center', minimized);
                        link.classList.toggle('gap-3', !minimized);
                        link.classList.toggle('gap-0', minimized);
                        
                        if (isActive) {
                            link.classList.toggle('px-2', !minimized);
                            link.classList.toggle('py-1.5', !minimized);
                        } else {
                            link.classList.toggle('px-3', !minimized);
                            link.classList.toggle('py-1', !minimized);
                        }
                        link.classList.toggle('px-0', minimized);
                        link.classList.toggle('py-0', minimized);
                        
                        link.classList.toggle('w-full', !minimized);
                        link.classList.toggle('w-10', minimized);
                        link.classList.toggle('h-10', minimized);
                        link.classList.toggle('mx-auto', minimized);
                        if (isActive) {
                            link.classList.toggle('rounded-lg', !minimized);
                            link.classList.toggle('rounded-2xl', minimized);
                        } else {
                            link.classList.toggle('rounded-full', !minimized);
                            link.classList.toggle('rounded-2xl', minimized);
                        }
                        link.classList.toggle('bg-white', isActive);
                        link.classList.toggle('text-white', !isActive);
                    });

                    content.style.paddingLeft = minimized ? '3.5rem' : '16rem';
                    toggle?.setAttribute('aria-expanded', String(!minimized));
                }

                toggle?.addEventListener('click', function () {
                    minimized = !minimized;
                    updateSidebarState();
                });

                updateSidebarState();

                logoutBtn?.addEventListener('click', async function () {
                    try {
                        const response = await fetch('/api/logout', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                Accept: 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                        });
                        if (response.ok) {
                            window.location.href = '/';
                        }
                    } catch (error) {
                        console.error(error);
                    }
                });
            });
        </script>
    @endpush
@endsection
