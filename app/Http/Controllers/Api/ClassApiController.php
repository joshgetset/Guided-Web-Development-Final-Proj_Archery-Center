<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ClassPageController;
use App\Http\Controllers\Controller;
use App\Models\ArcheryClass;
use Illuminate\Http\JsonResponse;

class ClassApiController extends Controller
{
    public function show(ArcheryClass $archeryClass): JsonResponse
    {
        if (! $archeryClass->is_active) {
            return response()->json(['message' => 'Class not found.'], 404);
        }

        $sessions = $archeryClass->upcomingSessions()
            ->get()
            ->map(fn ($session) => [
                'id' => $session->id,
                'starts_at' => $session->starts_at->toIso8601String(),
                'starts_at_label' => $session->starts_at->format('l, M j · g:i A'),
                'spots_remaining' => $session->remainingSpots(),
            ])
            ->filter(fn ($session) => $session['spots_remaining'] > 0)
            ->values();

        $card = ClassPageController::formatClassCard($archeryClass);

        return response()->json([
            'class' => array_merge($card, [
                'sessions' => $sessions,
            ]),
        ]);
    }
}
