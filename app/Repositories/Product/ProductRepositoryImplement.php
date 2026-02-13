<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductRepositoryImplement implements ProductRepository
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getAllProducts(?int $perPage = null)
    {
        $query = $this->model->with(['kategori', 'satuan']);
        if (request()->has('search')) {
            $query->where('product_name', 'like', '%'.request('search').'%');
        }

        return $query->latest()->paginate($perPage);
    }

    public function getProductById(string $id)
    {
        return $this->model->with(['kategori', 'satuan'])->where('uuid', $id)->firstOrFail();
    }

    public function createProduct(array $data)
    {
        $data['uuid'] = (string) Str::uuid();

        return $this->model->create($data);
    }

    public function updateProduct(string $id, array $data)
    {
        $product = $this->getProductById($id);
        $product->update($data);

        return $product;
    }

    public function deleteProduct(string $id)
    {
        $product = $this->getProductById($id);

        return $product->delete();
    }

    public function softDelete(int $id): bool
    {
        $product = $this->getProductById($id);

        return $product->delete();
    }

    public function restore(int $id): bool
    {
        $product = $this->getProductById($id);

        return $product->restore();
    }
}
