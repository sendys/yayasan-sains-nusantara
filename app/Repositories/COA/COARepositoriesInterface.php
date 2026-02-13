<?php

namespace App\Repositories\COA;

use App\Models\ChartOfAccount as COA;
use Illuminate\Support\Collection;

interface COARepositoriesInterface
{
    public function all(): Collection;

    public function Paginated(int $perPage = 15);

    public function paginatedBySort(array $params = [], int $perPage = 15);

    public function find(int $id): ?COA;

    public function create(array $data): COA;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function softDelete(int $id): bool;

    public function restore(int $id): bool;
}
