<?php
// Include your database connection script
include 'db_connect.php';

// Check if data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Sanitize and retrieve form data (example: date, weight, exercise_hours, exercise_minutes, steps)
        $date = $_POST['date'];
        $weight = $_POST['weight'];
        $exerciseHours = $_POST['exercise_hours'];
        $exerciseMinutes = $_POST['exercise_minutes'];
        $steps = $_POST['steps'];

        // Example user_id (replace with actual user_id retrieval logic)
        $user_id = 1; // Replace with actual user_id retrieval logic

        // Calculate total exercise duration in minutes
        $exerciseDuration = ($exerciseHours * 60) + $exerciseMinutes;

        // Prepare SQL statement to insert data into progress_tracker table
        $sql = "INSERT INTO progress_tracker (user_id, date, weight, exercise_duration, steps)
                VALUES (?, ?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isidi", $user_id, $date, $weight, $exerciseDuration, $steps);

        // Execute the statement
        $stmt->execute();

        // Check if the insertion was successful
        if ($stmt->affected_rows > 0) {
            echo "Data saved successfully";
            // Optionally redirect or return a success message
        } else {
            echo "Error: Data not saved";
            // Optionally handle error message
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage(); // Display exception message
    }
} else {
    echo "Invalid request method";
    // Optionally handle invalid request method
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
