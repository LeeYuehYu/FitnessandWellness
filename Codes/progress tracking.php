<?php
session_start();
require_once 'db_connect.php'; // Adjust the path as per your file structure

function fetchMostRecentProgressEntry($user_id, $conn) {
    $sql = "SELECT * FROM progress_tracker WHERE user_id = ? ORDER BY date DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Assuming you have a way to get the current user's ID
$user_id = 1; // Replace this with actual user authentication

$mostRecentEntry = fetchMostRecentProgressEntry($user_id, $conn); 

// Define target values
$steps_target = 10000;
$workout_target_minutes = 60; // Assuming 1 hour as target
$weight_target = 55.5; // As per your previous example

// Calculate progress percentages
$steps_progress = $mostRecentEntry ? min(($mostRecentEntry['steps_goal'] / $steps_target) * 100, 100) : 0;
$workout_progress = $mostRecentEntry ? min((($mostRecentEntry['workout_goal_hours'] * 60 + $mostRecentEntry['workout_goal_minutes']) / $workout_target_minutes) * 100, 100) : 0;
$weight_progress = $mostRecentEntry ? min(($weight_target / $mostRecentEntry['weight']) * 100, 100) : 0;
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
        <title>FITNESS AND WELLNESS</title>
        
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: hsl(218, 7%, 18%);
            }
            
            header{
                background-color: white;
                color: white;
                padding: 20px 0;
                display: flex;
                text-align: center;
                justify-content: space-between;
            }
            
            header img{
                height: 300px;
                display: block;
                margin: 0 auto;
            }
            
            .logo {
                height: 50px;
                margin-left: 20px;
            }
            
            .profile-icon{
                position: relative;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                overflow: hidden;
                cursor: pointer;
                margin-right: 20px;
            }
            
            .profile-icon img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            
            #profile-image {
                margin-top: 20%;
                margin-right: 80%;
                width: 50px; /* Set the width to control the size */
                height: 50px; /* Set the height for consistency */
                object-fit: cover; /* Ensures the image covers the entire container */
                border-radius: 50%; /* Makes the image circular */
                border: 2px solid #ccc; /* Adds a border around the image */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow for depth */
            }

            nav{
                background-color: black;
                padding: 10px 20px;
                justify-content: space-between;
                display: flex;
                align-items: center;
            }
            
            .nav-left, nav-right {
                flex: 1;
                display: flex;
                align-items: center;
            }
            
            .nav-right{
                justify-content: flex-end;
            }
            
            nav a{
                color: white;
                text-decoration: none;
                padding: 10px 15px;
            }
            
            nav a:hover{
                color: aquamarine;
            }
            
            .dropdown{
                position:relative;
                display: inline-block;
            }
            
            .dropdown-content{
                display: none;
                position: absolute;
                background-color: grey;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index:1;
                top: 100%;
                left:0;
            }
            
            .dropdown:last-child .dropdown-content {
                right: 0;
                left:auto;
            }
            
            .dropdown-content a{
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                white-space: nowrap;
            }
            
            .dropdown-content a:hover{
                background-color: hsl(218, 7%, 18%);
            }
            
            .dropdown:hover .dropdown-content{
                display:block;
            }
            
            .search-bar {
                display: flex;
                align-items: center;
            }
            
            .search-bar input[type="text"] {
                padding: 8px;
                font-size: 14px;
                border: none;
                border-radius: 5px 0 0 5px;
                width: 500px;
            }
            
            .search-bar button {
                padding: 8px 15px;
                font-size: 14px;
                background-color: aquamarine;
                color: black;
                border: none;
                border-radius: 0 5px 5px 0;
                cursor: pointer;
            }
            
            .search-bar button:hover{
                background-color: aqua;
            }
            
            section{
                padding: 40px;
                text-align:center;
            }
            
            .progress-container,
            .container {
                max-width: 800px;
                margin: 50px auto;
                padding: 20px;
                background-color: black;
                color: white;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
                text-justify: inter-word;
            }
            
            h2 {
                text-align: center;
                color: white;
            }

            .progress-form form label,
            .progress-form form input,
            .progress-form form button {
                background-color: black;
                padding: 20px;
                margin: 0 auto 10px auto;
                display: block;
            }
            
            .progress-display {
                background-color: black;
                padding: 20px;
            }
            
            .progress {
                margin-top: 20px;
            }
            
            .progress-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .progress-bar {
                width: 100%;
                background-color: black;
                border-radius: 5px;
                overflow: hidden;
            }
            
            .progress-bar-inner {
                height: 20px;
                background-color: aquamarine;
                transition: width 0.5s ease-in-out;
            }
            
            .progress-value {
                margin-left: 10px;
            }
            
            
            .progress-form h3 {
                color:white;
            }
            
            .duration-input {
                display: inline-block;
                margin-right: 10px;
               }
            
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: black;
                z-index: 1000;
            }
            
            .popup {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }

            .popup-content {
                background-color: black;
                color: white;
                padding: 20px;
                border-radius: 5px;
                width: 300px;
            }

            .popup-content form input,
            .popup-content form button {
                display: block;
                width: 100%;
                margin-bottom: 10px;
                padding: 5px;
            }
            
            .duration-input {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }
            
            .duration-input input {
                width: 45%;
                margin-right: 5px;
            }
            
            .duration-input label {
                width: 60px;
                text-align: left;
            }
            
            .popup-content form input,
            .popup-content form button {
                display: block;
                width: 100%;
                margin-bottom: 10px;
                padding: 5px;
            }
            
            .popup-content form .duration-input input {
                display: inline-block;
                width: auto;
                margin-bottom: 0;
            }
            
            .article img {
                float: left;
                margin-right: 15px;
                max-width: 150px;
                height: auto;
            }

            .articles {
                margin-bottom: 20px;
                background-color: azure;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: calc(33.333% - 20px);
                box-sizing: border-box;
                overflow: hidden;
            }
            
            .articles-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 20px;
            }
            
            .white-text {
                color: white;
            }
            
            .article h3 {
                margin-top: 0;
            }
            
            .article p {
                margin-bottom: 30px;
            }
            
            .section{
                padding: 40px;
                text-align:center;
            }

            .see-more {
                color: aquamarine;
                text-decoration: none;
                float: right;
                margin-right: 20px;
            }
            
            .see-more:hover {
                text-decoration: underline;
                color: aqua;
            }
            
            footer{
                background-color: black;
                color: white;
                padding: 10px 0;
                text-align: center;
            }

        </style>  
    </head>
    <body>

    <header>
        <img src="img/Fitness and Wellness Logo.png" id="logo" alt="Fitness and Wellness Logo">
    </header>
    
    <nav>
        <div class="nav-left">
            <div class="profile-icon" id="profile-icon">
                <a href="profile_management.html" id="profile-link">
                    <img id="profile-image" src="img/profile_icon.png" alt="Profile Icon">
                </a>
            </div>
        </div>
        
        <div class="nav-right"> 
            <a href="#" target="_self" title="You are in the homepage">Home</a>
            <a href="about us.php" target="_self">About Us</a>
            <div class="dropdown">
                <a href="#" target="_self">Services</a>
                <div class="dropdown-content">
                    <a href="healthcare.php">Healthcare</a>
                    <a href="fitness.php">Fitness</a>
                    <a href="sessions.php">Sessions</a>
                    <a href="diet plan.php">Diet Plan</a>
                </div>
            </div> 
            <a href="contact us.php" target="_self" title="This takes you to contact us">Contact Us</a>
            <div class="dropdown"> 
                <a href="#">More</a>
                <div class="dropdown-content">
                    <a href="feedback.php">Feedback</a>
                    <a href="FAQ.php">Help</a>
                </div>
            </div> 
        </div>
    </nav>

        <main>
                <section id="fitness-progress"> 
                    <div id="progress-display" class="progress-container">
                    <h2>Current Fitness Progress</h2>

                    <div class="progress-item">
                        <div class="progress-value">Steps:</div>
                        <div class="progress-bar">
                            <div id="steps-progress" class="progress-bar-inner" style="width: <?php echo $mostRecentEntry ? ($mostRecentEntry['steps_goal'] / 10000) * 100 . '%' : '0%'; ?>"></div>
                        </div>
                        <div id="steps-value" class="progress-value"><?php echo $mostRecentEntry ? $mostRecentEntry['steps_goal'] . ' / 10000' : '0 / 10000'; ?></div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-value">Workouts:</div>
                        <div class="progress-bar">
                            <div id="workout-progress" class="progress-bar-inner" style="width: <?php echo $mostRecentEntry ? (($mostRecentEntry['workout_goal_hours'] * 60 + $mostRecentEntry['workout_goal_minutes']) / 1440) * 100 . '%' : '0%'; ?>"></div>
                        </div>
                        <div id="workout-value" class="progress-value"><?php echo $mostRecentEntry ? $mostRecentEntry['workout_goal_hours'] . ' Hours ' . $mostRecentEntry['workout_goal_minutes'] . ' Minutes' : '0 Hours 0 Minutes'; ?></div>
                    </div>


                    <div class="progress-item">
                        <div class="progress-value">Current Weight:</div>
                        <div id="weight-value" class="progress-value"><?php echo $mostRecentEntry ? $mostRecentEntry['weight'] . ' kg' : '__kg'; ?></div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-value">Weight Goal:</div>
                        <div class="progress-bar">
                            <div id="weight-goal-progress" class="progress-bar-inner" style="width: <?php echo $mostRecentEntry ? ($mostRecentEntry['weight'] / 55.5) * 100 . '%' : '0%'; ?>"></div>
                        </div>
                        <div id="weight-goal-value" class="progress-value">55.5kg</div>
                    </div>

                    <button type="button" id="update-progress-button">Update Progress</button>
                    <button type="button" id="edit-button">Edit Goals</button>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('update-progress-button').addEventListener('click', function() {
                            window.location.href = 'progress_tracking.php';
                        });
                    });
                </script>

            <section>
                <h2>Recommended Healthcare Articles</h2>
                <p class="white-text"><i>These articles are based on your recent searches and health.</p></i>
                <p class="white-text"><i><small>Health always comes first.</p></i></small>
                <div class="articles-container">
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Nutrition" alt="Nutrition">
                        <h3>Nutrition Tips for Muscle Gain and Fat Loss</h3>
                        <p>Explore the best eating strategies to support your fitness goals, whether you're looking to build muscle or lose fat.</p>
                        <a href="#"><i>Read more</i></a>
                    </div> 
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Meditation" alt="Meditation">
                        <h3>The Benefits of Meditation for Mental Health</h3>
                        <p>Learn how incorporating meditation into your daily routine can reduce stress and improve your mental well-being.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>

                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>
                    <div class="articles">
                    <img src="https://via.placeholder.com/150x150.png?text=Meditation" alt="Meditation">
                    <h3>The Benefits of Meditation for Mental Health</h3>
                    <p>Learn how incorporating meditation into your daily routine can reduce stress and improve your mental well-being.</p>
                    <a href="#"><i>Read more</i></a>
                    </div>

                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>
                    
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>
                </div>
                <a href="healthcare.php" class="see-more"><i>See More>>></i></a>
            </section>

            <section>
                <h2>Recommended Diet Plan</h2>
                <p class="white-text"><i>These articles are recommended based on your health.</p></i>
                <p class="white-text"><i><small>Fitness starts with what you eat.</p></i></small>
                <div class="articles-container">
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Nutrition" alt="Nutrition">
                        <h3>Nutrition Tips for Muscle Gain and Fat Loss</h3>
                        <p>Explore the best eating strategies to support your fitness goals, whether you're looking to build muscle or lose fat.</p>
                        <a href="#"><i>Read more</i></a>
                    </div> 
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Meditation" alt="Meditation">
                        <h3>The Benefits of Meditation for Mental Health</h3>
                        <p>Learn how incorporating meditation into your daily routine can reduce stress and improve your mental well-being.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>

                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>
                    <div class="articles">
                    <img src="https://via.placeholder.com/150x150.png?text=Meditation" alt="Meditation">
                    <h3>The Benefits of Meditation for Mental Health</h3>
                    <p>Learn how incorporating meditation into your daily routine can reduce stress and improve your mental well-being.</p>
                    <a href="#"><i>Read more</i></a>
                    </div>

                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>
                    
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="diet plan.php"><i>Read more</i></a>
                    </div>
                </div>
                <a href="diet plan.php" class="see-more"><i>See More>>></i></a>
            </section>

            <section>
                <h2>Wellness Sessions</h2>
                <p class="white-text"><i>Wellness Sessions You Can Try!</p></i>
                <p class="white-text"><i><small>Health starts from finding peace and being friends with your mind.
                        Power comes from the stability oof your mind, thoughts and spiritual growth.
                </p></i></small>
                <div class="articles-container">
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Nutrition" alt="Nutrition">
                        <h3>Nutrition Tips for Muscle Gain and Fat Loss</h3>
                        <p>Explore the best eating strategies to support your fitness goals, whether you're looking to build muscle or lose fat.</p>
                        <a href="#"><i>Read more</i></a>
                    </div> 
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Meditation" alt="Meditation">
                        <h3>The Benefits of Meditation for Mental Health</h3>
                        <p>Learn how incorporating meditation into your daily routine can reduce stress and improve your mental well-being.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>

                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#">Read more</a>
                    </div>
                    <div class="articles">
                    <img src="https://via.placeholder.com/150x150.png?text=Meditation" alt="Meditation">
                    <h3>The Benefits of Meditation for Mental Health</h3>
                    <p>Learn how incorporating meditation into your daily routine can reduce stress and improve your mental well-being.</p>
                    <a href="#"><i>Read more</i></a>
                    </div>

                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>
                    
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>
                </div>
                        <a href="sessions.php" class="see-more"><i>See More>>></i></a>
            </section>

            <section>
                <h2>Recommended Fitness Activities</h2>
                <p class="white-text"><i>These are activities and examples of workout routines you can try to improve your health and well-being.</p></i>
                <p class="white-text"><i><small>You don't have to be extreme, Just Consistent.</p></i></small>
                <div class="articles-container">
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Nutrition" alt="Nutrition">
                        <h3>Nutrition Tips for Muscle Gain and Fat Loss</h3>
                        <p>Explore the best eating strategies to support your fitness goals, whether you're looking to build muscle or lose fat.</p>
                        <a href="#"><i>Read more</i></a>
                    </div> 
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Meditation" alt="Meditation">
                        <h3>The Benefits of Meditation for Mental Health</h3>
                        <p>Learn how incorporating meditation into your daily routine can reduce stress and improve your mental well-being.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>

                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>
                    <div class="articles">
                    <img src="https://via.placeholder.com/150x150.png?text=Meditation" alt="Meditation">
                    <h3>The Benefits of Meditation for Mental Health</h3>
                    <p>Learn how incorporating meditation into your daily routine can reduce stress and improve your mental well-being.</p>
                    <a href="#"><i>Read more</i></a>
                    </div>

                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#"><i>Read more</i></a>
                    </div>
                    
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="fitness.php"><i>Read more</i></a>
                    </div>
                </div>
                <a href="fitness.php" class="see-more"><i>See More>>></i></a>
            </section>
        </main> 
        
    <script>
        document.getElementById('profile-icon').addEventListener('click', function() {
            window.location.href = 'profile management.php';
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            // Function to safely get an element by ID
            function getElement(id) {
                const element = document.getElementById(id);
                if (!element) {
                    console.error(`Element with id "${id}" not found`);
                }
                return element;
            }

            // Search functionality
            const searchForm = getElement('search-form');
            const searchInput = getElement('search-input');
            const searchResult = getElement('search-result');

            if (searchForm && searchInput && searchResult) {
                searchForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const searchQuery = searchInput.value;
                    searchResult.textContent = "You searched for: " + searchQuery;
                });

                searchInput.addEventListener('input', function() {
                    const searchQuery = this.value;
                    searchResult.textContent = searchQuery ? "You are typing: " + searchQuery : "";
                });
            }

            // Profile management
            const profileLink = getElement('profile-link');
            const isLoggedIn = false; // Replace with your logic to check if the user is logged in

            if (profileLink) {
                profileLink.href = isLoggedIn ? '/user-profile' : '/login';
                profileLink.addEventListener('click', function(event) {
                    if (!isLoggedIn) {
                        event.preventDefault();
                        window.location.href = '/login';
                    }
                });
            }

            // Progress tracking
            const updateProgressBtn = getElement('update-progress-btn');
            const progressFormPopup = getElement('progress-form-popup');
            const cancelProgressButton = getElement('cancel-button');
            const editButton = getElement('edit-button');
            const editGoalsPopup = getElement('edit-goals-popup');
            const closeEditGoalsButton = getElement('close-edit-goals');
            const editGoalsForm = getElement('edit-goals-form');
            const fitnessForm = getElement('fitness-form');

            // Initialize goals with default values
            let goals = {
                steps: 10000,
                workout: {
                    hours: 4,
                    minutes: 50
                },
                weight: 70
            };

            if (updateProgressBtn && progressFormPopup) {
                updateProgressBtn.addEventListener('click', function(){
                    progressFormPopup.style.display = 'flex';
                });
            }

            if (cancelProgressButton && progressFormPopup) {
                cancelProgressButton.addEventListener('click', function(){
                    progressFormPopup.style.display = 'none';
                });
            }

            if (fitnessForm) {
                fitnessForm.addEventListener('submit', function(e){
                    e.preventDefault();
                    const date = getElement('date').value;
                    const weight = parseFloat(getElement('weight').value);
                    const hours = parseInt(getElement('exercise-hours').value);
                    const minutes = parseInt(getElement('exercise-minutes').value);
                    const steps = parseInt(getElement('steps').value);

                    updateProgressDisplay(weight, hours, minutes, steps);
                    progressFormPopup.style.display = 'none';
                });
            }

            if (editButton && editGoalsPopup) {
                editButton.addEventListener('click', function(){
                    getElement('steps-goal').value = goals.steps;
                    getElement('workout-goal-hours').value = goals.workout.hours;
                    getElement('workout-goal-minutes').value = goals.workout.minutes;
                    getElement('weight-goal').value = goals.weight;
                    editGoalsPopup.style.display = 'flex';
                });
            }

            if (closeEditGoalsButton && editGoalsPopup) {
                closeEditGoalsButton.addEventListener('click', function(){
                    editGoalsPopup.style.display = 'none';
                });
            }

            if (editGoalsForm) {
                editGoalsForm.addEventListener('submit', function(e){
                    e.preventDefault();
                    goals.steps = parseFloat(getElement('steps-goal').value);
                    goals.workout.hours = parseFloat(getElement('workout-goal-hours').value);
                    goals.workout.minutes = parseFloat(getElement('workout-goal-minutes').value);
                    goals.weight = parseFloat(getElement('weight-goal').value);

                    updateGoalsDisplay();
                    editGoalsPopup.style.display = 'none';
                });
            }

            function updateProgressDisplay(weight, hours, minutes, steps) {
                const stepsProgress = (steps / goals.steps) * 100;
                const workoutProgress = ((hours * 60 + minutes) / (goals.workout.hours * 60 + goals.workout.minutes)) * 100;
                const weightProgress = (weight / goals.weight) * 100;

                updateProgress('steps', stepsProgress, `${steps} / ${goals.steps}`);
                updateProgress('workout', workoutProgress, `${hours} Hours ${minutes} Minutes / ${goals.workout.hours} Hours ${goals.workout.minutes} Minutes`);
                updateProgress('weight', weightProgress, `${weight}kg / ${goals.weight}kg`);
            }

            function updateProgress(type, progress, value) {
                const progressElement = getElement(`${type}-progress`);
                const valueElement = getElement(`${type}-value`);
                if (progressElement) progressElement.style.width = `${progress}%`;
                if (valueElement) valueElement.textContent = value;
            }

            function updateGoalsDisplay() {
                const stepsValue = getElement('steps-value');
                const workoutValue = getElement('workout-value');
                const weightGoalValue = getElement('weight-goal-value');

                if (stepsValue) stepsValue.textContent = `0 / ${goals.steps}`;
                if (workoutValue) workoutValue.textContent = `0 Hours 0 Minutes / ${goals.workout.hours} Hours ${goals.workout.minutes} Minutes`;
                if (weightGoalValue) weightGoalValue.textContent = `${goals.weight}kg`;
            }

            // Initialize the display with default goals
            updateGoalsDisplay();
        });
    </script>
        
        <footer>
            <h5>&copy; 2024 Fitness and Wellness. All rights reserved.</h5>
        </footer>
        
        
    </body>
</html>
