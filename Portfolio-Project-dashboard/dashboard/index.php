
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> Registration|| PHP cours || SQL DATA || COODENOW</title>
      <link rel="icon" href="img/remove-icon.png">
      <link rel="stylesheet" href="css/style-php.css">
   <!-- Fontawesome CDN Link For Icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>
<body>
      
<form action="registration-connect.php" method="post" enctype="multipart/form-data">
    <h2>Form Registration</h2>
    
    <!-- Full Name -->
    <div class="form-group fullname">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" placeholder="Enter your full name" name="firstname" required>
    </div>
    
    <!-- Email Address -->
    <div class="form-group email">
        <label for="email">Email Address</label>
        <input type="email" id="email" placeholder="Enter your email address" name="email" required>
    </div>
    
    <!-- Password -->
    <div class="form-group password">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter your password" name="password" required>
        <i id="pass-toggle-btn" class="fa-solid fa-eye"></i>
    </div>
    
    <!-- Birth Date -->
    <div class="form-group date">
        <label for="date">Birth Date</label>
        <input type="date" name="BirthDate" id="date" placeholder="Select your date" required>
    </div>
    
    <!-- Gender -->
    <div class="form-group gender">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" required>
            <option value="" selected disabled>Select your gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
    </div>
    
    <!-- Photo Upload -->
    <div class="form-group">
        <label for="photo">Choose a photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" required>
    </div>
    
    <!-- Checkbox to Connect to Email -->

    
    <!-- Submit Button -->
    <div class="form-group submit-btn">
        <input type="submit" value="Submit">
        <button type="button" class="login-btn" onclick="window.location.href='login.php'">Log In</button>
    </div>
</form>

<style>

  .form-group .login-btn {

            background-color: #008CBA;
            width: 100%;
            height: 50px;
            border-radius: 8px;
            border-color: none;
            margin-top: 6px;
            color: #ffff;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .form-group .login-btn:hover {
            background-color: #007bb5;
        }
 
</style>
</body>
</html>