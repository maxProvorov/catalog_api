<?php

namespace App\Repositories;

use App\Models\Category;
use PDO;

class CategoryRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCategories(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM categories");
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
}
