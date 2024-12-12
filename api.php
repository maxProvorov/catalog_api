<?php
$pdo = new PDO('sqlite:database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
header('Content-Type: application/json');

$endpoint = $_GET['endpoint'] ?? '';

if($endpoint === 'categories') {
    $stmt = $pdo->query("SELECT * FROM categories");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if ($endpoint === 'products') {
    $query = "
        SELECT p.id, p.name, p.description, p.price, p.image_path, c.name AS category
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE 1=1
    ";

    $params = [];

    if (!empty($_GET['categories'])) {
        $placeholders = implode(',', array_fill(0, count($_GET['categories']), '?'));
        $query .= " AND p.category_id IN ($placeholders)";
        $params = array_merge($params, $_GET['categories']);
    }

    if (!empty($_GET['min_price'])) {
        $query .= " AND p.price >= ?";
        $params[] = (float)$_GET['min_price'];
    }

    if (!empty($_GET['max_price'])) {
        $query .= " AND p.price <= ?";
        $params[] = (float)$_GET['max_price'];
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params); 

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Endpoint not found']);