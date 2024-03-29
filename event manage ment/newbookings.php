<?php
// Assuming you have a database connection established here
require_once "db_connect.php";

// Fetch all bookings from the database
$bookingQuery = "SELECT * FROM bookings WHERE `order` = 'Pending'";
$bookingResult = $mysqli->query($bookingQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new Bookings</title>

    <link rel="stylesheet" href="asset/css/main.css" />
    <style>
    /* Style for buttons */
    .start-button,
    .close-button {
        padding: 8px 16px;
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    .close-button {
        background-color: #f44336;
        /* Red */
    }
    h1 {
        margin: 25px;
    }
    </style>


</head>

<body>
    <div class="content">
        <div class="dashboard">

            <h2>Admin</h2>
            <ul>
                <li><a href="adminhomepage.php">Dashboard</a></li>
                <li><a href="newbookings.php" class="active">New Bookings</a></li>
                <li><a href="viewbooking.php">View Bookings</a></li>
                <li><a href="add_catogery.php">Add Category</a></li>
                <li><a href="view_catogery.php">View Category</a></li>
                <li><a href="feedback_view.php">Veiw Feedback</a></li>
                <li><a href="index.html">LogOut</a></li>
            </ul>
        </div>

        <div class="maincontent">
            <h1>Admin Dashboard</h1>
            <?php
    if ($bookingResult->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Booking ID</th><th>Booker Name</th><th>Event Type</th><th>Event Place</th><th>No. of Guests</th><th>Date</th><th>Dj Service</th><th>Stage setup</th><th>Sound System</th><th>Foodtype</th><th>Breakfast</th><th>Lunch</th><th>Tea&Snaks</th>
        <th>Dinner</th><th>Veg</th><th>Non Veg</th><th>Lightings</th><th>Flowers</th><th>Seating</th><th>Total Cost</th><th>Payment id</th><th>Action</th></tr>";
        while ($row = $bookingResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["bookername"] . "</td>";
            echo "<td>" . $row["category"] . "</td>";
            echo "<td>" . $row["place"] . "</td>";
            echo "<td>" . $row["guests"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["dj"] . "</td>";
            echo "<td>" . $row["stage"] . "</td>";
            echo "<td>" . $row["sound"] . "</td>";
            echo "<td>" . $row["foodtype"] . "</td>";
            echo "<td>" . $row["breakfast"] . "</td>";
            echo "<td>" . $row["lunch"] . "</td>";
            echo "<td>" . $row["tea"] . "</td>";
            echo "<td>" . $row["dinner"] . "</td>";
            echo "<td>" . $row["veg"] . "</td>";
            echo "<td>" . $row["nonveg"] . "</td>";
            echo "<td>" . $row["light"] . "</td>";
            echo "<td>" . $row["flowers"] . "</td>";
            echo "<td>" . $row["seat"] . "</td>";
            echo "<td>" . $row["total_cost"] . "</td>";
            echo "<td>" . ($row["razorpay_payment_id"] != "" ? $row["razorpay_payment_id"] : "Payment Failed") . "</td>";
           
           
            
            echo "<td>";
            if ($row["order"] == "Pending") {
                echo "<a class='start-button' href='accept_booking.php?id=" . $row["id"] . "'>Accept</a>  ";
                echo "<a class='close-button' href='reject_booking.php?id=" . $row["id"] . "'>Reject</a>";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No bookings found.";
    }
    ?>
        </div>
    </div>
</body>

</html>