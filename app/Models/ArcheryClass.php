<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArcheryClass extends Model
{
    protected $fillable = [
        'slug',
        'badge',
        'name',
        'short_description',
        'full_description',
        'prerequisites',
        'price_label',
        'price_cents',
        'image_url',
        'gallery',
        'duration_minutes',
        'cta_text',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(ClassSession::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function upcomingSessions(): HasMany
    {
        return $this->sessions()
            ->where('starts_at', '>', now())
            ->orderBy('starts_at');
    }
}
