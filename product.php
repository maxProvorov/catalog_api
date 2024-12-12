<?php
$pdo = new PDO('sqlite:database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['name'] ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="product">
        <h1><?= $product['name'] ?></h1>
        <p><?= $product['description'] ?></p>
        <p><?= $product['price'] ?> AUD</p>
        <img src="<?= $product['image_path'] ?>" alt="<?= $product['name'] ?>">
    </div>
</body>
</html>
