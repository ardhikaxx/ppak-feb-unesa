<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
        'source_published_at' => 'date',
        'verified_at' => 'datetime',
    ];
}
