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
        
        <div class="container">
            <h1>About Us</h1>
            <h2>Our Mission</h2>
            <p>At Fitness and Wellness, our mission is to empower individuals to lead healthier and happier lives through comprehensive fitness and wellness solutions. We aim to provide accessible and personalized resources that inspire positive lifestyle changes, fostering physical and mental well-being for everyone.</p>
        </div>
        <div class="container">
            <h2>Our Vision</h2>
            <p>At Fitness and Wellness, our vision is to lead a global movement towards holistic health, where every individual embraces a balanced lifestyle that nurtures both body and mind. We envision a future where wellness is not just a goal but a way of life, accessible to all, supported by evidence-based practices and innovative technologies.</p>
        </div>
        
        <div class="container">
            <h2>Our Team</h2>
            <p>
                Our team comprises dedicated professionals who bring a diverse range of expertise to our organization. From certified fitness trainers and nutritionists to experienced wellness coaches and digital innovators, each member of our team is united by a shared commitment to promoting holistic health. Together, we strive to create impactful experiences and transformative solutions that empower our community to achieve their wellness goals effectively and sustainably.

Join us on this journey towards a healthier tomorrow, where fitness meets wellness to inspire a life well-lived.

            <div class="team-member">
                <img src="img/john doe.jpeg" alt="Team Member 1">
                <div class="info">
                    <h3>John Doe</h3>
                    <p>Co-founder & Fitness Trainer</p>
                    <p>As our lead fitness trainer, John combines years of experience in personal training with a deep knowledge of exercise physiology and nutrition. His dedication to helping clients achieve their fitness goals is matched only by his enthusiasm for promoting overall wellness.</p>
                </div>
            </div>

            <div class="team-member">
                <img src="img/Jane smith.jpeg" alt="Team Member 2">
                <div class="info">
                    <h3>Jane Smith</h3>
                    <p>Nutritionist & Wellness Coach</p>
                    <p>Jane is our resident nutritionist with a background in clinical dietetics and a passion for healthy eating. She works closely with clients to develop customized nutrition plans that support their fitness objectives while ensuring they enjoy delicious and nourishing meals.</p>
                </div>
            </div>

            <div class="team-member">
                <img src="img/michael brown.jpeg" alt="Team Member 3">
                <div class="info">
                    <h3>Michael Brown</h3>
                    <p>Personal Trainer</p>
                    <p>Michael brings expertise in digital wellness solutions, leveraging his background in software engineering and user experience design. His innovative approach ensures our digital platforms deliver engaging and effective tools for tracking progress, accessing resources, and staying motivated on the wellness journey.</p>
                </div>
            </div>
        </div>
        
        <div class="container">
            <h2>Our Story</h2>
            <p>Founded with a passion for health and a vision for a better quality of life, Fitness and Wellness began as a humble initiative driven by a team of fitness enthusiasts and wellness experts. We started with a simple goal: to make wellness practices and fitness routines more accessible and enjoyable for people of all ages and backgrounds. Over the years, our commitment to excellence and innovation has fueled our growth into a trusted resource in the health and wellness community.</p>
        </div>
        
        <div class="container">
            <h2>Contact Us</h2>
            <p>If you have any questions or inquiries, feel free to contact us at: 
                <br><br>
            <a href="#" target="_self"><i class="fab fa-instagram"></i>Instagram</a>
                
                <a href="#" target="_self"><i class="fab fa-twitter"></i>Twitter</a>
                
                <a href="#" target="_self"><i class="fab fa-phone"></i>04-3456789</a>
                
                <a href="mailto:enquiry@fitnessandwellness.com" target="Email"><i class="fab fa-envelope"></i>enquiry@fitnessandwellness.com</a>
            </p>
        </div>
        
        <div class="container">
            <h2>Join Our Community</h2>
            <p>Become a part of our vibrant community dedicated to health and wellness. Whether you're starting your fitness journey or seeking to maintain a balanced lifestyle, join us in embracing the benefits of a healthier life together. Connect with like-minded individuals, access valuable resources, and explore personalized support to achieve your wellness goals.</p>
            <a href="register.php">Join Us</a>
        </div>
        
        <div class="container">
            <h2>Join Our Team</h2>
            <p>Are you passionate about health and wellness? Join our dynamic team of professionals committed to making a positive impact on the lives of others. We offer opportunities for growth, collaboration, and innovation in a supportive environment that values expertise and creativity. Together, we strive to create meaningful experiences and transformative solutions that empower individuals and communities to thrive.

Join us on this journey towards a healthier tomorrow, where fitness meets wellness to inspire a life well-lived.</p>
            <div class="social-icons">
                <a href="mailto:joinourteam@fitnessandwellness.com" target="Email"><i class="fab fa-envelope"></i>joinourteam@fitnessandwellness.com</a>
            </div>       
        </div>
        
    </body>
    
    <footer>
        <h5>&copy; 2024 Fitness and Wellness. All rights reserved.</h5>
    </footer>
</html>
