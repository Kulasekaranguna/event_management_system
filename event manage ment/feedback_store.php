<?php
require_once "db_connect.php";

// Collect feedback data from the form
$name = $_POST['name'];
$feedback = $_POST['feedback'];

    // Create users table if not exists
    $createTableQuery = "CREATE TABLE IF NOT EXISTS feedback (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        feedback VARCHAR(255) NOT NULL
        
    )";

    if ($mysqli->query($createTableQuery) !== TRUE) {
        echo "Error creating table: " . $mysqli->error;
    }

// Prepare SQL statement to insert feedback into the database
$sql = "INSERT INTO feedback (name, feedback) VALUES ('$name', '$feedback')";

if ($mysqli->query($sql) === TRUE) {
    echo "Thank you for your feedback!";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

// Close database connection
$mysqli->close();
?>
