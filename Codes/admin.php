<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "fitnessandWellness";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize($input) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags($input)));
}

// Handling article deletion
if (isset($_POST['delete_article'])) {
    $article_id = sanitize($_POST['delete_article']);
    $sql_delete = "DELETE FROM articles WHERE id = $article_id";

    if ($conn->query($sql_delete) === TRUE) {
        echo '<script>alert("Article deleted successfully");</script>';
    } else {
        echo '<script>alert("Error deleting article: ' . $conn->error . '");</script>';
    }
}

// Query to fetch articles from the database
$sql = "SELECT * FROM articles"; // Assuming 'articles' is your table name
$result = $conn->query($sql);

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
    <title>Admin - FITNESS AND WELLNESS</title>
    <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: bisque;
            }
            
            header{
                background-color: white;
                color: black;
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
                background-color: beige;
                padding: 10px 20px;
                justify-content: space-between;
                display: flex;
                align-items: center;
            }
            
            .nav-left{
                flex: 1;
                display: flex;
                align-items: center;
            }

            .nav-center{
                flex: 1;
                text-align: center;
            }
            
            nav a{
                color: black;
                text-decoration: none;
                padding: 10px 15px;
            }
            
            nav a:hover{
                color: dodgerblue;
            }
            
            .dropdown{
                position:relative;
                display: inline-block;
            }
            
            .dropdown-content{
                display: none;
                position: absolute;
                background-color: antiquewhite;
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
                background-color: whitesmoke;
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
                color: black;
            }
            
            h1 {
                text-align: center;
                color: black;
            }
            
            .section{
                padding: 40px;
                text-align:center;
            }
            
            main {
                padding: 20px;
                max-width: 800px;
                margin: 0 auto;
            }
            
            label {
                display: block;
                margin: 10px 0 5px;
            }
            
            input[type="text"], textarea {
                width: 100%;
                padding: 8px;
                margin: 5px 0 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            
            
            table, th, td {
                border: 1px solid #ddd;
            }
            
            th, td {
                padding: 10px;
                text-align: left;
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
                <a href="admin_profile.html" id="profile-link">
                    <img id="profile-image" src="img/profile_icon.png" alt="Profile Icon">
                </a>
            </div>
        </div>
        <div class="nav-center">
            <h1 style="margin: 0 auto;">Admin Dashboard</h1>
        </div>
    </nav>

    <main>
    <section id="add-article">
            <h2><u>Add New Article</u></h2>
            <form id="addArticleForm" method="post" action="add_article.php">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
                <br><br>
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="10" required></textarea>
                <br><br>
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
                <br><br>
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>
                <br><br>
                <button type="submit">Add Article</button>
            </form>
        </section>

        <section id="articles-list">
        <h2>Existing Articles</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["title"] . "</td>
                                <td>" . $row["author"] . "</td>
                                <td>" . $row["category"] . "</td>
                                <td>
                                    <form method='POST' style='display: inline;'>
                                        <input type='hidden' name='delete_article' value='" . $row["id"] . "'>
                                        <button class='delete-button'>Delete</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No articles found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        </section>
        <section id="user-accounts">
            <h2>User Accounts</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Height (cm)</th>
                        <th>Weight (kg)</th>
                        <th>Registration Date</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userAccountsTableBody">
                    <!-- User account rows will be populated here via JavaScript -->
                </tbody>
            </table>
        </section>

    </main>

    <script>
        // Sample data, replace with data from your backend
        const articles = [
            { id: 1, title: "First Article", author: "Admin", category: "Fitness" },
            { id: 2, title: "Second Article", author: "Admin", category: "Wellness" },
        ];

        function populateArticles() {
            const articlesTableBody = document.getElementById('articlesTableBody');
            articlesTableBody.innerHTML = '';

            articles.forEach(article => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${article.id}</td>
                    <td>${article.title}</td>
                    <td>${article.author}</td>
                    <td>${article.category}</td>
                    <td>
                        <button onclick="deleteArticle(${article.id})">Delete</button>
                    </td>
                `;
                articlesTableBody.appendChild(row);
            });
        }
        
        document.getElementById('addArticleForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const formData = new FormData(this);

            // Optional: You can validate form data here before sending it to the server

            // Example: Send form data to the server using fetch API
            fetch('add_article.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Assuming server responds with JSON data
            })
            .then(data => {
                // Handle successful response from server
                console.log('Article added successfully:', data);
                // Optionally, reset the form or perform other actions after successful submission
                document.getElementById('addArticleForm').reset();
            })
            .catch(error => {
                // Handle errors
                console.error('Error adding article:', error);
                // Optionally, display an error message to the user
            });
        });


        function editArticle(articleId) {
            const article = articles.find(a => a.id === articleId);
            if (article) {
                document.getElementById('editArticleId').value = article.id;
                document.getElementById('editTitle').value = article.title;
                document.getElementById('editContent').value = article.content;
                document.getElementById('editAuthor').value = article.author;
                document.getElementById('editCategory').value = article.category;
                
                document.getElementById('add-article').style.display = 'none';
                document.getElementById('edit-article').style.display = 'block';
            }
        }

        function cancelEdit() {
            document.getElementById('editArticleForm').reset();
            document.getElementById('add-article').style.display = 'block';
            document.getElementById('edit-article').style.display = 'none';
        }

        function deleteArticle(articleId) {
            if (confirm('Are you sure you want to delete this article?')) {
                // Implement delete functionality here
                console.log(`Article ${articleId} deleted`);
            }
        }

        // Populate articles on page load
        document.addEventListener('DOMContentLoaded', populateArticles);

        // Add new article form submission handling
        document.getElementById('addArticleForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            const formData = new FormData(this); // Get form data

            fetch('add_article.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Assuming server responds with JSON data
            })
            .then(data => {
                // Handle successful response from server
                console.log('Article added successfully:', data);

                // Add the new article to the DOM
                const newArticle = {
                    id: data.id, // Assuming the server returns the new article ID
                    title: formData.get('title'),
                    author: formData.get('author'),
                    category: formData.get('category')
                };

                articles.push(newArticle); // Add new article to local data

                // Update the UI
                const articlesTableBody = document.getElementById('articlesTableBody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${newArticle.id}</td>
                    <td>${newArticle.title}</td>
                    <td>${newArticle.author}</td>
                    <td>${newArticle.category}</td>
                    <td>
                        <button onclick="editArticle(${newArticle.id})">Edit</button>
                        <button onclick="deleteArticle(${newArticle.id})">Delete</button>
                    </td>
                `;
                articlesTableBody.appendChild(newRow);

                // Optionally reset the form or perform other actions
                document.getElementById('addArticleForm').reset();
            })
            .catch(error => {
                // Handle errors
                console.error('Error adding article:', error);
                // Optionally display an error message to the user
            });
        });
        
        // Sample data for user accounts, replace with actual data from your backend
        const users = [
            { id: 1, username: "john_doe", name: "John Doe", age: 30, dateOfBirth: "1994-05-25", gender: "Male", height: "180 cm", weight: "75 kg", registrationDate: "2023-01-15", lastLogin: "2024-07-04", role: "Admin" },
            { id: 2, username: "jane_smith", name: "Jane Smith", age: 28, dateOfBirth: "1996-08-12", gender: "Female", height: "165 cm", weight: "60 kg", registrationDate: "2023-02-20", lastLogin: "2024-07-04", role: "User" }
        ];

        function populateUserAccounts() {
            const userAccountsTableBody = document.getElementById('userAccountsTableBody');
            userAccountsTableBody.innerHTML = '';

            users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.role}</td>
                    <td>${user.username}</td>
                    <td>${user.name}</td>
                    <td>${user.age}</td>
                    <td>${user.dateOfBirth}</td>
                    <td>${user.gender}</td>
                    <td>${user.height}</td>
                    <td>${user.weight}</td>
                    <td>${user.registrationDate}</td>
                    <td>${user.lastLogin}</td>
                    <td>
                        <button onclick="editUser(${user.id})">Edit</button>
                        <button onclick="deleteUser(${user.id})">Delete</button>
                    </td>
                `;
                userAccountsTableBody.appendChild(row);
            });
        }

        // Function to edit a user (similar to editArticle function)
        function editUser(userId) {
            const user = users.find(u => u.id === userId);
            if (user) {
                // Implement edit functionality as needed
                console.log(`Editing user ${userId}`);
            }
        }

        // Function to delete a user (similar to deleteArticle function)
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                // Implement delete functionality here
                console.log(`User ${userId} deleted`);
            }
        }

        // Populate user accounts on page load
        document.addEventListener('DOMContentLoaded', populateUserAccounts);


    </script>
</body>
</html>
