<?php

namespace App\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Contract for content data access.
 * Current implementation: ArrayContentRepository (static PpakData).
 * Future implementation: EloquentContentRepository (database) without changing consumers.
 * Keeps presentation layer decoupled from data source.
 */
interface ContentRepositoryInterface
{
    public function getGeneralInfo(): array;

    public function getStats(): array;

    public function getKeunggulan(): array;

    public function getKompetensi(): array;

    public function getBerita(array $onlyColumns = []): array;

    public function getBeritaPaginated(int $perPage = 6, ?string $search = null, ?string $category = null): LengthAwarePaginator;

    public function findBeritaBySlug(string $slug): ?array;

    public function getRelatedBerita(string $excludeSlug, int $limit = 3): array;

    public function getAgenda(array $onlyColumns = []): array;

    public function getAgendaPaginated(int $perPage = 5, bool $upcomingOnly = false): LengthAwarePaginator;

    public function getDosen(array $onlyColumns = []): array;

    public function getDosenPaginated(int $perPage = 8, ?string $category = null): LengthAwarePaginator;

    public function getMitra(): array;

    public function getTestimoni(): array;

    public function getKarierSectors(): array;

    public function getKurikulum(): array;

    public function getKalender(): array;

    public function getAdmisiInfo(): array;

    public function getFaq(): array;

    public function getRiset(): array;

    public function getPengabdian(): array;

    public function getGaleri(): array;

    public function getUnduhan(): array;

    public function getUnduhanPaginated(int $perPage = 10, ?string $category = null): LengthAwarePaginator;

    public function search(string $keyword, int $perPage = 6): array;
}
