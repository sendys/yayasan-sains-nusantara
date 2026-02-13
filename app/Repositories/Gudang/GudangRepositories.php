<?php

namespace App\Repositories\Gudang;

use App\Models\Gudang;
use Illuminate\Support\Collection;

class GudangRepositories implements GudangRepositoriesInterface
{
    public function all(): Collection
    {
        return Gudang::all();
    }

    public function Paginated(int $perPage = 15)
    {
        return Gudang::paginate($perPage);
    }

    public function paginatedBySort(array $params = [], int $perPage = 10)
    {
        $query = Gudang::query();

        if (! empty($params['search'])) {
            $search = $params['search'];
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%$search%")
                    ->orWhere('nama', 'like', "%$search%");
            });
        }

        $sortBy = $params['sort_by'] ?? 'kode';
        $sortDir = $params['sort_dir'] ?? 'asc';

        $query->orderBy($sortBy, $sortDir);

        return $query->paginate($perPage)->appends($params);
    }

    public function find(int $id): ?Gudang
    {
        return Gudang::findOrFail($id);
    }

    public function findByUuid(string $uuid): ?Gudang
    {
        return Gudang::where('uuid', $uuid)->first();
    }

    public function create(array $data): Gudang
    {
        return Gudang::create($data);
    }

    public function update(string $uuid, array $data): bool
    {
        $gudang = Gudang::where('uuid', $uuid)->firstOrFail();

        return $gudang->update($data);
    }

    public function delete(int $id): bool
    {
        $gudang = Gudang::findOrFail($id);

        return $gudang->delete();
    }

    public function softDelete(int $id): bool
    {
        $gudang = Gudang::findOrFail($id);

        return $gudang->softDelete();
    }

    public function restore(int $id): bool
    {
        $gudang = Gudang::withTrashed()->findOrFail($id);

        return $gudang->restore();
    }
}
