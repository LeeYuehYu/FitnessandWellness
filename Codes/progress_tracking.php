<?php
session_start(); // Start the session

require_once 'db_connect.php'; // Include your database connection file

// Function to fetch progress entries for a specific user
function fetchProgressEntries($user_id, $conn) {
    $entries = [];

    $sql = "SELECT * FROM progress_tracker WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $entries[] = $row;
    }

    return $entries;
}

// Check if user is logged in and retrieve user_id
// In a real application, implement proper authentication and session handling
$user_id = 1; // Replace with actual user ID or session-based retrieval

// Fetch progress entries for the user
$progressEntries = fetchProgressEntries($user_id, $conn);

// Handle form submission for adding new progress entry
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $weight = $_POST['weight'];
    $workout_hours = $_POST['workout_hours'];
    $workout_minutes = $_POST['workout_minutes'];
    $steps_goal = $_POST['steps_goal'];

    // Insert new progress entry into database
    $sql = "INSERT INTO progress_tracker (user_id, date, weight, workout_goal_hours, workout_goal_minutes, steps_goal) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiiii", $user_id, $date, $weight, $workout_hours, $workout_minutes, $steps_goal);
    $stmt->execute();

    // Store inserted data in session for display on progress_tracker.php
    $_SESSION['recent_progress_entry'] = [
        'date' => $date,
        'weight' => $weight,
        'workout_hours' => $workout_hours,
        'workout_minutes' => $workout_minutes,
        'steps_goal' => $steps_goal
    ];

    // Redirect to avoid form resubmission on refresh
    header("Location: progress%20tracking.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            margin-top: 50px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        label, input, select {
            display: block;
            margin-bottom: 10px;
        }
        input[type="date"], input[type="number"], select {
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
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Progress Tracker</h2>
        <form action="progress_tracking.php" method="post">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" step="0.01" required>
            <label for="workout_hours">Workout Duration (hours):</label>
            <input type="number" id="workout_hours" name="workout_hours" required>
            <label for="workout_minutes">Workout Duration (minutes):</label>
            <input type="number" id="workout_minutes" name="workout_minutes" required>
            <label for="steps_goal">Steps Goal:</label>
            <input type="number" id="steps_goal" name="steps_goal" required>
            <button type="submit">Add Entry</button>
        </form>

        <h3>Progress Entries</h3>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Weight (kg)</th>
                    <th>Workout Duration</th>
                    <th>Steps Goal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($progressEntries as $entry): ?>
                <tr>
                    <td><?php echo $entry['date']; ?></td>
                    <td><?php echo $entry['weight']; ?></td>
                    <td><?php echo $entry['workout_goal_hours'] . " hours " . $entry['workout_goal_minutes'] . " minutes"; ?></td>
                    <td><?php echo $entry['steps_goal']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
