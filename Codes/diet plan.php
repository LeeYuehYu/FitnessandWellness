<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>FITNESS AND WELLNESS</title>
        
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: hsl(218, 7%, 18%);
            }
            
            header{
                background-color: background;
                color: white;
                padding: 20px 0;
                display: flex;
                text-align: center;
                justify-content: space-between;
            }
            
            header img{
                height: 300px;
                display:block;
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
            
            section{
                padding: 40px;
                text-align:center;
            }
            
            h2 {
                text-align: center;
                color: white;
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
            <img src="img/Fitness and Wellness Logo.png" id="logo">
            
        </header>
        
        <nav>
            <div class="nav-left">
                <div class="profile-icon" id="profile-icon">
                    <a href="profile management.php" id="profile-link">
                        <img id="profile-image" src="img/profile_icon.png" alt="Profile Icon">
                    </a>
                </div>
            </div>
            
            <div class="nav-right"> 
                <a href="progress tracking.php" target=_self>Home</a>

                <a href="about us.php" target=_self >About Us</a>

                <div class="dropdown">
                    <a href="" target=_self >Services</a>
                    <div class="dropdown-content">
                        <a href="healthcare.php">Healthcare</a>
                        <a href="fitness.php">Fitness</a>
                        <a href="sessions.php">Sessions</a>
                        <a href="diet plan.php">Diet Plan</a>
                    </div>
                </div> 

                <a href="contact us.php" target=_self title="This takes you to contact us">Contact Us</a>

                <div class="dropdown"> 
                <a href="#">More</a>
                    <div class="dropdown-content">
                        <a href="feedback.php">Feedback</a>
                        <a href="FAQ.php">Help</a>
                    </div>
                </div> 
            </div>
        </nav>
        
        <section>
                 <h1 class="white-text"><big>Healthy Recipes You Can Try!</h1></big>
            <p class="white-text"><i><small>Your diet is your bank account, Good food choices are good investments.
            </p></i></small>   
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
                        <a href="#">Read more>>></a>
                    </div> 
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Meditation" alt="Meditation">
                        <h3>The Benefits of Meditation for Mental Health</h3>
                        <p>Learn how incorporating meditation into your daily routine can reduce stress and improve your mental well-being.</p>
                        <a href="#">Read more>>></a>
                    </div>

                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#">Read more>>></a>
                    </div>
                    <div class="articles">
                    <img src="https://via.placeholder.com/150x150.png?text=Meditation" alt="Meditation">
                    <h3>The Benefits of Meditation for Mental Health</h3>
                    <p>Learn how incorporating meditation into your daily routine can reduce stress and improve your mental well-being.</p>
                    <a href="#">Read more>>></a>
                    </div>

                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#">Read more>>></a>
                    </div>
                    
                    <div class="articles">
                        <img src="https://via.placeholder.com/150x150.png?text=Exercise" alt="Exercise">
                        <h3>10 Essential Exercises for a Full-Body Workout</h3>
                        <p>Discover the most effective exercises to target all major muscle groups and improve your overall fitness.</p>
                        <a href="#">Read more>>></a>
                    </div>
                </div>            
        </section>
        
        <script>
            document.getElementById('profile-icon').addEventListener('click', function() {
                window.location.href = 'profile management.php';
            });
        </script>
        
        <footer>
            <h5>&copy; 2024 Fitness and Wellness. All rights reserved.</h5>
        </footer>
        
        
    </body>
</html>
