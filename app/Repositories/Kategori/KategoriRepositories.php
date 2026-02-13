<?php

namespace App\Repositories\Kategori;

use App\Models\Kategori;
use Illuminate\Support\Collection;

class KategoriRepositories implements KategoriRepositoriesInterface
{
    public function all(): Collection
    {
        return Kategori::all();
    }

    public function Paginated(int $perPage = 15)
    {
        return Kategori::paginate($perPage);
    }

    public function paginatedBySort(array $params = [], int $perPage = 10)
    {
        $query = Kategori::query();

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

    public function find(int $id): ?Kategori
    {
        return Kategori::findOrFail($id);
    }

    public function findByUuid(string $uuid): ?Kategori
    {
        return Kategori::where('uuid', $uuid)->first();
    }

    public function create(array $data): Kategori
    {
        return Kategori::create($data);
    }

    public function update(string $uuid, array $data): bool
    {
        $kategori = Kategori::where('uuid', $uuid)->firstOrFail();

        return $kategori->update($data);
    }

    public function delete(int $id): bool
    {
        $kategori = Kategori::findOrFail($id);

        return $kategori->delete();
    }

    public function softDelete(int $id): bool
    {
        $kategori = Kategori::findOrFail($id);

        return $kategori->delete(); // This will soft delete when SoftDeletes trait is used
    }
}
