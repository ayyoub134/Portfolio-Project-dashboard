<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection variables
$dsn = "mysql:host=localhost;dbname=user-info";
$dbUsername = "root";
$dbPassword = "";

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];

        // Prepare DELETE statement
        $stmt = $pdo->prepare("DELETE FROM registration WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: dashboard.php?msg=User+Deleted+Successfully");
            exit();
        } else {
            echo "Error deleting user.";
        }
    } else {
        echo "No user ID provided.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
