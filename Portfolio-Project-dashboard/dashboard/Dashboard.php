<?php
session_start();

// Prevent caching
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache"); // HTTP 1.0


// Check if the user is logged in
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

    // Prepare the SQL query
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
    $searchTerm = '%' . $searchTerm . '%'; // For partial matches

    // Fetch all users including id, password, and gender with search functionality
    $stmt = $pdo->prepare("SELECT id, fullname, email, password, gender FROM registration WHERE fullname LIKE :searchTerm");
    $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count total registrations
    $countStmt = $pdo->prepare("SELECT COUNT(*) as total FROM registration WHERE fullname LIKE :searchTerm");
    $countStmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $countStmt->execute();
    $countResult = $countStmt->fetch(PDO::FETCH_ASSOC);
    $totalRegistrations = $countResult['total'];

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $users = [];
    $totalRegistrations = 0;
}

// Set the session timeout duration (e.g., 15 minutes)
$timeout_duration = 900;

// Check if the session is set and active
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // If the session is inactive for too long, destroy the session
    session_unset();     // Unset $_SESSION variables
    session_destroy();   // Destroy the session data
    header("Location: login.php"); // Redirect to login
    exit();
}

// Update the last activity time
$_SESSION['LAST_ACTIVITY'] = time();



///// contact form my web site


try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Count total registrations from the contact_me table
$query = "SELECT COUNT(*) AS total FROM contact_me";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$totalformcontact = $result['total'];



// Start the session/




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard || Front end Developer</title>
    <link rel="stylesheet" href="css/Dashboard.css">
    <link rel="stylesheet" href="css/insight.css">
    <link rel="stylesheet" href="css/style-form.css">
    <link rel="stylesheet" href="css/style-respons.css">





    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="img/remove-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
        <style>
    #genderChart {
        display: block;
        margin: 0 auto;
        max-width: 400px;
    }
</style>

    <style>
        .five-dev p {
            color: #333;
            /* Default color */
            cursor: pointer;
        }

        .five-dev p.active {
            color: #007bff;
            /* Color when active */
            font-weight: bold;
        }

        .dev-plus-Insight,
        .dev-plus-Website,
        .dev-plus-Account,
        .dev-plus-Settings,
        .dev-plus-add-account,
        .dev-plus-switch-account {
            display: none;
            /* Hide all content sections by default */
        }
        
    </style>
</head>

