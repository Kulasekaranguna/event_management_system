<?php
// Assuming you have a database connection established here
require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $bookingId = $_GET['id'];
    
    // Update the status of the booking to "Rejected"
    $updateQuery = "UPDATE bookings SET status = 'The event commences today.' WHERE id = $bookingId";

    if ($mysqli->query($updateQuery) !== TRUE) {
        echo "Error updating booking status: " . $mysqli->error;
    } else {
        echo "status update successfully !";
    }
} else {
    echo "Invalid request.";
}
?>
