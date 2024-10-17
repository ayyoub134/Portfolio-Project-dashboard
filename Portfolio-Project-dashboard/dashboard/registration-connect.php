<?php
// Get POST data and sanitize it
$fullname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = $_POST['password']; 
$birthDate = filter_input(INPUT_POST, 'BirthDate', FILTER_SANITIZE_STRING);
$gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}



// Directory where the files should be uploaded
$targetDir = "uploads/";

// Check if the directory exists, if not, create it
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);  // Create directory with full permissions
}

$targetFile = $targetDir . basename($_FILES["photo"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));



// Check if the file is an actual image
$check = getimagesize($_FILES["photo"]["tmp_name"]);
if ($check === false) {
    die("File is not an image.");
}

// Check if file already exists
if (file_exists($targetFile)) {
    die("Sorry, file already exists.");
}

// Check file size (5MB max)
if ($_FILES["photo"]["size"] > 5000000) {
    die("Sorry, your file is too large.");
}



// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
}

// Move the uploaded file to the target directory
if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
    die("Sorry, there was an error uploading your file.");
}

// Database connection variables
$dsn = "mysql:host=localhost;dbname=user-info";
$dbUsername = "root";
$dbPassword = "";

try {
    // Create PDO instance
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert data into the registration table, including the image path
    $sql = "INSERT INTO registration (fullname, email, password, birthDate, gender, file) VALUES (:fullname, :email, :password, :birthDate, :gender, :file)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);  
    $stmt->bindParam(':birthDate', $birthDate);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':file', $targetFile);

    // Execute the prepared statement
    $stmt->execute();

    // Count total registrations
    $countQuery = $pdo->query("SELECT COUNT(*) as total FROM registration");
    $countResult = $countQuery->fetch(PDO::FETCH_ASSOC);
    $totalRegistrations = $countResult['total'];

    // Redirect to success page with total registrations count
    header("Location: connection-Successful.php?total=" . $totalRegistrations);
    exit();

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


/////


?>
