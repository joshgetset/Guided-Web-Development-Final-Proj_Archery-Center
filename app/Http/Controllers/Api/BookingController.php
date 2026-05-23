<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ClassSession;
use App\Support\SiteImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['bookings' => null]);
        }

        $bookings = $user->bookings()
            ->with(['archeryClass', 'classSession'])
            ->latest('booked_at')
            ->get()
            ->map(fn (Booking $booking) => $this->formatBooking($booking));

        $grouped = [
            'upcoming' => $bookings->filter(fn ($b) => $b['display_status'] === 'upcoming')->values(),
            'completed' => $bookings->filter(fn ($b) => $b['display_status'] === 'completed')->values(),
            'cancelled' => $bookings->filter(fn ($b) => $b['display_status'] === 'cancelled')->values(),
        ];

        return response()->json(['bookings' => $grouped]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();

        if (! $user) {
            return response()->json(['message' => 'Please sign in to book a class.'], 401);
        }

        $validated = $request->validate([
            'class_session_id' => ['required', 'exists:class_sessions,id'],
        ]);

        $session = ClassSession::with('archeryClass')
            ->where('starts_at', '>', now())
            ->findOrFail($validated['class_session_id']);

        if ($session->remainingSpots() < 1) {
            return response()->json(['message' => 'This session is fully booked. Please choose another date.'], 422);
        }

        $existing = Booking::query()
            ->where('user_id', $user->id)
            ->where('class_session_id', $session->id)
            ->whereIn('status', ['upcoming', 'completed'])
            ->exists();

        if ($existing) {
            return response()->json(['message' => 'You are already booked for this session.'], 422);
        }

        $booking = Booking::create([
            'user_id' => $user->id,
            'archery_class_id' => $session->archery_class_id,
            'class_session_id' => $session->id,
            'status' => 'upcoming',
            'booked_at' => now(),
        ]);

        $booking->load(['archeryClass', 'classSession']);

        return response()->json([
            'message' => 'Your class has been booked successfully!',
            'booking' => $this->formatBooking($booking),
        ], 201);
    }

    public function cancel(Request $request, Booking $booking): JsonResponse
    {
        $user = $request->user();

        if (! $user || $booking->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        if ($booking->status === 'cancelled') {
            return response()->json(['message' => 'This booking is already cancelled.'], 422);
        }

        if (! $booking->isUpcoming()) {
            return response()->json(['message' => 'Only upcoming classes can be cancelled.'], 422);
        }

        $booking->update(['status' => 'cancelled']);
        $booking->load(['archeryClass', 'classSession']);

        return response()->json([
            'message' => 'Your booking has been cancelled.',
            'booking' => $this->formatBooking($booking),
        ]);
    }

    private function formatBooking(Booking $booking): array
    {
        $session = $booking->classSession;
        $class = $booking->archeryClass;
        $displayStatus = $booking->displayStatus();

        return [
            'id' => $booking->id,
            'status' => $booking->status,
            'display_status' => $displayStatus,
            'can_cancel' => $booking->isUpcoming(),
            'booked_at' => $booking->booked_at->toIso8601String(),
            'booked_at_label' => $booking->booked_at->format('M j, Y'),
            'session_starts_at' => $session?->starts_at?->toIso8601String(),
            'session_starts_at_label' => $session?->starts_at?->format('l, M j · g:i A') ?? '—',
            'class' => [
                'id' => $class?->id,
                'name' => $class?->name,
                'badge' => $class?->badge,
                'price_label' => $class?->price_label,
                'image_url' => $class ? (SiteImage::classCardImage($class->slug) ?? SiteImage::classGallery($class->slug)[0] ?? null) : null,
                'is_emoji_card' => $class ? SiteImage::classCardImage($class->slug) === null : true,
            ],
        ];
    }
}
