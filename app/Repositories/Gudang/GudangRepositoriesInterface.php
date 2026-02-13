<?php

namespace App\Repositories\Gudang;

use App\Models\Gudang;
use Illuminate\Support\Collection;

interface GudangRepositoriesInterface
{
    public function all(): Collection;

    public function Paginated(int $perPage = 15);

    public function paginatedBySort(array $params = [], int $perPage = 10);

    public function findByUuid(string $uuid): ?Gudang;

    public function find(int $id): ?Gudang;

    public function create(array $data): Gudang;

    public function update(string $uuid, array $data): bool;

    public function delete(int $id): bool;

    public function softDelete(int $id): bool;

    public function restore(int $id): bool;
}
