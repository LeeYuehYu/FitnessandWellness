<?php
// process_reset_password.php

// Include the database connection file
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    // Query the password_reset table to get the email associated with the token
    $query = "SELECT `email` FROM `password_reset` WHERE `token` = ?";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("s", $token);

    // Execute statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Fetch row
    $row = $result->fetch_assoc();

    if ($row) {
        $email = $row['email'];

        // Update the password_hash in users table
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE `users` SET `password_hash` = ? WHERE `email` = ?";
        $stmt_update = $conn->prepare($update_query);

        // Bind parameters
        $stmt_update->bind_param("ss", $password_hash, $email);

        // Execute statement
        if ($stmt_update->execute()) {
            // Password updated successfully, delete token from password_reset table
            $delete_query = "DELETE FROM `password_reset` WHERE `token` = ?";
            $stmt_delete = $conn->prepare($delete_query);

            // Bind parameters
            $stmt_delete->bind_param("s", $token);

            // Execute statement
            $stmt_delete->execute();

            echo "Password updated successfully.";
        } else {
            echo "Failed to update password.";
        }

        // Close delete statement
        $stmt_delete->close();
    } else {
        echo "Invalid token.";
    }

    // Close update statement
    $stmt_update->close();
}

// Close connection
$conn->close();
?>
