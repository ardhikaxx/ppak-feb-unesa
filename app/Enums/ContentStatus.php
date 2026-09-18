<?php

namespace App\Enums;

/**
 * Content lifecycle status - scalable publishing workflow.
 * Avoid boolean soup (is_active, is_publish, etc). Use single enum.
 */
enum ContentStatus: string
{
    case Draft = 'draft';
    case Scheduled = 'scheduled';
    case Published = 'published';
    case Archived = 'archived';
    case Unpublished = 'unpublished';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Scheduled => 'Terjadwal',
            self::Published => 'Terbit',
            self::Archived => 'Diarsipkan',
            self::Unpublished => 'Tidak Terbit',
        };
    }

    public function isPubliclyVisible(): bool
    {
        return $this === self::Published;
    }
}