<body>
    <div class="Dashboard">
        <div class="left-bare">
            <div class="logo-bare">
                <a href="Dashboard.php" class="code-logo">
                    <img src="img/remove-icon.png" alt="Logo">C<strong>oo</strong>de
                </a>
            </div>
            <div class="Dolar">
                <h1>Total Id :<p><?php echo $totalRegistrations; ?></p>
                </h1>
            </div>
            <div class="sidebar">
            <div class="five-dev">
                <div class="one">
                    <p><a id="dashboard" href="dashboard.php" class="dashboard" return false;><i
                                class="fa-solid fa-house"></i>Dashboard</a></p>
                </div>
                <div class="one">
                    <p><a id="insight" href="#" class="insight" return false;><i
                                class="fa-solid fa-signal"></i>Insight</a></p>
                </div>
                <div class="one">
                    <p><a href="https://coodenow.online/" return false;><i
                                class="fa-solid fa-layer-group"></i>Website</a></p>
                </div>
                <div class="one">
                    <p><a id="account" href="#" class="account" return false;><i
                                class="fa-solid fa-user"></i>Track User</a></p>
                </div>
                <div class="one">
                    <p><a id="settings" href="#" class="settings" return false;><i
                                class="fa-solid fa-gear"></i>Settings</a></p>
                </div>
                <div class="line"></div>
                <div class="one">
                    <p><a id="add-account" href="#" class="add-account" return false;><i
                                class="fa-solid fa-user-plus"></i>Add Account</a></p>
                </div>
                <div class="one">
                    <p><a id="switch-account" href="#" class="switch-account" return false;><i
                                class="fa-solid fa-users"></i>Switch Account</a></p>
                </div>
                <div class="one">
                    <p><a href="login.php"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a></p>
                </div>
            </div>
            </div>
        </div>

        <!-- bign right side -->
        <div class="right-bare">
            <div class="navbar">
                <a href="Dashboard.php" class="navbar-brand">Dashboard</a>
                <div class="navbar-contact">

                    <div class="name">
                        <h3><?php echo htmlspecialchars($_SESSION['username']); ?></h3>
                        <p>Manager</p>
                    </div>
                    <!----- change the photo here ---->
                    <div class="profil"><img src="img/profile-pic.png" width="70px" height="70px" alt=""></div>
                </div>
            </div>

            <!-- Add the search input form to your HTML -->
            <div class="cherche">
                <form method="GET" action="dashboard.php">
                    <input type="text" name="search" placeholder="Search by name..."
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit">Search</button>
                </form>
            </div>

            <!-- bigin dev-plus -->

            <div class="dev-plus">
            <h2>Total Registrations: <?php echo $totalRegistrations; ?></h2>
                <h3>User List:</h3>
                <ul>
                    <?php foreach ($users as $user): ?>
                        <li>
                            <strong>ID : <?php echo htmlspecialchars($user['id']); ?></strong><br>
                            <strong>Name : <?php echo htmlspecialchars($user['fullname']); ?></strong><br>
                            <strong>Email : <?php echo htmlspecialchars($user['email']); ?></strong> <br>
                            <strong>Password : <?php echo htmlspecialchars($user['password']); ?></strong><br>
                            <strong>Gender : <?php echo htmlspecialchars($user['gender']); ?></strong><br>
                            <!-- Edit and Delete Buttons -->
                            <div class="ul-li-a">
                                <a href="edit-user.php?id=<?php echo $user['id']; ?>" class="edit-btn">Edit</a>
                                <a href="delete-user.php?id=<?php echo $user['id']; ?>" class="delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>


            <!--------------------------------------------------------------------------------------->
            <div class="dev-plus-Insight">
                <h2>Insight Dashboard</h2>

                <div class="insight-summary">
                    <div class="insight-box">
                        <h3>Total Users</h3>
                        <p>
                        <?php echo $totalformcontact; ?>
                        </p>
                    </div>
                    <div class="insight-box">
                        <h3>Active Users</h3>
                        <p>....</p>
                    </div>
                    <div class="insight-box">
                          <h3>.....</h3>
                        <p>
                          <h3></h3>
                        </p>
                    </div>
                </div>
    <!------------------------------------------------------------------------------------------------------------------------->

                <div class="chart-container">
    <h2>Total Contact: <?php echo $totalformcontact; ?></h2>
    <h3>User List:</h3>
    <ul>
        <?php
        // Fetch all data from contact_me table
        $query = "SELECT * FROM contact_me";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($contacts as $contact): ?>
            <li>
                <strong>ID : <?php echo htmlspecialchars($contact['id']); ?></strong><br>
                <strong>Name : <?php echo htmlspecialchars($contact['fullname']); ?></strong><br>
                <strong>Email : <?php echo htmlspecialchars($contact['email']); ?></strong><br>
                <strong>Phone : <?php echo htmlspecialchars($contact['phone']); ?></strong><br>
                <strong>Website : <?php echo htmlspecialchars($contact['website']); ?></strong><br>
                <strong>Additional Info : <?php echo htmlspecialchars($contact['additional_text']); ?></strong><br>
                <!-- Edit and Delete Buttons (if needed) -->
                <div class="ul-li-a">
                    <a href="delete-contact.php?id=<?php echo $contact['id']; ?>" class="delete-btn"
                       onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
    <!------------------------------------------------------------------------------------------------------------------------->
 </div>

<?php 


