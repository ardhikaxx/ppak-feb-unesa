<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'verified_at' => 'datetime',
    ];
}
