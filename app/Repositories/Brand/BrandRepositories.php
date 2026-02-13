<?php

namespace App\Repositories\Brand;

use App\Models\Brand;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BrandRepositories implements BrandRepositoriesInterface
{
    public function all(): Collection
    {
        return Brand::all();
    }

    public function paginated(int $perPage = 15): LengthAwarePaginator
    {
        return Brand::paginate($perPage);
    }

    public function paginatedBySort(array $params = [], int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Brand::query();

        // Search by nama brand
        if (! empty($params['search'])) {
            $search = $params['search'];
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('deskripsi', 'like', "%$search%");
            });
        }

        // Filter by status aktif
        if (isset($params['is_active']) && $params['is_active'] !== '') {
            $query->where('is_active', $params['is_active']);
        }

        $sortBy = $params['sort_by'] ?? 'nama';
        $sortDir = $params['sort_dir'] ?? 'asc';

        $query->orderBy($sortBy, $sortDir);

        return $query->paginate($perPage)->appends($params);
    }

    public function find(int $id): ?Brand
    {
        return Brand::findOrFail($id);
    }

    public function findByUuid(string $uuid): ?Brand
    {
        return Brand::where('uuid', $uuid)->firstOrFail();
    }

    public function create(array $data): Brand
    {
        return Brand::create($data);
    }

    public function update(string $uuid, array $data): bool
    {
        $brand = Brand::where('uuid', $uuid)->firstOrFail();

        return $brand->update($data);
    }

    public function delete(int $id): bool
    {
        $brand = Brand::findOrFail($id);

        return $brand->delete();
    }

    public function softDelete(int $id): bool
    {
        $brand = Brand::findOrFail($id);

        return $brand->delete();
    }

    public function restore(int $id): bool
    {
        $brand = Brand::withTrashed()->findOrFail($id);

        return $brand->restore();
    }

    public function getTrashed(int $perPage = 10): LengthAwarePaginator
    {
        return Brand::onlyTrashed()->paginate($perPage);
    }

    public function forceDelete(int $id): bool
    {
        $brand = Brand::withTrashed()->findOrFail($id);

        return $brand->forceDelete();
    }
}
