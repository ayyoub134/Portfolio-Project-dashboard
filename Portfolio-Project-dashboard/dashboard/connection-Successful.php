<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful || Coodenow </title>
    <link rel="icon" href="img/remove-icon.png">

    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message-container {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .message-container h1 {
            font-size: 24px;
            margin: 0;
            font-weight: normal;
        }

        .message-container p {
            font-size: 16px;
            margin-top: 10px;
        }

        .message-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: white;
            color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, color 0.3s;
        }

        .message-container a:hover {
            background-color: #45a049;
            color: white;
        }
    </style>
</head>
<body>
<div class="message-container">
        <h1>Registration Successful</h1>
        <p>Thank you for registering. You may now proceed to the dashboard or register another user.</p>
        <p>Total Registrations: <?php echo htmlspecialchars($_GET['total']); ?></p>
        <a href="login.php">Go to Log in</a>
    </div>

</body>
</html>
