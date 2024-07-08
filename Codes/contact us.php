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
            
            .social-icons a {
                color: aquamarine;
                text-decoration: none;
                margin: 0 10px;
            }
            
            .social-icons a:hover {
                color: aqua;
                text-decoration: underline;
            }
            
            h2 {
                text-align: center;
                color: white;
            }
            
            .white-text {
                color: white;
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
                <a href="progress tracking.php" target=_self >Home</a>

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
            <h2>CONTACT US</h2>
            
            <div class="social-icons">
                
                <a href="#" target="_self"><i class="fab fa-phone"></i>04-3456789</a>
                
                <a href="mailto:enquiry@fitnessandwellness.com" target="Email"><i class="fab fa-envelope"></i>enquiry@fitnessandwellness.com</a>
                
            </div>
            <br><br><br>
                <h2>Join Our Community</h2>
                
                <div class="social-icons">
                    <a href="#" target="_self"><i class="fab fa-discord">Discord</i></a>
                        
                    <a href="#" target="_self"><i class="fab fa-instagram"></i>Instagram</a>
                    
                    <a href="#" target="_self"><i class="fab fa-twitter"></i>Twitter</a>
                        
                </div>
            <br><br><br>
                <h2>Join Our Team</h2>
                
                <div class="social-icons">
                    <a href="mailto:joinourteam@fitnessandwellness.com" target="Email"><i class="fab fa-envelope"></i>joinourteam@fitnessandwellness.com</a>
                        
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
