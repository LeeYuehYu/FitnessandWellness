<?php
require 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    
    if ($email) {
        // Check if the email exists in the database
        $stmt = $connection->prepare("SELECT User_ID FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id);
            $stmt->fetch();
            
            // Generate a unique token
            $token = bin2hex(random_bytes(50));
            
            // Set token expiration time (e.g., 1 hour from now)
            $expires = time() + 3600;
            
            // Store the token in the database
            $stmt = $connection->prepare("INSERT INTO password_reset (email, token, expires) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $email, $token, $expires);
            $stmt->execute();
            
            // Close the statement
            $stmt->close();
            
            // Send the reset email
            $reset_link = "http://FitnessandWellness.com/forgot_password.php?token=" . $token;
            $subject = "Password Reset Request";
            $message = "We received a password reset request for your account. Click the link below to reset your password:\n\n";
            $message .= $reset_link . "\n\n";
            $message .= "If you did not request a password reset, please ignore this email.";
            $headers = "From: no-reply@FitnessandWellness.com";
            
            mail($email, $subject, $message, $headers);
            
            echo "<script>alert('A password reset link has been sent to your email address.');</script>";
        } else {
            echo "<script>alert('No account found with that email address.');</script>";
        }
    } else {
        echo "<script>alert('Please enter a valid email address.');</script>";
    }
}

// Handle the password reset form submission
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset(filter_input['token'])) {
    $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
    
    if ($token) {
        // Check if the token exists and is not expired
        $stmt = $connection->prepare("SELECT email FROM password_reset WHERE token = ? AND expires > ?");
        $current_time = time();
        $stmt->bind_param("si", $token, $current_time);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($email);
            $stmt->fetch();
            
            if (filter_input["REQUEST_METHOD"] === "POST") {
                $new_password = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_STRING);
                $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
                
                if ($new_password && $confirm_password && $new_password === $confirm_password) {
                    // Hash the new password
                    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    
                    // Update the user's password in the database
                    $stmt = $connection->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
                    $stmt->bind_param("ss", $new_password_hash, $email);
                    $stmt->execute();
                    
                    // Delete the password reset token
                    $stmt = $connection->prepare("DELETE FROM password_reset WHERE token = ?");
                    $stmt->bind_param("s", $token);
                    $stmt->execute();
                    
                    echo "<script>alert('Your password has been reset successfully.');</script>";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<script>alert('Passwords do not match or are invalid. Please try again.');</script>";
                }
            }
        } else {
            echo "<script>alert('Invalid or expired token.');</script>";
        }
    } else {
        echo "<script>alert('Invalid token.');</script>";
    }
    
    // Close the statement and connection
    $stmt->close();
    $connection->close();
}
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
    <head>
        <title>FITNESS AND WELLNESS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Forgot Password</title>
        <style>
            body {
                font-family:Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: hsl(218, 7%, 18%);
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
            
            input[type="email"] {
                width: 100%;
                padding: 10px;
                margin-top: 0px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
            }
            
            input[type="submit"] {
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
            
            footer{
                background-color: black;
                color: white;
                padding: 10px 0;
                bottom: 0;
                position: fixed;
                width: 100%;
                text-align: center;
            }
            
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Forgot Password</h2>
            <p>Enter your email address below.
                A link will be sent to you via email too reset your password. </p>
            <form action="reset-password.php" method="POST">
                <input type="email" name="Email" placeholder="Email Address" required>
                <input type="submit" value="Reset Password"> 
            </form>
        </div>
        
        <footer>
            <h5><i><small>&copy; 2024 Fitness and Wellness. All rights reserved.</h5></i><small>
        </footer>
        
    </body>
</html>
