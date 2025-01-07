<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = htmlspecialchars($_POST['content']);
    $userId = htmlspecialchars($_SESSION['user_id']);

    $stmt = $conn->prepare("INSERT INTO Comments (UserID, Content) VALUES (:userId, :content)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':content', $content);
    $stmt->execute();

    header("Location: index.php");
}
?>
