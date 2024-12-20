<?php

namespace App\Controllers;

use App\Repositories\ProductRepository;

class ProductController
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handleRequest(): void
    {
        $filters = [
            'categories' => $_GET['categories'] ?? [],
            'min_price' => $_GET['min_price'] ?? null,
            'max_price' => $_GET['max_price'] ?? null,
        ];
        echo json_encode($this->repository->getProducts($filters));
        exit;
    }
}
