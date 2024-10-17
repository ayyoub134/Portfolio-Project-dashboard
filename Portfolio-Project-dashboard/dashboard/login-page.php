<?php
session_start();

// Get POST data
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = $_POST['password']; // Plain text password

// Database connection variables
$dsn = "mysql:host=localhost;dbname=user-info";
$dbUsername = "root";
$dbPassword = "";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL to select user with matching email
    $sql = "SELECT * FROM registration WHERE email = :email";
    $stmt = $pdo->prepare($sql);

    // Bind the email parameter
    $stmt->bindParam(':email', $email);

    // Execute the prepared statement
    $stmt->execute();

    // Check if a user was found
    if ($stmt->rowCount() > 0) {
        // Fetch the user's data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Debugging: Output the fetched user data
        print_r($user);  // To check what user data is fetched

        // Directly compare the password since it's stored in plain text
        if ($password === $user['password']) {
            // Password is correct, login successful
            $_SESSION['username'] = $user['Fullname']; 
            header("Location: Dashboard.php");
            exit();
        } else {
            // Password is incorrect
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: login.php");
            exit();
        }
    } else {
        // Email not found
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: login.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
