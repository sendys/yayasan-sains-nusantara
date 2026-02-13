<?php

namespace App\Repositories\Kategori;

use App\Models\Kategori;
use Illuminate\Support\Collection;

interface KategoriRepositoriesInterface
{
    public function all(): Collection;

    public function Paginated(int $perPage = 15);

    public function paginatedBySort(array $params = [], int $perPage = 10);

    public function findByUuid(string $uuid): ?Kategori;

    public function find(int $id): ?Kategori;

    public function create(array $data): Kategori;

    public function update(string $uuid, array $data): bool;

    public function delete(int $id): bool;

    public function softDelete(int $id): bool;
}
