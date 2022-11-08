<?php

namespace Tests\Unit\Traits;

trait ProductHelperTrait {

    public function getProduct($id): array
    {
        return  [
            "id" => $id,
            "title" => "Product ".$id,
            "description" => "Description for Product ".$id,
            "created_at" => "2022-11-07T19:46:22.000000Z",
            "updated_at" => "2022-11-07T19:46:22.000000Z"
        ];
    }

    public function getProductList(): array
    {
        return [
            "data" => [
                $this->getProduct(1),
                $this->getProduct(2)
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
    }


}
