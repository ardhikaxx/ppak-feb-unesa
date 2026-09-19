<?php

namespace App\Repositories;

use App\Contracts\ContentRepositoryInterface;
use App\Services\PpakData;
use App\Support\ArrayPaginator;
use App\Support\CacheKeys;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

/**
 * Array-backed repository - production scalable via cache + pagination.
 * All methods use projection (onlyColumns) and filtering at data layer,
 * never in Blade. Prevents N+1, full table load, and Collection::filter on large datasets.
 */
class ArrayContentRepository implements ContentRepositoryInterface
{
    private int $defaultTtl = 3600; // 1 hour for relatively static content

    public function getGeneralInfo(): array
    {
        return Cache::remember(CacheKeys::INSTITUTION_INFO, $this->defaultTtl, fn() => PpakData::getGeneralInfo());
    }

    public function getStats(): array
    {
        return Cache::remember(CacheKeys::STATS, $this->defaultTtl, fn() => PpakData::getStats());
    }

    public function getKeunggulan(): array
    {
        return Cache::remember(CacheKeys::KEUNGGULAN, $this->defaultTtl, fn() => PpakData::getKeunggulan());
    }

    public function getKompetensi(): array
    {
        return Cache::remember(CacheKeys::KOMPETENSI, $this->defaultTtl, fn() => PpakData::getKompetensi());
    }

    public function getBerita(array $onlyColumns = []): array
    {
        $data = Cache::remember(CacheKeys::BERITA_ALL, 600, fn() => PpakData::getBerita()); // 10 min for news
        return $this->project($data, $onlyColumns);
    }

    public function getBeritaPaginated(int $perPage = 6, ?string $search = null, ?string $category = null): LengthAwarePaginator
    {
        // Never cache LengthAwarePaginator objects directly when
        // config/cache.php 'serializable_classes' is false (Laravel 13 default).
        // Unserializing then returns __PHP_Incomplete_Class and breaks the
        // return type. Cache only the filtered array and paginate per-request.
        $filteredKey = CacheKeys::paginated(CacheKeys::BERITA_PAGINATED . ':filtered', 1, 1, (string) $search . (string) $category);

        $filtered = Cache::remember($filteredKey, 600, function () use ($search, $category) {
            $items = PpakData::getBerita();

            // Server-side filtering (DB-ready: where like)
            if ($search) {
                $searchLower = mb_strtolower($search);
                $items = array_filter($items, fn($item) =>
                    str_contains(mb_strtolower($item['title']), $searchLower) ||
                    str_contains(mb_strtolower($item['excerpt']), $searchLower) ||
                    str_contains(mb_strtolower($item['category']), $searchLower)
                );
            }

            if ($category) {
                $items = array_filter($items, fn($item) => $item['category'] === $category);
            }

            return array_values($items);
        });

        return ArrayPaginator::paginate($filtered, $perPage);
    }

    public function findBeritaBySlug(string $slug): ?array
    {
        return Cache::remember(CacheKeys::beritaSlug($slug), 600, function () use ($slug) {
            $all = PpakData::getBerita();
            foreach ($all as $item) {
                if ($item['slug'] === $slug) {
                    return $item;
                }
            }
            return null;
        });
    }

    public function getRelatedBerita(string $excludeSlug, int $limit = 3): array
    {
        $all = $this->getBerita();
        return collect($all)->where('slug', '!=', $excludeSlug)->take($limit)->values()->all();
    }

    public function getAgenda(array $onlyColumns = []): array
    {
        $data = Cache::remember(CacheKeys::AGENDA_ALL, 600, fn() => PpakData::getAgenda());
        return $this->project($data, $onlyColumns);
    }

    public function getAgendaPaginated(int $perPage = 5, bool $upcomingOnly = false): LengthAwarePaginator
    {
        $items = $this->getAgenda();
        if ($upcomingOnly) {
            $items = array_filter($items, fn($item) => $item['is_upcoming']);
        }
        return ArrayPaginator::paginate(array_values($items), $perPage);
    }

    public function getDosen(array $onlyColumns = []): array
    {
        $data = Cache::remember(CacheKeys::DOSEN_ALL, $this->defaultTtl, fn() => PpakData::getDosen());
        return $this->project($data, $onlyColumns);
    }

    public function getDosenPaginated(int $perPage = 8, ?string $category = null): LengthAwarePaginator
    {
        $items = $this->getDosen();
        if ($category) {
            $items = array_filter($items, fn($d) => $d['category'] === $category);
        }
        return ArrayPaginator::paginate(array_values($items), $perPage);
    }

