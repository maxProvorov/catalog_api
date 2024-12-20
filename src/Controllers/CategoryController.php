<?php

namespace App\Controllers;

use App\Repositories\CategoryRepository;

class CategoryController
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handleRequest(): void
    {
        echo json_encode($this->repository->getCategories());
        exit;
    }
}
