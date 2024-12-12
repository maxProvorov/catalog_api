<?php

try {
    $pdo = new PDO('sqlite:database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $categories = [
        ['name' => 'Animals'],
        ['name' => 'Birds'],
        ['name' => 'Fishes'],
    ];

    $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
    foreach ($categories as $category) {
        $stmt->execute(['name' => $category['name']]);
    }

    $products = [
        ['name' => 'Horse', 'description' => 'Horse with a flowing mane in the wind', 'category_id' => 1, 'price' => 23.97, 'image_path' => '/images/horse.png'],
        ['name' => 'Hummingbird', 'description' => 'Hummingbird in flight among bright tropical flowers', 'category_id' =>2, 'price' => 28.08, 'image_path' => '/images/hummingbird.png'],
        ['name' => 'Lion', 'description' => 'Mighty lion against the backdrop of a sunset savanna', 'category_id' => 1, 'price' => 15.52, 'image_path' => '/images/lion.png'],
        ['name' => 'Elephant', 'description' => 'Baby elephant playing in the mud near a river in the savanna', 'category_id' => 1, 'price' => 31.03, 'image_path' => '/images/elephant.png'],
        ['name' => 'Hawk', 'description' => 'Hawk soaring over snowy mountains', 'category_id' => 2, 'price' => 24.28, 'image_path' => '/images/hawk.png'],
        ['name' => 'Wolves', 'description' => 'Pack of wolves running through a snowy forest', 'category_id' => 1, 'price' => 32.66, 'image_path' => '/images/wolves.png'],
    ];

    $stmt = $pdo->prepare("
        INSERT INTO products (name, description, category_id, price, image_path) 
        VALUES (:name, :description, :category_id, :price, :image_path)
    ");
    foreach ($products as $product) {
        $stmt->execute($product);
    }

    echo "Данные успешно добавлены!";
} catch (PDOException $e) {
    die("Ошибка добавления данных: " . $e->getMessage());
}
