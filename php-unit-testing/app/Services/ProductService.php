<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
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
        $prod = $this->productRepository->getProductById($id);

        if (!$prod) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }

        $this->productRepository->updateProduct($prod, $product);
        return response()->json(['message' => 'Product Updated'], 200);
    }

    /**
     * Deletar um Produto através
     * do repositorie
     * @param int $id
     * return json response
     */
    public function destroyProduct(int $id)
    {
        $prod = $this->productRepository->getProductById($id);

        if (!$prod) {
            return response()->json(['message' => 'Product Not Found'], 404);
        }

        $this->productRepository->destroyProduct($prod);
        return response()->json(['message' => 'Product Deleted'], 200);
    }

    /**
     * Armazenamento da Imagem do Produto
     * @param object $image
     * @return string 
     */
    public function storeImageProduct(object $image)
    {
        return $image->store("/products");
    }
}