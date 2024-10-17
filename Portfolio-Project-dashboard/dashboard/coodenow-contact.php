<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Coodenow || Contact Me|| SQL DATA || Ayyoub EL moumen</title>

  <link rel="icon" href="img/remove-icon.png">
  <link rel="stylesheet" href="css/style-php.css">
</head>
<style>
  /* Styles for the Additional Information Textarea */
.additional-text {
    margin: 10px 0; /* Adds space around the textarea */
}

.additional-text textarea {
    width: 100%; /* Full width of the container */
    height: 100px; /* Set a height for the textarea */
    padding: 10px; /* Adds padding inside the textarea */
    border: 1px solid #ccc; /* Light gray border */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Font size for readability */
    resize: vertical; /* Allow users to resize the textarea vertically */
    transition: border-color 0.3s; /* Smooth transition for border color */
}

/* Focus effect */
.additional-text textarea:focus {
  /* Change border color on focus */
    outline: none; /* Remove default outline */
    box-shadow: 0 0 5px ; /* Add a subtle shadow */
}



.submit-btn input {
  color: white;
  border: none;
  height: auto;
  font-size: 16px;
  padding: 13px 0;
  border-radius: 5px;
  cursor: pointer;
  font-weight: 500;
  text-align: center;
 background: #333;
  transition: 0.2s ease;
}

.submit-btn input:hover {
  background: #333;
}

body {

background-color:#333;;
}
.button {
    text-decoration: none;
    color: white;
    background-color: #007BFF;
    padding: 15px 30px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #0056b3;
}
</style>
<body>
  
<form action="coodecontact-form.php" method="post" enctype="multipart/form-data">
    <h2>Contact Me</h2>
    
    <!-- Full Name -->
    <div class="form-group fullname">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" placeholder="Enter your full name" name="fullname" required>
    </div>
    
    <!-- Email Address -->
    <div class="form-group email">
        <label for="email">Email Address</label>
        <input type="email" id="email" placeholder="Enter your email address" name="email" required>
    </div>
    
    <!-- Phone Number -->
    <div class="form-group phone">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" placeholder="Enter your phone number" name="phone" required>
    </div>
    
    <!-- Website -->
    <div class="form-group website">
        <label for="website">Website</label>
        <input type="url" id="website" placeholder="Enter your website" name="website" required>
    </div>

    <!-- Additional Text Input -->
    <div class="form-group additional-text">
        <label for="additional-text">Additional Information</label>
        <textarea id="additional-text" placeholder="Enter any additional information" name="additional_text" required></textarea>
    </div>
    
    <!-- Submit Button -->
    <div class="form-group submit-btn">
        <input type="submit" value="Submit">
    </div>
 
</form>


</body>
</html>
