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
            
            .white-text {
                color: white;
            }
            
            .faq-item {
                margin-bottom: 20px;
            }
            
            .question {
                font-weight: bold;
                color: white;
            }
            
            .answer {
                color: aquamarine;
                margin-top:5px;
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
                        <a href="">Help</a>
                    </div>
                </div> 
            </div>
        </nav>
        
        <div class="container">
        <h1>Frequently Asked Questions</h1>
        
        <div class="faq-item">
            <div class="question">What services do you offer?</div>
            <div class="answer">We offer a range of services including personal training, nutrition counseling, and wellness coaching.</div>
        </div>
        <br>
        <div class="faq-item">
            <div class="question">How can I book a session?</div>
            <div class="answer">You can book a session by visiting our website and selecting the desired service under the 'Services' section.</div>
        </div>
        <br>
        <div class="faq-item">
            <div class="question">What are your operating hours?</div>
            <div class="answer">Our operating hours are Monday to Friday from 9 AM to 6 PM. We are closed on weekends and public holidays.</div>
        </div>
        <br>
        <div class="faq-item">
            <div class="question">Do you offer online sessions?</div>
            <div class="answer">Yes, we offer online sessions for clients who prefer remote training and coaching.</div>
        </div>
        <br>
        <div class="faq-item">
            <div class="question">How can I contact customer support?</div>
            <div class="answer">You can reach our customer support team via email at <a href="mailto:support@fitnessandwellness.com">support@fitnessandwellness.com</a>.</div>
        </div>
        <br>
        <div class="faq-item">
            <div class="question">What payment methods do you accept?</div>
            <div class="answer">We accept payments via credit/debit cards and PayPal. Cash payments are not accepted.</div>
        </div>
        <br>
        <div class="faq-item">
            <div class="question">Can I cancel my session?</div>
            <div class="answer">Yes, you can cancel your session up to 24 hours in advance to receive a full refund. Late cancellations may incur a fee.</div>
        </div>
        <br>
        <div class="faq-item">
            <div class="question">Is there a minimum age requirement for your services?</div>
            <div class="answer">Yes, our services are available to individuals aged 18 years and older. Parental consent is required for minors.</div>
        </div>
        <br>
        <div class="faq-item">
            <div class="question">Do you offer customized diet plans?</div>
            <div class="answer">Yes, we provide personalized diet plans tailored to your specific health and fitness goals.</div>
        </div>
        <br>
        <div class="faq-item">
            <div class="question">Where are you located?</div>
            <div class="answer">Our main office is located at [Address], City, State, Zip Code, Country.</div>
        </div>
        <br>
    </div>
     
    <div class="container">
        <h2>Join Our Community</h2>
        <p>Become a part of our vibrant community dedicated to health and wellness. Whether you're starting your fitness journey or seeking to maintain a balanced lifestyle, join us in embracing the benefits of a healthier life together. Connect with like-minded individuals, access valuable resources, and explore personalized support to achieve your wellness goals.</p>
        <a href="register.php">Join Us</a>
    </div>
        
    </body>
    
    <footer>
        <h5><i><small>&copy; 2024 Fitness and Wellness. All rights reserved.</h5></i><small>
    </footer>
</html>