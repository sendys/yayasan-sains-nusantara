<?php

namespace App\Repositories\Supplier;

use App\Models\Supplier;
use Illuminate\Support\Collection;

interface SupplierRepositoriesInterface
{
    public function all(): Collection;

    public function Paginated(int $perPage = 15);

    public function paginatedBySort(array $params = [], int $perPage = 10);

    public function findByUuid(string $uuid): ?Supplier;

    public function find(int $id): ?Supplier;

    public function create(array $data): Supplier;

    public function update(string $uuid, array $data): bool;

    public function delete(int $id): bool;

    public function softDelete(int $id): bool;

    public function restore(int $id): bool;
}
