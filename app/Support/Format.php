<?php

namespace App\Support;

/**
 * Utilitas format angka/ukuran untuk tampilan.
 */
final class Format
{
    /**
     * Format ukuran file gaya dokumen resmi: basis 1000, KB desimal
     * 1 angka, MB desimal 2 angkat, dipotong (truncate) seperti data awal.
     */
    public static function bytes(int $bytes): string
    {
        if ($bytes >= 1000000) {
            return number_format(floor($bytes / 1000000 * 100) / 100, 2, '.', '').' MB';
        }

        return number_format(floor($bytes / 1000 * 10) / 10, 1, '.', '').' KB';
    }
}
