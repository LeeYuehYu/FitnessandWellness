<?php
session_start(); // Start session if not already started
require_once 'db_connect.php'; // Include your database connection script

// Initialize variables to store form data
$title = $content = $author = $category = '';
$title_err = $content_err = $author_err = $category_err = '';

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    if (empty(trim($_POST["title"]))) {
        $title_err = "Please enter a title.";
    } else {
        $title = trim($_POST["title"]);
    }

    // Validate content
    if (empty(trim($_POST["content"]))) {
        $content_err = "Please enter content.";
    } else {
        $content = trim($_POST["content"]);
    }

    // Validate author
    if (empty(trim($_POST["author"]))) {
        $author_err = "Please enter an author.";
    } else {
        $author = trim($_POST["author"]);
    }

    // Validate category
    if (empty(trim($_POST["category"]))) {
        $category_err = "Please enter a category.";
    } else {
        $category = trim($_POST["category"]);
    }

    // Check input errors before inserting into database
    if (empty($title_err) && empty($content_err) && empty($author_err) && empty($category_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO articles (title, content, author, category) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_title, $param_content, $param_author, $param_category);

            // Set parameters
            $param_title = $title;
            $param_content = $content;
            $param_author = $author;
            $param_category = $category;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Article added successfully, redirect to the same page
                header("Location: add_article.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
?>