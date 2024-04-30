<?php
require_once ('config.php');
$pdo = get_connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $id = $_POST['id'];
    $userId = $_SESSION['id'];

    // Perform the database insertion
    $stmt = $pdo->prepare("DELETE FROM basket WHERE title = :title AND id = :id AND user_id = :user_id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $userId);

    // Execute the statement
    if ($stmt->execute()) {
        echo 'Product deleted from basket successfully.';
    } else {
        echo 'Error deleting product from basket.';
    }
} else {
    echo 'Invalid request method.';
}
?>