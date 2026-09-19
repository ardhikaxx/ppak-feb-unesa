<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Accreditation extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'decree_date' => 'date',
        'effective_from' => 'date',
        'effective_until' => 'date',
        'source_published_at' => 'date',
        'verified_at' => 'datetime',
    ];

    public function isExpiringSoon(int $months = 6): bool
    {
        if (! $this->effective_until) {
            return false;
        }

        return $this->effective_until->isFuture() && $this->effective_until->diffInMonths(Carbon::now()) <= $months;
    }

    public function isCurrentlyActive(): bool
    {
        if (! $this->effective_until) {
            return true;
        }

        return $this->effective_until->isFuture() || $this->effective_until->isToday();
    }
}
