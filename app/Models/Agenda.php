<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'event_date' => 'date',
        'event_end_date' => 'date',
        'is_upcoming' => 'boolean',
        'published_at' => 'datetime',
        'verified_at' => 'datetime',
    ];
}
