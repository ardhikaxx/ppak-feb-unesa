<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramProfile extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'established_date' => 'date',
        'social_links' => 'array',
        'source_published_at' => 'date',
        'verified_at' => 'datetime',
    ];

    public function isVerified(): bool
    {
        return $this->data_status === 'verified';
    }
}
