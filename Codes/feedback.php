<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: hsl(218, 7%, 18%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .feedback-form {
            background: black;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 70px auto;
            display: block;
        }
        .feedback-form h2 {
            margin-bottom: 15px;
            font-size: 24px;
            text-align: center;
            color: white;
        }
        .feedback-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .feedback-form input, .feedback-form textarea, .feedback-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .feedback-form button {
            background-color: aquamarine;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .feedback-form button:hover {
            background-color: aqua;
        }
        
        .white-text {
            color: white;
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
    </style>
</head>
<body>
    <div class="feedback-form">
        <h2>Feedback Form</h2>
        <form id="feedbackForm">
            <label class="white-text" for="name">What is your name?</label>
            <input type="text" id="name" name="name" required>

            <label class="white-text" for="email">Please enter your Email address.</label>
            <input type="email" id="email" name="email" required>

            <label class="white-text" for="rating">What would you rate this website?</label>
            <select id="rating" name="rating" required>
                <option value="5">Excellent</option>
                <option value="4">Very Good</option>
                <option value="3">Good</option>
                <option value="2">Fair</option>
                <option value="1">Poor</option>
            </select>

            <label class="white-text" for="comments">Any comments or feedback you would like to share?</label>
            <textarea id="comments" name="comments" rows="4" required></textarea>
            
            <div class="buttons">
                <button type="submit" id="submit-btn">Submit Feedback</button>
                <a href="progress tracking.php"><button type="button" id="cancel-btn">Cancel</button></a>
            </div>
        </form>
    </div>
<script>
    document.getElementById('feedbackForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Assuming form submission is handled here
        if (confirm('Thank you for your feedback! Your feedback is sent.')) {
            window.location.href = 'progress%20tracking.php'; // Redirect to the progress tracking page
    });
</script>
</body>
</html>
