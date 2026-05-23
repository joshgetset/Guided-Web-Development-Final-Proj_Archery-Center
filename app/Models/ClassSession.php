<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassSession extends Model
{
    protected $fillable = [
        'archery_class_id',
        'starts_at',
        'spots_available',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
        ];
    }

    public function archeryClass(): BelongsTo
    {
        return $this->belongsTo(ArcheryClass::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function remainingSpots(): int
    {
        $booked = $this->bookings()
            ->whereIn('status', ['upcoming', 'completed'])
            ->count();

        return max(0, $this->spots_available - $booked);
    }
}
