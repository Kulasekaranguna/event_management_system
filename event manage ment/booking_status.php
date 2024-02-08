<?php
// Assuming you have a database connection established here
require_once "db_connect.php";

session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION['user_details'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['user_details']['username'];

// Fetch booking details for the logged-in user
$bookingQuery = "SELECT * FROM bookings WHERE bookername = '$username'";
$bookingResult = $mysqli->query($bookingQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <!-- Add your CSS stylesheets here -->
    
    <link rel="stylesheet" href="asset/css/main.css">
 
</head>
<body>
<div class="content">
      <div class="dashboard">
      
      <h2>Customer</h2>
        <ul>
          <li><a href="customerhomepage.php" class="active">Your Details</a></li>
          <li><a href="bookevent.php">Book Event</a></li>
          <li><a href="booking_status.php">Booking Status</a></li>
         
          <li><a href="feedback.html">Feedback</a></li>

          <li><a href="index.html">LogOut</a></li>
        </ul>
      </div>
      
      <div class="maincontent">
    <h1>Booking Status</h1>
    <?php
    if ($bookingResult->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Booking ID</th><th>Event Type</th><th>Event Place</th><th>No. of Guests</th><th>Date</th><th>Total Cost</th><th>Status</th></tr>";
        while ($row = $bookingResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["category"] . "</td>";
            echo "<td>" . $row["place"] . "</td>";
            echo "<td>" . $row["guests"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["total_cost"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No bookings found for this user.";
    }
    ?>
    </div>
</div>
</body>
</html>
