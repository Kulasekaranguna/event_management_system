<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status</title>
    <!-- Add your CSS stylesheets here -->
    <link rel="stylesheet" href="asset/css/main.css">
    <style>
          .user-profile {
    margin-bottom: 20px;
    display:flex;
    align-items: center;
    }
    

.dprofile-pic {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    /* Add additional styles as needed */
}

.username {
    font-weight: bold;
    font-size: 18px;
    text-align: ;
    /* Add additional styles as needed */
}
h1{
    margin:25px;
}

    </style>
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
        <div class="user-profile">
        <?php
            session_start(); // Start the session

require_once "db_connect.php";
        // Check if user details are available
        if (isset($_SESSION['user_details'])) {
            $userData = $_SESSION['user_details'];

            // Display profile picture if available
            if (!empty($userData['profile_picture'])) {
                echo "<img src='" . htmlspecialchars($userData['profile_picture']) . "' alt='Profile Picture' class='dprofile-pic'>";
            }

            // Display registered username
            echo "<p class='username'>" . htmlspecialchars($userData['username']) . "</p>";
        }
        ?>
    </div>
            <h1>Booking Status</h1>
            <?php
        require_once "db_connect.php";
    

        // Check if user is logged in
        if (!isset($_SESSION['user_details'])) {
            header("Location: login.php"); // Redirect to login page if not logged in
            exit();
        }

        $username = $_SESSION['user_details']['username'];

        // Fetch booking details for the logged-in user
        $bookingQuery = "SELECT * FROM bookings WHERE bookername = '$username'";
        $bookingResult = $mysqli->query($bookingQuery);

        if ($bookingResult->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Booking ID</th><th>Event Type</th><th>Event Place</th><th>No. of Guests</th><th>Date</th><th>Payment Id</th><th>Total Cost</th><th>Order</th><th>Status</th><th>Actions</th></tr>";
            while ($row = $bookingResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["place"] . "</td>";
                echo "<td>" . $row["guests"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . ($row["razorpay_payment_id"] != "" ? $row["razorpay_payment_id"] : "Payment Failed") . "</td>";
                echo "<td>" . $row["total_cost"] . "</td>";
                echo "<td>" . $row["order"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td><a href='view_receipt.php?booking_id=" . $row["id"] . "'>View Receipt</a></td>";
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