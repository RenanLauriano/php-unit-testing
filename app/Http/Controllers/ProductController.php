<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\StoreUpdateProduct;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{

    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return ProductResource::collection($products);
    }

    public function store(StoreUpdateProduct $request)
    {
        $product = $this->productService->makeProduct($request->all());
        return new ProductResource($product);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return new ProductResource($product);
    }

    public function update(StoreUpdateProduct $request, $id)
    {
        $product = $this->productService->updateProduct($id, $request->all());
        return $product;
    }

    public function destroy($id)
    {
        $product = $this->productService->destroyProduct($id);
        return $product;
    }
}
