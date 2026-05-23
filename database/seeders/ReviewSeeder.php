<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'reviewer_name' => 'Nia Everett',
                'rating' => 5,
                'body' => 'The instructors made me feel confident from day one. The energy is warm and the facilities feel premium.',
            ],
            [
                'reviewer_name' => 'Liam Porter',
                'rating' => 5,
                'body' => 'Perfect for our company outing. Great coaching, great setup, and a truly memorable session.',
            ],
            [
                'reviewer_name' => 'Maya Chen',
                'rating' => 5,
                'body' => 'Modern gear, strong safety measures, and friendly instructors — exactly what I wanted.',
            ],
            [
                'reviewer_name' => 'Rico Santos',
                'rating' => 5,
                'body' => 'A relaxed, polished archery experience with every detail handled perfectly.',
            ],
        ];

        foreach ($reviews as $review) {
            Review::query()->firstOrCreate(
                ['reviewer_name' => $review['reviewer_name'], 'body' => $review['body']],
                [
                    'rating' => $review['rating'],
                    'show_on_carousel' => $review['rating'] >= 4,
                ],
            );
        }
    }
}
