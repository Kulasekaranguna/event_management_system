<?php
// Assuming you have already established a database connection in db_connect.php
require_once "db_connect.php";

// Check if the date is provided in the POST request
if(isset($_POST['date'])) {
    // Sanitize the input to prevent SQL injection
    $date = $mysqli->real_escape_string($_POST['date']);

    // Query to check if the date exists in the bookings table
    $checkDateQuery = "SELECT * FROM bookings WHERE date = '$date'";
    $result = $mysqli->query($checkDateQuery);

    if ($result->num_rows > 0) {
        // If date already exists, echo "unavailable"
        echo "unavailable";
    } else {
        // If date is available, echo "available"
        echo "available";
    }
} else {
    // If date is not provided in the POST request, echo "invalid"
    echo "invalid";
}
?>
