<?php

class CategoryController
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

        $categories = $this->repository->getCategories();
        echo json_encode($categories);
        exit;
    }
}