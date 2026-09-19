<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniRecord extends Model
{
    protected $table = 'alumni_records';
    protected $guarded = ['id'];

    protected $casts = [
        'source_published_at' => 'date',
        'verified_at' => 'datetime',
    ];
}
