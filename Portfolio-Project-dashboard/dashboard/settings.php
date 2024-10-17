<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$dsn = "mysql:host=sql212.infinityfree.com;dbname=if0_37297679_userinfo";
$dbUsername = "if0_37297679";
$dbPassword = "wM9rRww8KIdHhSb";

try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch current user data
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT fullname, email FROM registration WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>