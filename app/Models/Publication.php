<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'publish_date' => 'date',
        'source_published_at' => 'date',
        'verified_at' => 'datetime',
    ];
}
