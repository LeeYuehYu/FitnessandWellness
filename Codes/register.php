<?php
// Include the database connection
require 'db_connect.php';

// Initialize variables
$message = '';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Perform validation (e.g., password match)
    if ($password !== $confirm_password) {
        $message = "Passwords do not match. Please try again.";
    } else {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, name, email, password_hash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $name, $email, $password_hash);

        // Execute the statement
        if ($stmt->execute()) {
            $message = "New user registered successfully";
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Fitness and Wellness</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #222;
            color: #fff;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input[type=text], input[type=email], input[type=password] {
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
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
        .already-a-user {
            text-align: center;
            margin-top: 10px;
        }
        .already-a-user a {
            color: #2196F3;
            text-decoration: none;
        }
        .already-a-user a:hover {
            text-decoration: underline;
        }
        footer {
            background-color: #333;
            color: #fff;
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
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="name" placeholder="Insert your name" required>
            <input type="text" name="username" placeholder="Create a username" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Create a password" required>
            <input type="password" name="confirm_password" placeholder="Confirm password" required>
            <input type="submit" value="Register as new user">
        </form>
        
        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
            
        <div class="already-a-user">
            <a href="login.php">Already a user? Log in here</a>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2024 Fitness and Wellness. All rights reserved.</p>
    </footer>
</body>
</html>
