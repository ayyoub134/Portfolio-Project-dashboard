<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset your password || Coodenow</title>
    <link rel="icon" href="img/remove-icon.png">
</head>
<body>

</body>
</html>
<?php
// Database connection details
$dsn = "mysql:host=localhost;dbname=user-info";
$dbUsername = "root";
$dbPassword = "";

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the email from the form
        $email = $_POST['forgot-email'];

        // Prepare an SQL statement to insert the email into the 'chain' table
        $stmt = $pdo->prepare("INSERT INTO chain (emailreset) VALUES (:email)");
        $stmt->bindParam(':email', $email);

        // Execute the statement
        if ($stmt->execute()) {
            echo "
            <div class='message-container'>
                <p>Email successfully submitted. We will contact you at <strong>$email</strong> with instructions to reset your password.</p>
                <button onclick=\"window.location.href='login.php'\" class='back-button'>Back to Login</button>
            </div>
            ";
        } else {
            echo "
            <div class='message-container'>
                <p>Failed to submit the email.</p>
                <button onclick=\"window.location.href='login.php'\" class='back-button'>Back to Login</button>
            </div>
            ";
        }
    }
} catch (PDOException $e) {
    echo "
    <div class='message-container'>
        <p>Database error: " . $e->getMessage() . "</p>
        <button onclick=\"window.location.href='login.php'\" class='back-button'>Back to Login</button>
    </div>
    ";
}
?>

<style>
.message-container {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    z-index: 1000;
    font-family: Arial, sans-serif;
    color: #333;
    max-width: 90%;
    box-sizing: border-box;
}

.message-container p {
    margin: 0 0 15px; /* Adjust margin to create space between text and button */
    font-size: 16px;
}

.message-container strong {
    color: #007BFF;
}

.back-button {
    background-color: #007BFF;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    font-family: Arial, sans-serif;
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #0056b3;
}
</style>
