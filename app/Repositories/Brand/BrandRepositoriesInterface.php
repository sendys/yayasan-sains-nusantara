<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use Illuminate\Support\Collection;

interface BrandRepositoriesInterface
{
    public function all(): Collection;

    public function paginated(int $perPage = 15): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    public function paginatedBySort(array $params = [], int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    public function findByUuid(string $uuid): ?Brand;

    public function find(int $id): ?Brand;

    public function create(array $data): Brand;

    public function update(string $uuid, array $data): bool;

    public function delete(int $id): bool;

    public function softDelete(int $id): bool;

    public function restore(int $id): bool;

    public function getTrashed(int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    public function forceDelete(int $id): bool;
}
