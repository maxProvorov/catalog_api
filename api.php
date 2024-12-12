<?php

require_once 'Repositories/ProductRepository.php';
require_once 'Repositories/CategoryRepository.php';
require_once 'Controllers/ProductController.php';
require_once 'Controllers/CategoryController.php';

$pdo = new PDO('sqlite:database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
header('Content-Type: application/json');

$endpoint = $_GET['endpoint'] ?? '';

if($endpoint === 'categories') {
    $categoryRepository = new CategoryRepository($pdo);
    $categoryController = new CategoryController($categoryRepository);
    $categoryController->handleRequest();
    
} elseif ($endpoint === 'products') {
    $productRepository = new ProductRepository($pdo);
    $productController = new ProductController($productRepository);
    $productController->handleRequest();
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint not found']);
    exit;
}
