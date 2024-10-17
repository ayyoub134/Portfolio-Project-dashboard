<?php
// Start session if needed
session_start();

// Database connection variables
$dsn = "mysql:host=localhost;dbname=user-info";
$dbUsername = "root";
$dbPassword = "";

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get POST data and sanitize it
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $website = filter_input(INPUT_POST, 'website', FILTER_SANITIZE_URL);
    $additionalText = filter_input(INPUT_POST, 'additional_text', FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Prepare SQL query to insert data into the contact_me table
    $sql = "INSERT INTO contact_me (fullname, email, phone, website, additional_text) VALUES (:fullname, :email, :phone, :website, :additional_text)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':website', $website);
    $stmt->bindParam(':additional_text', $additionalText);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Success message
        echo "Thank you for contacting us, $fullname! We will get back to you soon.";
        
    } else {
        // Error message
        echo "Something went wrong. Please try again.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
