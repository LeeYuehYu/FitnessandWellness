<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
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

            .section,
            section {
                padding: 40px;
                text-align:center;
            }
            
            .container {
                max-width: 800px;
                margin: 20px auto;
                padding: 20px;
                background-color: black;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }

            h1, h2 {
                text-align: center;
                color: white;
            }

            p {
                line-height: 1.6;
                color: aquamarine;
            }
            
            .team-member {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
                color: white;
            }
            
            .team-member img {
                width: 80px;
                height: 80px;
                border-radius:50%;
                margin-right:20px;
            }
            
            .team-member .info {
                flex: 1;
            }
            
            .team-member h3 {
                margin: 5px 0;
                color: white;
            }
            
            .team-member p {
                margin: 5px 0;
                color: aquamarine;
            }
            
            .white-text {
                color: white;
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
                    <a href="login.php" id="profile-link">
                        <img id="profile-image" src="img/profile_icon.png" alt="Profile Icon">
                    </a>
                </div>
            </div>
            
            <div class="nav-right"> 
                <a href="homepage.php" target=_self >Home</a>

                <a href="services.php" target=_self >Services</a> 

                <div class="dropdown"> 
                <a href="#">More</a>
                    <div class="dropdown-content">
                        <a href="FAQ1.php">Help</a>
                    </div>
                </div> 
            </div>
        </nav>
        
        <h1 class="white-text">Services</h1>
        
        <div class="container">
            <h2>Fitness</h2>
            <p>Achieve your fitness goals with personalized training programs designed by our expert fitness trainers. Whether you're looking to build strength, improve endurance, or enhance flexibility, we provide tailored workouts that fit your lifestyle and preferences.</p>
        </div>
        <br>
        <div class="container">
            <h2>Wellness</h2>
            <p>Embrace holistic wellness with our range of services aimed at nurturing your mental and emotional health. From mindfulness practices to stress management techniques, we offer resources to help you achieve balance and inner peace.</p>
        </div>
        <br>
        <div class="container">
            <h2>Healthcare</h2>
            <p>Access reliable healthcare information and advice from professionals in the field. Stay informed about preventive care, medical conditions, and treatments to make informed decisions about your health.</p>
        </div>
        <br>
        <div class="container">
            <h2>Diet Plan</h2>
            <p>Discover nutritious and delicious meal plans tailored to your dietary needs and fitness goals. Our nutritionists provide guidance on healthy eating habits that support overall well-being and optimize your energy levels.</p>
        </div>
        <br>
        <div class="container">
            <h2>More</h2>
            <p>Explore our comprehensive resources and join a community dedicated to empowering individuals to lead healthier lives, both physically and mentally.</p>
        </div>
        <br>
        <div class="container">
            <h2>Join Our Team</h2>
            <p>Are you passionate about health and wellness? Join our dynamic team of professionals committed to making a positive impact on the lives of others. We offer opportunities for growth, collaboration, and innovation in a supportive environment that values expertise and creativity. Together, we strive to create meaningful experiences and transformative solutions that empower individuals and communities to thrive.

Join us on this journey towards a healthier tomorrow, where fitness meets wellness to inspire a life well-lived.</p>

            <a href="mailto:joinourteam@fitnessandwellness.com" target="Email"><i class="fab fa-envelope"></i>joinourteam@fitnessandwellness.com</a>
        </div>
        <br>
        <div class="container">
            <h2>Join Our Community</h2>
            <p>Become a part of our vibrant community dedicated to health and wellness. Whether you're starting your fitness journey or seeking to maintain a balanced lifestyle, join us in embracing the benefits of a healthier life together. Connect with like-minded individuals, access valuable resources, and explore personalized support to achieve your wellness goals.</p>
            <a href="register.php">Join Us</a>
        </div>
        
    </body>
    
    <footer>
        <h5>&copy; 2024 Fitness and Wellness. All rights reserved.</h5>
    </footer>
</html>
