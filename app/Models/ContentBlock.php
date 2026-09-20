<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentBlock extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'meta' => 'array',
    ];

    public const GROUPS = [
        'karier' => 'Bidang Karier (Beranda & Testimoni)',
        'tahapan' => 'Tahapan Pendaftaran (Beranda & Admisi)',
        'persyaratan' => 'Persyaratan Pendaftaran (Admisi)',
    ];

    public function scopeOfGroup($query, string $group)
    {
        return $query->where('group', $group);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
