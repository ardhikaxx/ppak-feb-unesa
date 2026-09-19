<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityService extends Model
{
    protected $table = 'community_services';
    protected $guarded = ['id'];

    protected $casts = [
        'source_published_at' => 'date',
        'verified_at' => 'datetime',
    ];
}
