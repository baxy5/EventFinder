<?php
require_once ('config.php');
$pdo = get_connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $img = $_POST['img'];
    $userId = $_SESSION['id'];

    // Perform the database insertion
    $stmt = $pdo->prepare("INSERT INTO basket (title, description, price, img, user_id) VALUES (:title, :description, :price, :img, :user_id)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':img', $img);
    $stmt->bindParam(':user_id', $userId);

    // Execute the statement
    if ($stmt->execute()) {
        echo 'Product added to basket successfully.';
    } else {
        echo 'Error inserting product into basket.';
    }
} else {
    echo 'Invalid request method.';
}
?>