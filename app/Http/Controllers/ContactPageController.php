<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\View\View;

class ContactPageController extends Controller
{
    public function index(): View
    {
        $reviews = Review::query()->latest()->get();

        $ratingCounts = [];
        for ($star = 5; $star >= 1; $star--) {
            $ratingCounts[$star] = $reviews->where('rating', $star)->count();
        }

        $reviewsForJs = $reviews->map(fn (Review $review) => [
            'id' => $review->id,
            'reviewer_name' => $review->reviewer_name,
            'rating' => $review->rating,
            'body' => $review->body,
            'show_on_carousel' => $review->show_on_carousel,
            'created_at' => $review->created_at?->format('M j, Y'),
        ])->values();

        return view('contact', [
            'reviewsForJs' => $reviewsForJs,
            'ratingCounts' => $ratingCounts,
            'totalReviews' => $reviews->count(),
        ]);
    }
}
