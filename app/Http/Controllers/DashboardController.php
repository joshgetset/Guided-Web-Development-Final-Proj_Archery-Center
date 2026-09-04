<?php

namespace App\Http\Controllers;

use App\Models\ArcheryClass;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (! $user || ! $user->is_admin) {
            abort(403);
        }

        $totalUsers = User::count();

        $recentBookings = Booking::with(['user', 'archeryClass', 'classSession'])
            ->latest('booked_at')
            ->take(6)
            ->get();

        $classes = ArcheryClass::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('dashboard', [
            'activePage' => 'dashboard',
            'user' => $user,
            'totalUsers' => $totalUsers,
            'recentBookings' => $recentBookings,
            'classes' => $classes,
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if (! $user || ! $user->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:255', 'unique:archery_classes,slug'],
            'badge' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string'],
            'full_description' => ['required', 'string'],
            'prerequisites' => ['required', 'string'],
            'price_label' => ['required', 'string', 'max:100'],
            'price_cents' => ['nullable', 'integer', 'min:0'],
            'duration_minutes' => ['nullable', 'integer', 'min:15'],
            'cta_text' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        ArcheryClass::create([
            'slug' => $validated['slug'],
            'badge' => $validated['badge'],
            'name' => $validated['name'],
            'short_description' => $validated['short_description'],
            'full_description' => $validated['full_description'],
            'prerequisites' => $validated['prerequisites'],
            'price_label' => $validated['price_label'],
            'price_cents' => $validated['price_cents'] ?? 0,
            'duration_minutes' => $validated['duration_minutes'] ?? 60,
            'cta_text' => $validated['cta_text'] ?? 'View Class',
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ]);

        return redirect('/dashboard#classes');
    }
}
