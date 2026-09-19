<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicCurriculum extends Model
{
    protected $table = 'academic_curricula';
    protected $guarded = ['id'];

    protected $casts = [
        'cpl_mapping' => 'array',
        'instructors' => 'array',
        'source_published_at' => 'date',
        'verified_at' => 'datetime',
    ];
}
