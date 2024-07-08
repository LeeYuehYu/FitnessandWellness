<?php
// Include your database connection file
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $exercise_hours = mysqli_real_escape_string($conn, $_POST['exercise_hours']);
    $exercise_minutes = mysqli_real_escape_string($conn, $_POST['exercise_minutes']);
    $steps = mysqli_real_escape_string($conn, $_POST['steps']);

    // Calculate total workout time in minutes
    $workout_minutes = $exercise_hours * 60 + $exercise_minutes;

    // SQL query to insert data into progress_tracker table
    $sql = "INSERT INTO progress_tracker (date, steps, workout_hours, workout_minutes, weight) 
            VALUES ('$date', '$steps', '$exercise_hours', '$workout_minutes', '$weight')";

    if (mysqli_query($conn, $sql)) {
        echo "Progress saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
