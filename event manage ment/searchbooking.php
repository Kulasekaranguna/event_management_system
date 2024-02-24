<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
   
    <link rel="stylesheet" href="asset/css/main.css" />
    <style>
        <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

       

        .maincontent {
            float: right;
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        /* Search Bar Styles */
        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 300px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        button[type="submit"] {
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    </style>
</head>
<body>
    <div class="content">
       
        <div class="maincontent">
            <h1>Admin Dashboard</h1>
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Search by booker's name">
                <button type="submit">Search</button>
            </form>
            <?php
            require_once "db_connect.php";

            $search = $_GET['search'] ?? '';

            $bookingQuery = "SELECT * FROM bookings WHERE bookername LIKE '%$search%' ORDER BY id DESC";
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
