<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $table = 'researches';
    protected $guarded = ['id'];

    protected $casts = [
        'source_published_at' => 'date',
        'verified_at' => 'datetime',
    ];
}
