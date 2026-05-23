<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        $user = Auth::user();
        $showOnCarousel = $validated['rating'] >= 4;

        $review = Review::query()->create([
            'user_id' => $user?->id,
            'reviewer_name' => $user?->name ?? Review::guestReviewerName(),
            'rating' => $validated['rating'],
            'body' => $validated['comment'],
            'show_on_carousel' => $showOnCarousel,
        ]);

        $message = 'Thank you for your review. We appreciate your feedback.';

        return response()->json([
            'success' => true,
            'message' => $message,
            'review' => [
                'id' => $review->id,
                'reviewer_name' => $review->reviewer_name,
                'rating' => $review->rating,
                'body' => $review->body,
                'show_on_carousel' => $review->show_on_carousel,
                'created_at' => $review->created_at?->format('M j, Y'),
            ],
        ]);
    }
}
