<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'reviewer_name',
        'rating',
        'body',
        'show_on_carousel',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'show_on_carousel' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function guestReviewerName(): string
    {
        return 'Guest_'.now()->format('Y-m-d_H-i-s');
    }

    public static function carouselQuery()
    {
        return static::query()
            ->where('show_on_carousel', true)
            ->where('rating', '>=', 4)
            ->latest();
    }
}
