<?php

namespace App\Repositories\Satuan;

use App\Models\Satuan;
use Illuminate\Support\Collection;

interface SatuanRepositoriesInterface
{
    public function all(): Collection;

    public function Paginated(int $perPage = 15);

    public function paginatedBySort(array $params = [], int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    public function findByUuid(string $uuid): ?Satuan;

    public function find(int $id): ?Satuan;

    public function create(array $data): Satuan;

    public function update(string $uuid, array $data): bool;

    public function delete(string $uuid): bool;

    public function softDelete(string $uuid): bool;

    public function restore(string $uuid): bool;

    public function getTrashed(int $perPage = 10);

    public function forceDelete(string $uuid): bool;
}
