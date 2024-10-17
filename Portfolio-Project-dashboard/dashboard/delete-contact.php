<?php
// Start the session if needed
session_start();

// Database connection
$dsn = "mysql:host=localhost;dbname=user-info";
$dbUsername = "root";
$dbPassword = "";

try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Check if the ID is provided via GET
if (isset($_GET['id'])) {
    // Sanitize the ID
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute the delete query
    $query = "DELETE FROM contact_me WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect back to the user list after deletion
        header("Location: http://coodeme.rf.gd/dashboard.php#");
        exit();
    } else {
        echo "Error deleting contact.";
    }
} else {
    // If no ID is provided, redirect back to the user list
    header("Location: user-list.php?message=error");
    exit();
}
?>
