<?php
// Start session to manage user login state
session_start();

// Include the database connection
require 'db_connect.php';

// Initialize variables
$message = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch user record based on username
    $stmt = $conn->prepare("SELECT user_id, username, password_hash, email FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if username exists
    if ($stmt->num_rows > 0) {
        // Bind result variables
        $stmt->bind_result($user_id, $db_username, $db_password_hash, $email);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $db_password_hash)) {
            // Password correct, create session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['email'] = $email;

            // Update last login timestamp
            $update_stmt = $conn->prepare("UPDATE users SET last_login = current_timestamp() WHERE user_id = ?");
            $update_stmt->bind_param("i", $user_id);
            $update_stmt->execute();
            $update_stmt->close();

            // Redirect to progress_tracking.php after successful login
            header("Location: progress%20tracking.php");
            exit();
        } else {
            $message = "Invalid username or password. Please try again.";
        }
    } else {
        $message = "Invalid username or password. Please try again.";
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fitness and Wellness</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: hsl(218, 7%, 18%);
            color: white;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: activeborder;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: white;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 100%;
            padding: 10px;
            background-color: aquamarine;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: aliceblue;
        }
        .forgot-password {
            text-align: center;
            margin-top: 12px;
        }
        .forgot-password a {
            color: deepskyblue;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        .not-registered {
            text-align: center;
            margin-top: 5px;
        }
        .not-registered a {
            color: deepskyblue;
            text-decoration: none;
        }
        .not-registered a:hover {
            text-decoration: underline;
        }
        footer {
            background-color: black;
            color: white;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>LOGIN</h2>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        
        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <div class="forgot-password">
            <a href="forgot_password.php">Forgot Password?</a>
        </div>
        
        <div class="not-registered">
            <a href="register.php">New User? Register here</a>
        </div>
    </div>
    
    <footer>
        <h5><i><small>&copy; 2024 Fitness and Wellness. All rights reserved.</small></i></h5>
    </footer>
</body>
</html>
