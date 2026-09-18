<?php

namespace App\Support;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Scalable array pagination - allows static PHP arrays to behave like Eloquent pagination.
 * When DB is introduced, simply replace with Eloquent paginate() without changing Blade.
 * Prevents Model::all() for large datasets.
 */
final class ArrayPaginator
{
    /**
     * @param array $items
     * @param int $perPage
     * @param int|null $currentPage
     * @param array $options
     */
    public static function paginate(array $items, int $perPage = 9, ?int $currentPage = null, array $options = []): LengthAwarePaginator
    {
        $currentPage = $currentPage ?: LengthAwarePaginator::resolveCurrentPage();
        $collection = Collection::make($items);
        $currentItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginator = new LengthAwarePaginator(
            $currentItems,
            $collection->count(),
            $perPage,
            $currentPage,
            array_merge(['path' => LengthAwarePaginator::resolveCurrentPath()], $options)
        );

        // Preserve query string for filters/search
        return $paginator->withQueryString();
    }

    /**
     * Lazy chunk for very large datasets (e.g., export, sitemap).
     * Wraps PHP array chunking to mimic Eloquent chunk().
     */
    public static function chunk(array $items, int $size, callable $callback): void
    {
        foreach (array_chunk($items, $size, true) as $chunk) {
            if ($callback($chunk) === false) {
                break;
            }
        }
    }
}
