<?php

namespace App\Support;

use Carbon\Carbon;

/**
 * Format tanggal Bahasa Indonesia untuk tampilan publik.
 * Nol di depan dipertahankan (01 September 2026) sesuai dokumen resmi.
 */
final class Tanggal
{
    private const BULAN = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    public static function indo(string|Carbon|\DateTimeInterface|null $date): string
    {
        if (! $date) {
            return '-';
        }

        $d = $date instanceof Carbon ? $date : Carbon::parse($date);

        return $d->format('d').' '.self::BULAN[$d->month].' '.$d->year;
    }

    public static function bulan(int $month): string
    {
        return self::BULAN[$month] ?? '';
    }
}
