<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'archery_class_id',
        'class_session_id',
        'status',
        'booked_at',
    ];

    protected function casts(): array
    {
        return [
            'booked_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function archeryClass(): BelongsTo
    {
        return $this->belongsTo(ArcheryClass::class);
    }

    public function classSession(): BelongsTo
    {
        return $this->belongsTo(ClassSession::class);
    }

    public function isUpcoming(): bool
    {
        return $this->status === 'upcoming'
            && $this->classSession?->starts_at?->isFuture();
    }

    public function isCompleted(): bool
    {
        if ($this->status === 'completed') {
            return true;
        }

        return $this->status === 'upcoming'
            && $this->classSession?->starts_at?->isPast();
    }

    public function displayStatus(): string
    {
        if ($this->status === 'cancelled') {
            return 'cancelled';
        }

        if ($this->isCompleted()) {
            return 'completed';
        }

        return 'upcoming';
    }
}
