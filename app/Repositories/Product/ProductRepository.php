<?php

namespace App\Repositories\Product;

interface ProductRepository
{
    public function getAllProducts(?int $perPage = null);

    public function getProductById(string $id);

    public function createProduct(array $data);

    public function updateProduct(string $id, array $data);

    public function deleteProduct(string $id);

    public function softDelete(int $id): bool;

    public function restore(int $id): bool;
}
