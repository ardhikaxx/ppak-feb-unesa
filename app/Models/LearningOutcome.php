<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningOutcome extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'source_published_at' => 'date',
        'verified_at' => 'datetime',
    ];
}
