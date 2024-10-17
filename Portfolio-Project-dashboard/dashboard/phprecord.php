<?php

// Get POST data
$Fullname = $_POST['firstname'];
$email = $_POST['email'];
$password = $_POST['password'];
$BirthDate = $_POST['BirthDate'];

// Database connection variables
$dsn = "mysql:host=localhost;dbname=user-info";
$dbUsername = "root";
$dbPassword = "";

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert data into the registration table
    $sql = "INSERT INTO registration (Fullname, email, password, BirthDate) VALUES (:Fullname, :email, :password, :BirthDate)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':Fullname', $Fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':BirthDate', $BirthDate);

    // Execute the prepared statement
    $stmt->execute();
    echo "Registration successful";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>

