<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AdmissionSchedule extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'verification_date' => 'date',
        'exam_date' => 'date',
        'announcement_date' => 'date',
        'registration_deadline' => 'date',
        'course_start_date' => 'date',
        'source_published_at' => 'date',
        'verified_at' => 'datetime',
    ];

    public function isPast(): bool
    {
        return $this->end_date && $this->end_date->isPast();
    }

    public function isCurrent(): bool
    {
        $now = Carbon::now();
        return $this->start_date && $this->end_date && $now->between($this->start_date, $this->end_date);
    }
}
