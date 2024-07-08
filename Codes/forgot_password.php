<?php
require_once 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve username or email from form submission
    $username_or_email = $_POST['username_or_email'];

    // Prepare a query to check if the username or email exists in the users table
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the user record
    $user = $result->fetch_assoc();

    if ($user) {
        // Redirect to set new password page
        header("Location: set_new_password.php?user_id=" . $user['user_id']);
        exit(); // Stop further execution
    } else {
        // No user found with the provided username or email
        echo "No user found with the provided username or email.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            margin-top: 50px;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form action="forgot_password.php" method="post">
            <label for="username_or_email">Username or Email:</label>
            <input type="text" id="username_or_email" name="username_or_email" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
