<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;
use App\Controllers\CategoryController;
use App\Controllers\ProductController;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

$pdo = Database::getConnection();

header('Content-Type: application/json');

$endpoint = $_GET['endpoint'] ?? '';

switch ($endpoint) {
    case 'categories':
        $categoryRepository = new CategoryRepository($pdo);
        $controller = new CategoryController($categoryRepository);
        $controller->handleRequest();
        break;

    case 'products':
        $productRepository = new ProductRepository($pdo);
        $controller = new ProductController($productRepository);
        $controller->handleRequest();
        break;

    case 'product':
        $productId = $_GET['id'] ?? null;
        if (!$productId) {
            http_response_code(400);
            echo json_encode(['error' => 'Product ID is required']);
            exit;
        }
        $productRepository = new ProductRepository($pdo);
        $product = $productRepository->getProductById((int)$productId);
        if (!$product) {
            http_response_code(404);
            echo json_encode(['error' => 'Product not found']);
            exit;
        }
        echo json_encode($product);
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found']);
        break;
}