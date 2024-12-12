<?php

class ProductController
{
    private $repository;

    public function __construct($repository) {
        $this->repository = $repository;
    }

    public function handleRequest() {
        $filters = [
            'categories' => $_GET['categories'] ?? [],
            'min_price' => $_GET['min_price'] ?? null,
            'max_price' => $_GET['max_price'] ?? null,
        ];

        $products = $this->repository->getProducts($filters);
        echo json_encode($products);
        exit;
    }
}