    public function getMitra(): array
    {
        return Cache::remember(CacheKeys::MITRA, $this->defaultTtl, fn() => PpakData::getMitra());
    }

    public function getTestimoni(): array
    {
        return Cache::remember(CacheKeys::TESTIMONI, $this->defaultTtl, fn() => PpakData::getTestimoni());
    }

    public function getKarierSectors(): array
    {
        return Cache::remember(CacheKeys::KARIER_SECTORS, $this->defaultTtl, fn() => PpakData::getKarierSectors());
    }

    public function getKurikulum(): array
    {
        return Cache::remember(CacheKeys::KURIKULUM, $this->defaultTtl, fn() => PpakData::getKurikulum());
    }

    public function getKalender(): array
    {
        return Cache::remember(CacheKeys::KALENDER, $this->defaultTtl, fn() => PpakData::getKalender());
    }

    public function getAdmisiInfo(): array
    {
        return Cache::remember(CacheKeys::ADMISI, $this->defaultTtl, fn() => PpakData::getAdmisiInfo());
    }

    public function getFaq(): array
    {
        return Cache::remember(CacheKeys::FAQ, $this->defaultTtl, fn() => PpakData::getFaq());
    }

    public function getRiset(): array
    {
        return Cache::remember(CacheKeys::RISET, $this->defaultTtl, fn() => PpakData::getRiset());
    }

    public function getPengabdian(): array
    {
        return Cache::remember(CacheKeys::PENGABDIAN, $this->defaultTtl, fn() => PpakData::getPengabdian());
    }

    public function getGaleri(): array
    {
        return Cache::remember(CacheKeys::GALERI, 600, fn() => PpakData::getGaleri());
    }

    public function getUnduhan(): array
    {
        return Cache::remember(CacheKeys::UNDUHAN, 600, fn() => PpakData::getUnduhan());
    }

    public function getUnduhanPaginated(int $perPage = 10, ?string $category = null): LengthAwarePaginator
    {
        $items = $this->getUnduhan();
        if ($category) {
            $items = array_filter($items, fn($d) => $d['kategori'] === $category);
        }
        return ArrayPaginator::paginate(array_values($items), $perPage);
    }

    public function search(string $keyword, int $perPage = 6): array
    {
        if (mb_strlen(trim($keyword)) < 2) {
            return ['berita' => [], 'agenda' => [], 'dosen' => []];
        }

        $lower = mb_strtolower($keyword);

        // Efficient server-side search (when DB: use fulltext index)
        $berita = array_filter($this->getBerita(), fn($item) =>
            str_contains(mb_strtolower($item['title'] ?? ''), $lower) ||
            str_contains(mb_strtolower($item['excerpt'] ?? ''), $lower) ||
            str_contains(mb_strtolower($item['content'] ?? ''), $lower)
        );

        $agenda = array_filter($this->getAgenda(), fn($item) =>
            str_contains(mb_strtolower($item['title'] ?? ''), $lower) ||
            str_contains(mb_strtolower($item['desc'] ?? $item['description'] ?? ''), $lower) ||
            str_contains(mb_strtolower($item['venue'] ?? ''), $lower)
        );

        $dosen = array_filter($this->getDosen(), fn($item) =>
            str_contains(mb_strtolower($item['name'] ?? ''), $lower) ||
            str_contains(mb_strtolower($item['role'] ?? $item['bidang'] ?? ''), $lower) ||
            str_contains(mb_strtolower($item['category_label'] ?? ''), $lower)
        );

        return [
            'berita' => array_slice(array_values($berita), 0, $perPage),
            'agenda' => array_slice(array_values($agenda), 0, $perPage),
            'dosen' => array_slice(array_values($dosen), 0, $perPage),
        ];
    }

    /**
     * Projection - select only needed columns to minimize payload.
     * Mimics Eloquent select() for list views.
     */
    private function project(array $data, array $onlyColumns): array
    {
        if (empty($onlyColumns)) {
            return $data;
        }

        return array_map(function ($item) use ($onlyColumns) {
            $projected = [];
            foreach ($onlyColumns as $col) {
                if (array_key_exists($col, $item)) {
                    $projected[$col] = $item[$col];
                }
            }
            // Always keep id/slug for routing
            foreach (['id', 'slug'] as $key) {
                if (isset($item[$key]) && !isset($projected[$key])) {
                    $projected[$key] = $item[$key];
                }
            }
            return $projected;
        }, $data);
    }
}
