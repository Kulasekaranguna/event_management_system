<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
   
    <link rel="stylesheet" href="asset/css/main.css" />
    <style>
      thead th {
  position: sticky;
  top: 0;
  z-index: 1;
}

tbody th {
  position: sticky;
  left: 0;
  background-color: #f0f0f0;
  z-index: 1;
}
    </style>
</head>
<body>
    <div class="content">
        <div class="dashboard">
            <h2>Admin</h2>
            <ul>
          <li><a href="adminhomepage.php">Registered Users</a></li>
          <li><a href="newbookings.php"  class="active">New Bookings</a></li>
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
            require_once "db_connect.php";

            $bookingQuery = "SELECT * FROM bookings";
            $bookingResult = $mysqli->query($bookingQuery);

            if ($bookingResult->num_rows > 0) {
                echo "<table>";
                echo "<thead><tr><th>Booking ID</th><th>Booker Name</th><th>Event Type</th><th>Event Place</th><th>No. of Guests</th><th>Date</th><th>Dj Service</th><th>Stage setup</th><th>Sound System</th><th>Food Type<th>Breakfast</th><th>Lunch</th><th>Tea & Snacks</th><th>Dinner</th><th>Veg</th><th>Non Veg</th><th>Lightings</th><th>Flowers</th><th>Seating</th><th>Total Cost</th><th>Status</th></tr></thead>";
                echo "<tbody>";
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
                    echo "<td>" . $row["status"] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No bookings found.";
            }
            ?>
        </div>
    </div>
</body>
</html>
