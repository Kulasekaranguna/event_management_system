<?php
// Include database connection
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category_name = $_POST["categoryName"];
    

    $createTableQuery = "CREATE TABLE IF NOT EXISTS categories (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        category_name VARCHAR(30) NOT NULL
    )";
    if ($mysqli->query($createTableQuery) !== TRUE) {
        echo "Error creating table: " . $mysqli->error;
    }

    // Insert the new category into the database
    $insertQuery = "INSERT INTO categories (category_name) VALUES ('$category_name')";

    if ($mysqli->query($insertQuery) !== TRUE) {
        echo "Error adding category: " . $mysqli->error;
    } else {
        echo "<p>Category added successfully!</p>";
    }

    // Close the database connection
    $mysqli->close();
}
?>