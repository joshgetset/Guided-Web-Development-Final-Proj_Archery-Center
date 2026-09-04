<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingHistory;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if (! $user || ! $user->is_admin) {
            abort(403);
        }

        $bookings = Booking::with(['user', 'archeryClass', 'classSession'])
            ->latest('booked_at')
            ->get();

        return view('bookings', [
            'activePage' => 'bookings',
            'user' => $user,
            'bookings' => $bookings,
        ]);
    }

    public function show(Request $request, Booking $booking)
    {
        $user = $request->user();
        if (! $user || ! $user->is_admin) {
            abort(403);
        }

        $booking->load(['user', 'archeryClass', 'classSession']);

        return response()->json(['booking' => $booking]);
    }

    public function history(Request $request, Booking $booking)
    {
        $user = $request->user();
        if (! $user || ! $user->is_admin) {
            abort(403);
        }

        $history = BookingHistory::where('booking_id', $booking->id)
            ->with('admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['history' => $history]);
    }

    public function update(Request $request, Booking $booking)
    {
        $user = $request->user();
        if (! $user || ! $user->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'status' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $changes = [];
        if (isset($validated['status']) && $validated['status'] !== $booking->status) {
            $changes['status'] = ['from' => $booking->status, 'to' => $validated['status']];
            $booking->status = $validated['status'];
        }

        if (! empty($validated['note'])) {
            $changes['note'] = $validated['note'];
        }

        if (! empty($changes)) {
            $booking->save();

            BookingHistory::create([
                'booking_id' => $booking->id,
                'admin_id' => $user->id,
                'changes' => json_encode($changes),
            ]);
        }

        $booking->load(['user', 'archeryClass', 'classSession']);

        return response()->json(['booking' => $booking]);
    }

    public function cancel(Request $request, Booking $booking)
    {
        $user = $request->user();
        if (! $user || ! $user->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($booking->status === 'cancelled') {
            return response()->json(['message' => 'Already cancelled'], 422);
        }

        $old = $booking->status;
        $booking->status = 'cancelled';
        $booking->save();

        BookingHistory::create([
            'booking_id' => $booking->id,
            'admin_id' => $user->id,
            'changes' => json_encode(['status' => ['from' => $old, 'to' => 'cancelled']]),
        ]);

        $booking->load(['user', 'archeryClass', 'classSession']);

        return response()->json(['booking' => $booking]);
    }
}
