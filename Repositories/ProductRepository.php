<?php

class ProductRepository
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getProducts(array $filters = []): array 
    {
        $query = "
        SELECT p.id, p.name, p.description, p.price, p.image_path, c.name AS category
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE 1=1
        ";

        $params = [];

        if (!empty($filters['categories'])) {
            $placeholders = implode(',', array_fill(0, count($_GET['categories']), '?'));
            $query .= " AND p.category_id IN ($placeholders)";
            $params = array_merge($params, $filters['categories']);
        }

        if (!empty($filters['min_price'])) {
            $query .= " AND p.price >= ?";
            $params[] = $filters['min_price'];
        }

        if (!empty($filters['max_price'])) {
            $query .= " AND p.price <= ?";
            $params[] = $filters['max_price'];
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params); 

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}