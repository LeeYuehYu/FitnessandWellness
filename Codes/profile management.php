<!DOCTYPE html>
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
            
            .container {
                max-width: 700px;
                margin: 70px auto;
                padding: 40px;
                background-color: activeborder;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            
            h2 {
                text-align: center;
                color: white;
            }
            
            label {
                color: white;
                display: block;
                margin-top: 10px;
            }
            
            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="file"],
            input[type="tel"],
            input[type="date"]{
                width: 100%;
                padding: 10px;
                margin-top: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
            }
            
            input[type="submit"] {
                width: 100%;
                padding: 10px;
                background-color: aquamarine;
                color: black;
                border: none;
                border-radius:5px;
                cursor: pointer;
            }
            
            input[type="submit"]:hover {
                background-color: chartreuse;
            }
            
            .error-message {
                color: red;
                margin-top: 5px;
            }
            
            .success-message {
                color:green;
                margin-top: 5px;
            }
            
            .profile-message {
               display: flex;
               align-items: center;
               justify-content: center;
               margin-top: 20px;
            }
            
            .profile-picture {
                text-align: center;
                margin-bottom: 20px;
                margin-top: 20px;
            }
            
            .profile-picture img {
                max-width: 50px;
                max-height: 50px;
                border-radius: 50%;
                margin-right: 10px;
                overflow: hidden;
            }
            
            .profile-picture img, .preview {
                max-width: 50px;
                max-height: 50px;
                border-radius: 50%;
                margin-right: 10px;
                object-fit: cover;
            }
            
            .profile-buttons {
                margin-top: 20px;
                text-align: center;
            }
            
            .profile-buttons button {
                margin: 10px;
            }
            
            .profile-icon {
                position: relative;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                overflow: hidden;
                cursor: pointer;
                margin-right: 20px;
                }
            
            .profile-icon img {
                width: 50px;
                height: 50px;
                object-fit: cover;
            }
            
            .preview {
                max-width: 30px;
                max-height: 30px;
                border-radius: 50%;
                object-fit: cover;
                display: none;
            }
            
            select{
                width: 100%;
                padding: 10px;
                margin-top: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
            }
            
            select option {
                background-color: grey;
                color: black;
            }
            select option:hover {
                background-color: darkgrey;
            }

            .buttons {
                display: flex;
                justify-content: flex-end;
            }

            .buttons button{
                margin-left:10px;
            }
            
            footer{
                background-color: black;
                color: white;
                padding: 10px 0;
                bottom: 0;
                position: fixed;
                width: 100%;
                text-align: center;
            }
            
        </style>
        
    </head>
<body> 
    <div class="container" id="profile-management">
        <h2>Profile Management</h2>
        <form id="profileForm" method="post" action="save_profile.php" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
            
            <!-- Profile picture input -->
            <div id="profile-pic-form">
                <label for="profile-pic">Profile Picture: </label>
                <input type="file" id="profile-pic" name="profile-picture" accept="image/*">
                <img id="preview" src="img/profile_icon.png" alt="Profile Preview" style="display: block;width:250px;">
            </div>
            
            <!-- Other profile fields -->
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Username" required>
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Name" required> 
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Email" required>
            <label for="phone_number">Phone Number:</label>
            <input type="tel" name="phone_number" placeholder="Phone Number" required> 
            <label for="birthday">Birthday:</label>
            <input type="date" name="birthday" required>
            
            <label for="gender">Gender: </label>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="others">Others</option>
            </select>
            
            <label for="height">Height (cm):</label>
            <input type="text" name="height" placeholder="Height" required>
            <label for="weight">Weight (kg):</label>
            <input type="text" name="weight" placeholder="Weight" required>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Current Password" required>
            
            <!-- Buttons for managing profile -->
            <div class="profile-buttons">
                <button type="submit" id="save-btn">Save</button>
                <a href="progress%20tracking.php"><button type="button" id="cancel-btn">Cancel</button></a>
                <a href="login.php"><button type="button" id="logout-btn">Log Out</button></a>
            </div>
        </form>
        
        <!-- Success and error messages -->
        <div id="successMessage" class="success-message"></div>
        <div id="errorMessage" class="error-message"></div>
    </div>

        <script>
            document.getElementById('profile-pic').addEventListener('change', function(event) {
                const preview = document.getElementById('preview');
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onloadend = function() {
                    preview.src = reader.result;
                    preview.style.display = 'block';
                }

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "img/profile_icon.png";
                    preview.style.display = 'none';
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                const profileForm = document.getElementById('profileForm');
                const profileIcon = document.getElementById('profile-icon');
                const profileLink = document.getElementById('profile-link');
                const profileManagement = document.getElementById('profile-management');
                const saveBtn = document.getElementById('save-btn');
                const cancelBtn = document.getElementById('cancel-btn');
                const profilePicInput = document.getElementById('profile-pic');
                const inputs = profileForm.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], input[type="date"], input[type="password"]');
                const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

                profileLink.href = isLoggedIn ? '/user-profile' : '/login';

                profileLink.addEventListener('click', function(event) {
                    if (!isLoggedIn) {
                        event.preventDefault();
                        window.location.href = '/login';
                    } else {
                        event.preventDefault();
                        profileManagement.style.display = 'block';
                    }
                });

                toggleEditMode(false);

                function toggleEditMode(editMode) {
                    profilePicInput.disabled = !editMode;
                    inputs.forEach(input => input.disabled = !editMode);
                    saveBtn.style.display = editMode ? 'inline' : 'none';
                    cancelBtn.style.display = editMode ? 'inline' : 'none';
                    editBtn.style.display = editMode ? 'none' : 'inline';
                    deleteBtn.style.display = editMode ? 'none' : 'inline';
                }

                saveBtn.addEventListener('click', function() {
                    profileForm.submit();
                });
                
                cancelBtn.addEventListener('click', function() {
                    // Reset form to original values
                    profileForm.reset();
                    toggleEditMode(false);
                });
            });
        </script>
        
        <footer>
            <h5><i><small>&copy; 2024 Fitness and Wellness. All rights reserved.</h5></i><small>
        </footer>
    </body>
</html>
