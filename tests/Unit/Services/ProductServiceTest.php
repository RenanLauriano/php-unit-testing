<?php

namespace Tests\Unit\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    private $productService;
    private $productRepository;

    private $products = [
        "data" => [
            [
                "id" => 1,
                "title" => "Product 1",
                "description" => "Description for Product 1",
                "created_at" => "2022-11-07T19:46:22.000000Z",
                "updated_at" => "2022-11-07T19:46:22.000000Z"
            ],
            [
                "id" => 2,
                "title" => "Product 2",
                "description" => "Description for Product 2",
                "created_at" => "2022-11-07T19:46:30.000000Z",
                "updated_at" => "2022-11-07T19:46:30.000000Z"
            ]
        ],
        "links" => [
            "first" => "http://localhost:8000/api/products?page=1",
            "last" => "http://localhost:8000/api/products?page=1",
            "prev" => null,
            "next" => null
        ],
        "meta" => [
            "current_page" => 1,
            "from" => 1,
            "last_page" => 1,
            "links" => [
                [
                    "url" => null,
                    "label" => "&laquo; Previous",
                    "active" => false
                ],
                [
                    "url" => "http://localhost:8000/api/products?page=1",
                    "label" => "1",
                    "active" => true
                ],
                [
                    "url" => null,
                    "label" => "Next &raquo;",
                    "active" => false
                ]
            ],
            "path" => "http://localhost:8000/api/products",
            "per_page" => 15,
            "to" => 2,
            "total" => 2
        ]
    ];
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $productRepository = $this->getMockBuilder(ProductRepository::class)
                                    ->disableOriginalConstructor()
                                    ->getMock();

        $productRepository->expects($this->any())->method('getAllProducts')->will($this->returnValue($this->products));
        $productRepository->expects($this->any())->method('destroyProduct')->willReturn(true);

        $this->productRepository = $productRepository;
        $this->productService = new ProductService($productRepository);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllProducts()
    {
        $this->assertEquals($this->products, $this->productService->getAllProducts());
    }

    public function testDestroyProduct() {
        $product = $this->getMockBuilder(Product::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productRepository->expects($this->any())->method('getProductById')->with(1)->will($this->returnValue($product));
        ($this->productService->destroyProduct(1));
    }
}