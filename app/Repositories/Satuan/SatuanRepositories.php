<?php

namespace App\Repositories\Satuan;

use App\Models\Satuan;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SatuanRepositories
{

    public function all(): Collection
    {
        return Satuan::all();
    }

    public function Paginated(int $perPage = 15)
    {
        return Satuan::paginate($perPage);
    }
    public function paginatedBySort(array $params = [], int $perPage = 10): LengthAwarePaginator
    /* public function paginatedBySort(array $params = [], int $perPage = 10) */
    {
        $query = Satuan::query();

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

    public function find(int $id): ?Satuan
    {
        return Satuan::findOrFail($id);
    }

    public function findByUuid(string $uuid): ?Satuan
    {
        return Satuan::where('uuid', $uuid)->firstOrFail();
    }

    public function create(array $data): Satuan
    {
        return Satuan::create($data);
    }

    public function update(string $uuid, array $data): bool
    {
        $satuan = Satuan::where('uuid', $uuid)->firstOrFail();

        return $satuan->update($data);
    }


    public function getTrashed(int $perPage = 10)
    {
        return Satuan::onlyTrashed()->paginate($perPage);
    }


}
