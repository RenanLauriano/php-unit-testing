<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    protected $entity;

    public function __construct(Product $product)
    {
        $this->entity = $product;
    }

    /**
     * Get all Products
     * @return array
     */
    public function getAllProducts()
    {
        return $this->entity->paginate();
    }

    /**
     * Seleciona o Produto por ID
     * @param int $id
     * @return object
     */
    public function getProductById(int $id)
    {
        return $this->entity->where('id', $id)->firstOrFail();
    }

    /**
     * Cria um novo Produto
     * @param array $product
     * @return object
     */
    public function createProduct(array $product)
    {
        return $this->entity->create($product);
    }

    /**
     * Atualiza um produto
     * @param object $prod
     * @param array $product
     */
    public function updateProduct(object $prod, array $product)
    {
        return $prod->update($product);
    }

    /**
     * Deleta um produto
     * @param object $product
     */
    public function destroyProduct(object $product)
    {
        return $product->delete();
    }
}
