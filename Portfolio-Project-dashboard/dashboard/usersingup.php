<?php
// Database connection variables
$dsn = "mysql:host=localhost;dbname=user-info";
$dbUsername = "root"; // Adjust if necessary
$dbPassword = ""; // Adjust if necessary

try {
      // Create a new PDO instance
      $conn = new PDO($dsn, $dbUsername, $dbPassword);
      // Set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare SQL and bind parameters
            $stmt = $conn->prepare("INSERT INTO usersingup (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

            // Execute the query
            $stmt->execute();

            echo "New record created successfully";
      }

} catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
}

// Close connection
$conn = null;
?>