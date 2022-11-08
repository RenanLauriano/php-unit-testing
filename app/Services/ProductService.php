<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Seleciona todos os Produtos através
     * do repositorie
     * @return $array
    */
    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    /**
     * Seleciona um Produto pelo ID através
     * do repositorie
     * @param int $id
     * @return object
    */
    public function getProductById(int $id)
    {
        return $this->productRepository->getProductById($id);
    }

    /**
     * Cria um novo Produto através
     * do repositorie
     * @param array $product
     * @return object $product
    */
    public function makeProduct(array $product)
    {
        return $this->productRepository->createProduct($product);
    }

    /**
     * Atualiza um Produto através
     * do repositorie
     * @param int $id
     * @param array Product
     * return json response
     */
    public function updateProduct(int $id, array $product)
    {
        try {
            $prod = $this->productRepository->getProductById($id);
        }
        catch(ModelNotFoundException $e) {
            return false;
        }

        $this->productRepository->updateProduct($prod, $product);
        return true;
    }

    /**
     * Deletar um Produto através
     * do repositorie
     * @param int $id
     * return json response
     */
    public function destroyProduct(int $id)
    {
        try{
            $prod = $this->productRepository->getProductById($id);
        }
        catch(ModelNotFoundException $e){
            return false;
        }
        $this->productRepository->destroyProduct($prod);
        return true;
    }
}
