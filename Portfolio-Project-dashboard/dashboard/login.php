
<?php session_start(); ?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page || PHP SQL DATA || COODENOW</title>
  <link rel="icon" href="img/remove-icon.png">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
  <link rel="stylesheet" href="css/style-login.css">
</head>
<style>/* From Uiverse.io by Yaya12085 */ 
body {
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100vh;
	margin: 0;
	background-color: rgb(36, 44, 63);
  }
  

.form-container {
	width: 320px;
	border-radius: 0.75rem;
	background-color: rgba(17, 24, 39, 1);
	padding: 2rem;
	color: rgba(243, 244, 246, 1);
    }
    
    .title {
	text-align: center;
	font-size: 1.5rem;
	line-height: 2rem;
	font-weight: 700;
    }
    
    .form {
	margin-top: 1.5rem;
    }
    
    .input-group {
	margin-top: 0.25rem;
	font-size: 0.875rem;
	line-height: 1.25rem;
    }
    
    .input-group label {
	display: block;
	color: rgba(156, 163, 175, 1);
	margin-bottom: 4px;
    }
    
    .input-group input {
	width: 90%;
	border-radius: 0.375rem;
	border: 1px solid rgba(55, 65, 81, 1);
	outline: 0;
	background-color: rgba(17, 24, 39, 1);
	padding: 0.75rem 1rem;
	color: rgba(243, 244, 246, 1);
    }
    
    .input-group input:focus {
	border-color: rgba(167, 139, 250);
    }
    
    .forgot {
	display: flex;
	justify-content: flex-end;
	font-size: 0.75rem;
	line-height: 1rem;
	color: rgba(156, 163, 175,1);
	margin: 8px 0 14px 0;
    }
    
    .forgot a,.signup a {
	color: rgba(243, 244, 246, 1);
	text-decoration: none;
	font-size: 14px;
    }
    
    .forgot a:hover, .signup a:hover {
	text-decoration: underline rgba(167, 139, 250, 1);
    }
    
    .sign {
	display: block;
	width: 100%;
	background-color: rgba(167, 139, 250, 1);
	padding: 0.75rem;
	text-align: center;
	color: rgba(17, 24, 39, 1);
	border: none;
	border-radius: 0.375rem;
	font-weight: 600;
    }
    
    .social-message {
	display: flex;
	align-items: center;
	padding-top: 1rem;
    }
    
    .line {
	height: 1px;
	flex: 1 1 0%;
	background-color: rgba(55, 65, 81, 1);
    }
    
    .social-message .message {
	padding-left: 0.75rem;
	padding-right: 0.75rem;
	font-size: 0.875rem;
	line-height: 1.25rem;
	color: rgba(156, 163, 175, 1);
    }
    
    .social-icons {
	display: flex;
	justify-content: center;
    }
    
    .social-icons .icon {
	border-radius: 0.125rem;
	padding: 0.75rem;
	border: none;
	background-color: transparent;
	margin-left: 8px;
    }
    
    .social-icons .icon svg {
	height: 1.25rem;
	width: 1.25rem;
	fill: #fff;
    }
    
    .signup {
	text-align: center;
	font-size: 0.75rem;
	line-height: 1rem;
	color: rgba(156, 163, 175, 1);
    }
    /*

    forget model*/
    /* Modal Styles */
.modal {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	overflow: auto; /* Enable scroll if needed */
	background-color: rgba(0, 0, 0, 0.5); /* Black w/ opacity */
  }
  
  .modal-content {
	background-color: #646262;
	margin: 15% auto;
	padding: 20px;
	border: 1px solid #888;
	width: 80%; /* Could be more or less, depending on screen size */
	max-width: 400px;
	border-radius: 8px;
	box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
	color: white;
  }
  
  .close {
	color: #ffffff;
	float: right;
	font-size: 28px;
	font-weight: bold;
	cursor: pointer;
  }
  .input-group {margin-bottom: 8px;}
  
  .close:hover,
  .close:focus {
	color: black;
	text-decoration: none;
	cursor: pointer;
  }
  .error{color: red;}</style>
<body>
  
    
<div class="form-container" >
	<p class="title">Login</p>
<!-- Login Form -->
<form class="form" action="login-page.php" method="POST">
    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="" required>
    </div>
    <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="" required>
        <div class="forgot">
            <a rel="noopener noreferrer" href="#" id="forgot-password-link">Forgot Password?</a>
        </div>
    </div>
  <?php
    if (isset($_SESSION['error'])) {
        echo '<p class="error">' . htmlspecialchars($_SESSION['error']) . '</p>';
        unset($_SESSION['error']);
    }
  ?>
    <button type="submit" value="Login" class="sign">Log in</button>
</form>