try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user is logged in
    if (isset($_SESSION['user_id']) && isset($_SESSION['fullname'])) {
        $userId = $_SESSION['user_id']; // Get user ID from session
        $fullname = $_SESSION['fullname']; // Get fullname from session
        $sessionId = session_id(); // Get session ID
        $currentTime = date('Y-m-d H:i:s'); // Current time

        // Insert or update user activity in the active_users table
        $query = "INSERT INTO active_users (session_id, user_id, fullname, last_activity) 
                  VALUES (:session_id, :user_id, :fullname, :last_activity) 
                  ON DUPLICATE KEY UPDATE 
                    user_id = :user_id, 
                    fullname = :fullname, 
                    last_activity = :last_activity";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'session_id' => $sessionId,
            'user_id' => $userId,
            'fullname' => $fullname,
            'last_activity' => $currentTime
        ]);
    }

    // Query to fetch active users
    $query = "SELECT id, session_id, user_id, fullname, last_activity FROM active_users";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Fetch all active users
    $activeUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

 <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .ActiveUsers {
            background-color: white;
            color: black;
        }
    </style>
            <!--------------------------------------------------------------------------------------->
            <div class="dev-plus-Account">
            <div class="ActiveUsers">
    <h1>Active Users</h1>
    <table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Last Activity</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($activeUsers)): ?>
            <?php foreach ($activeUsers as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                    <td><?php echo htmlspecialchars($user['last_activity']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No active users found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>





            </div>


            <div class="dev-plus-Settings">
              

                <!-- Profile Information Section -->
                <div class="settings-section">
                <?php if (isset($user)): ?>
                    <form action=".......">
                        <h3>Profile Information</h3>
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['fullname']); ?>">

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">



                        <button>Save</button>
                    </form>
                    <?php endif; ?>
                </div>

                <!-- Change Password Section -->
                <div class="settings-section">
                    <h3>Change Password</h3>
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" name="current-password">

                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="new-password">

                    <label for="confirm-password">Confirm New Password</label>
                    <input type="password" id="confirm-password" name="confirm-password">

                    <button>Update Password</button>
                </div>

                <!-- Notification Preferences Section -->
                <div class="settings-section">
                    <h3>Notification Preferences</h3>
                    <label><input type="checkbox" checked> Email Notifications</label>
                    <label><input type="checkbox"> SMS Notifications</label>
                    <label><input type="checkbox"> Push Notifications</label>

                    <button>Save Preferences</button>
                </div>
            </div>



            <!--------------------------------------------------------------------------------------->

            <div class="dev-plus-add-account">


                <!-- Add acount -->
                <div class="settings-section">
                    <h2>Add Account</h2>
                    <form action="registration-connect.php" method="post" enctype="multipart/form-data">

                        <!-- Full Name -->
                        <div class="form-group fullname">
                            <label for="fullname">Full Name</label>
                            <input type="text" id="fullname" placeholder="Enter your full name" name="firstname"
                                required>
                        </div>

                        <!-- Email Address -->
                        <div class="form-group email">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" placeholder="Enter your email address" name="email" required>
                        </div>

                        <!-- Password -->
                        <div class="form-group password">
                            <label for="password">Password</label>
                            <input type="password" id="password" placeholder="Enter your password" name="password"
                                required>
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
                        </div>
                    </form>
                </div>




            </div>

            <!-- Add Account Content -->
            <div class="dev-plus-add-account">
                <h2>Add New Account</h2>

                <!-- Add New Account Section -->
                <div class="add-account-section">
                    <h3>Account Details</h3>
                    <label for="new-username">Username</label>
                    <input type="text" id="new-username" name="new-username" placeholder="Enter new username">

                    <label for="new-email">Email</label>
                    <input type="email" id="new-email" name="new-email" placeholder="Enter new email">

                    <label for="new-password">Password</label>
                    <input type="password" id="new-password" name="new-password" placeholder="Enter new password">

                    <label for="confirm-new-password">Confirm Password</label>
                    <input type="password" id="confirm-new-password" name="confirm-new-password"
                        placeholder="Confirm new password">

                    <label for="account-role">Role</label>
                    <select id="account-role" name="account-role">
                        <option value="admin">Administrator</option>
                        <option value="editor">Editor</option>
                        <option value="viewer">Viewer</option>
                    </select>

                    <label for="account-type">Account Type</label>
                    <select id="account-type" name="account-type">
                        <option value="standard">Standard</option>
                        <option value="premium">Premium</option>
                    </select>

                    <!-- Account Settings Section -->
                    <div class="account-settings">
                        <h4>Initial Settings</h4>
                        <label><input type="checkbox" name="email-notifications"> Enable Email Notifications</label><br>
                        <label><input type="checkbox" name="sms-notifications"> Enable SMS Notifications</label><br>
                        <label><input type="checkbox" name="two-factor-auth"> Enable Two-Factor Authentication</label>
                    </div>

                    <button>Create Account</button>
                </div>
            </div>
            <!--------------------------------------------------------------------------------------->

            <div class="dev-plus-switch-account">
                <p>Switch Account Content</p>
            </div>

            <!-- Fin dev-plus-SwitchAccount -->
        </div>
    </div>
</body>
<script>
    document.getElementById('dashboard').addEventListener('click', function () {
        hideAllContent();
        document.querySelector('.dev-plus').style.display = 'block';
    });

    document.getElementById('insight').addEventListener('click', function () {
        hideAllContent();
        document.querySelector('.dev-plus-Insight').style.display = 'block';
    });

    document.getElementById('account').addEventListener('click', function () {
        hideAllContent();
        document.querySelector('.dev-plus-Account').style.display = 'block';
    });

    document.getElementById('settings').addEventListener('click', function () {
        hideAllContent();
        document.querySelector('.dev-plus-Settings').style.display = 'block';
    });

    document.getElementById('add-account').addEventListener('click', function () {
        hideAllContent();
        document.querySelector('.dev-plus-add-account').style.display = 'block';
    });

    document.getElementById('switch-account').addEventListener('click', function () {
        hideAllContent();
        document.querySelector('.dev-plus-switch-account').style.display = 'block';
    });

    // Function to hide all content sections
    function hideAllContent() {
        var contents = document.querySelectorAll('.dev-plus, .dev-plus-Insight, .dev-plus-Website, .dev-plus-Account, .dev-plus-Settings, .dev-plus-add-account, .dev-plus-switch-account');
        contents.forEach(function (content) {
            content.style.display = 'none';
        });
    }
</script>



<script>
        // Toggle sidebar function
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active'); // Add/remove the active class
        }

        // Example button to toggle sidebar (add this button to your HTML)
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.createElement('button');
            toggleButton.innerText = 'Menu';
            toggleButton.classList.add('toggle-button'); // Add a class for styling
            toggleButton.onclick = toggleSidebar; // Call toggle function on click
            document.body.prepend(toggleButton); // Prepend button to the body
        });
    </script>


</html>