<?php
include_once 'db_connect.php'; // Include your database connection script

// Start session (if not already started)
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit;
}

// Retrieve form data
$user_id = $_POST['user_id'];
$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$height = $_POST['height'];
$weight = $_POST['weight'];

// Handle profile picture upload if a new file is uploaded
if ($_FILES['profile-picture']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "uploads/profile/";
    $target_file = $target_dir . basename($_FILES["profile-picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check file size
    if ($_FILES["profile-picture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["profile-picture"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Prepare the SQL statement using prepared statements
$sql = "UPDATE userprofile SET 
        username = ?,
        name = ?,
        email = ?,
        phone_number = ?,
        birthday = ?,
        gender = ?,
        height = ?,
        weight = ?,
        profile_picture = ?
        WHERE user_id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}

// Bind parameters
$stmt->bind_param("sssssssssi", $username, $name, $email, $phone_number, $birthday, $gender, $height, $weight, $target_file, $user_id);

// Execute SQL query
if ($stmt->execute()) {
    echo "Profile updated successfully";
} else {
    echo "Error updating profile: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