<!-- Forgot Password Modal -->
<div id="forgot-password-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Reset Your Password</p>
        <form id="php/forgot-password-form" class="form" action="reset-your-password.php" method="POST">
            <div class="input-group">
                <label for="forgot-email">Enter your email</label>
                <input type="email" name="forgot-email" id="forgot-email" placeholder="Your email" required>
            </div>
            <button type="submit" class="sign">Submit</button>
        </form>
    </div>
</div>

	<div class="social-message">
		<div class="line"></div>
		<p class="message">Login with social accounts</p>
		<div class="line"></div>
	</div>
	<div class="social-icons">
		<button aria-label="Log in with Google" class="icon">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
				<path d="M16.318 13.714v5.484h9.078c-0.37 2.354-2.745 6.901-9.078 6.901-5.458 0-9.917-4.521-9.917-10.099s4.458-10.099 9.917-10.099c3.109 0 5.193 1.318 6.38 2.464l4.339-4.182c-2.786-2.599-6.396-4.182-10.719-4.182-8.844 0-16 7.151-16 16s7.156 16 16 16c9.234 0 15.365-6.49 15.365-15.635 0-1.052-0.115-1.854-0.255-2.651z"></path>
			</svg>
		</button>
		<button aria-label="Log in with Twitter" class="icon">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
				<path d="M31.937 6.093c-1.177 0.516-2.437 0.871-3.765 1.032 1.355-0.813 2.391-2.099 2.885-3.631-1.271 0.74-2.677 1.276-4.172 1.579-1.192-1.276-2.896-2.079-4.787-2.079-3.625 0-6.563 2.937-6.563 6.557 0 0.521 0.063 1.021 0.172 1.495-5.453-0.255-10.287-2.875-13.52-6.833-0.568 0.964-0.891 2.084-0.891 3.303 0 2.281 1.161 4.281 2.916 5.457-1.073-0.031-2.083-0.328-2.968-0.817v0.079c0 3.181 2.26 5.833 5.26 6.437-0.547 0.145-1.131 0.229-1.724 0.229-0.421 0-0.823-0.041-1.224-0.115 0.844 2.604 3.26 4.5 6.14 4.557-2.239 1.755-5.077 2.801-8.135 2.801-0.521 0-1.041-0.025-1.563-0.088 2.917 1.86 6.36 2.948 10.079 2.948 12.067 0 18.661-9.995 18.661-18.651 0-0.276 0-0.557-0.021-0.839 1.287-0.917 2.401-2.079 3.281-3.396z"></path>
			</svg>
		</button>
		<button aria-label="Log in with GitHub" class="icon">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-5 h-5 fill-current">
				<path d="M16 0.396c-8.839 0-16 7.167-16 16 0 7.073 4.584 13.068 10.937 15.183 0.803 0.151 1.093-0.344 1.093-0.772 0-0.38-0.009-1.385-0.015-2.719-4.453 0.964-5.391-2.151-5.391-2.151-0.729-1.844-1.781-2.339-1.781-2.339-1.448-0.989 0.115-0.968 0.115-0.968 1.604 0.109 2.448 1.645 2.448 1.645 1.427 2.448 3.744 1.74 4.661 1.328 0.14-1.031 0.557-1.74 1.011-2.135-3.552-0.401-7.287-1.776-7.287-7.907 0-1.751 0.62-3.177 1.645-4.297-0.177-0.401-0.719-2.031 0.141-4.235 0 0 1.339-0.427 4.4 1.641 1.281-0.355 2.641-0.532 4-0.541 1.36 0.009 2.719 0.187 4 0.541 3.043-2.068 4.381-1.641 4.381-1.641 0.859 2.204 0.317 3.833 0.161 4.235 1.015 1.12 1.635 2.547 1.635 4.297 0 6.145-3.74 7.5-7.296 7.891 0.556 0.479 1.077 1.464 1.077 2.959 0 2.14-0.020 3.864-0.020 4.385 0 0.416 0.28 0.916 1.104 0.755 6.4-2.093 10.979-8.093 10.979-15.156 0-8.833-7.161-16-16-16z"></path>
			</svg>
		</button>
	</div>
	<p class="signup">Don't have an account?
		<a rel="noopener noreferrer" href="index.php" class="">Sign up</a>
	</p>
</div>
</body>

</html>

<script>
        // Push a new state to the history stack
        history.pushState(null, null, window.location.href);

        // Add an event listener for the popstate event
        window.addEventListener('popstate', function(event) {
            // Redirect to a specific page or simply prevent going back
            history.pushState(null, null, window.location.href);
        });

// Get the modal
var modal = document.getElementById("forgot-password-modal");

// Get the link that opens the modal
var forgotLink = document.querySelector(".forgot a");

// Get the <span> element that closes the modal
var closeBtn = document.querySelector(".close");

// When the user clicks the link, open the modal 
forgotLink.onclick = function(event) {
    event.preventDefault(); // Prevent the default link behavior
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
closeBtn.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>