<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturer extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'matkul' => 'array',
        'sertifikasi' => 'array',
        'verified_at' => 'datetime',
    ];
}
