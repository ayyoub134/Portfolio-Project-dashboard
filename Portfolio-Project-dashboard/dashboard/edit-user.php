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

        // Fetch user data
        $stmt = $pdo->prepare("SELECT * FROM registration WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Update user data
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $gender = $_POST['gender'];

                $updateStmt = $pdo->prepare("UPDATE registration SET fullname = :fullname, email = :email, password = :password, gender = :gender WHERE id = :id");
                $updateStmt->bindParam(':fullname', $fullname);
                $updateStmt->bindParam(':email', $email);
                $updateStmt->bindParam(':password', $password);
                $updateStmt->bindParam(':gender', $gender);
                $updateStmt->bindParam(':id', $userId, PDO::PARAM_INT);

                if ($updateStmt->execute()) {
                    header("Location: dashboard.php?msg=User+Updated+Successfully");
                    exit();
                } else {
                    echo "Error updating user.";
                }
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "No user ID provided.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/Dashboard.css">
    <link rel="stylesheet" href="css/edit.css">
    <link rel="icon" href="img/remove-icon.png">
    <link rel="stylesheet" href="css/style-respons.css">

</head>
<body>
<div class="edit-form">
        <button class="close-btn" onclick="window.location.href='dashboard.php';">&times;</button>
        <h2>Edit User</h2>
        <?php if ($user): ?>
            <img src="<?php echo isset($user['file']) ? htmlspecialchars($user['file']) : 'default.png'; ?>" alt="User Photo">
            <form method="POST">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo isset($user['Fullname']) ? htmlspecialchars($user['Fullname']) : ''; ?>" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?>" required><br>

                <label for="password">Password:</label>
                <input type="text" id="password" name="password" value="<?php echo isset($user['password']) ? htmlspecialchars($user['password']) : ''; ?>" required><br>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="Male" <?php echo isset($user['gender']) && $user['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo isset($user['gender']) && $user['gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
                </select><br>

                <button type="submit">Update User</button>
            </form>
        <?php else: ?>
            <p>User data not available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
