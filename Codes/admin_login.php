<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: hsl(218, 7%, 18%);
            color: white;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: activeborder;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: white;
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 100%;
            padding: 10px;
            background-color: aquamarine;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: aliceblue;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: aquamarine;
            color: black;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        footer {
            background-color: black;
            color: white;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="POST">
            <input type="text" id="username" name="username" placeholder="Username">
            <input type="password" id="password" name="password" placeholder="Password">
            <button type="button" onclick="login()">Login</button>
        </form>

    </div>

    <script>
        function login() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // This is a simple example. In a real application, you would validate against a server.
            if (username === 'admin' && password === '123') {
                // Redirect to admin dashboard or perform other actions
                window.location.href = 'admin.php';
            } else {
                alert('Invalid username or password');
            }
        }
    </script>
    <footer>
        <h5><i><small>&copy; 2024 Fitness and Wellness. All rights reserved.</small></i></h5>
    </footer>
</body>
</html>
