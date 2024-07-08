<?php
require_once 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user_id and new password from form submission
    $user_id = $_POST['user_id'];
    $new_password = $_POST['new_password'];

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
    $stmt->bind_param("si", $hashed_password, $user_id);
    $stmt->execute();

    // Redirect to login page or any other page after password reset
    header("Location: login.php");
    exit(); // Stop further execution
}

// Check if user_id is provided in the URL
if (!isset($_GET['user_id'])) {
    // Redirect back to forgot password page if user_id is not provided
    header("Location: forgot_password.php");
    exit(); // Stop further execution
}

$user_id = $_GET['user_id'];

// Retrieve user information based on user_id
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    // Invalid user_id, redirect back to forgot password page
    header("Location: forgot_password.php");
    exit(); // Stop further execution
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
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
        input[type="password"] {
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
        <h2>Set New Password</h2>
        <form action="set_new_password.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit">Set Password</button>
        </form>
    </div>
</body>
</html>
