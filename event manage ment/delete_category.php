<?php
// Include database connection
include 'db_connect.php';

// Check if ID parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the ID input to prevent SQL injection
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);

    // Construct the SQL query to delete the feedback entry with the provided ID
    $sql = "DELETE FROM categories WHERE id = '$id'";

    // Execute the query
    if ($mysqli->query($sql)) {
        // If deletion is successful, redirect back to the feedback view page
        header("Location: view_catogery.php");
        exit(); // Ensure script execution stops after redirection
    } else {
        // If an error occurs during deletion, display an error message
        echo "Error: " . $mysqli->error;
    }
} else {
    // If no ID parameter is provided, display an error message
    echo "Error: Feedback ID not provided.";
}

// Close database connection
$mysqli->close();
?>