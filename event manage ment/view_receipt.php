<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f3f3f3;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1,
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .company-details {
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    td {
        color: #666;
    }

    .total {
        font-size: 20px;
        font-weight: bold;
        color: #007bff;
        text-align: right;
    }

    .footer {
        margin-top: 50px;
        text-align: center;
        color: #666;
    }

    .print-button {
        text-align: center;
        margin-bottom: 20px;
    }

    .print-button button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="company-details">
            <h1>Event Management Services</h1>
            <p>123 ABC Street, XYZ City</p>
            <p>GSTIN: 1234567890</p>
            <p>Contact: +1234567890</p>
            <hr>
        </div>
        <h2>Booking Receipt</h2>
        <?php
    require_once "db_connect.php";
    session_start(); // Start the session

    // Check if user is logged in
    if (!isset($_SESSION['user_details'])) {
        header("Location: login.php"); // Redirect to login page if not logged in
        exit();
    }

    // Check if booking ID is provided in the URL
    if (isset($_GET['booking_id'])) {
        $booking_id = $_GET['booking_id'];

        // Fetch booking details for the provided booking ID
        $bookingQuery = "SELECT * FROM bookings WHERE id = '$booking_id'";
        $bookingResult = $mysqli->query($bookingQuery);

        if ($bookingResult->num_rows > 0) {
            $row = $bookingResult->fetch_assoc();
            echo "<table>";
            echo "<tr><th>Field</th><th>Value</th></tr>";
            echo "<tr><td>Booking ID</td><td>" . $row["id"] . "</td></tr>";
            echo "<tr><td>Event Type</td><td>" . $row["category"] . "</td></tr>";
            echo "<tr><td>Event Place</td><td>" . $row["place"] . "</td></tr>";
            echo "<tr><td>No. of Guests</td><td>" . $row["guests"] . "</td></tr>";
            echo "<tr><td>Date</td><td>" . $row["date"] . "</td></tr>";
            echo "<tr><td>Payment id</td><td>" . ($row["razorpay_payment_id"] != "" ? $row["razorpay_payment_id"] : "Payment Failed") . "</td></tr>";
            
            // Display selected options only
            echo "<tr><td>Selected Options</td><td>";
            if ($row["dj"] == 'Yes') echo "Dj Services<br>";
            if ($row["stage"] == 'Yes') echo "Stage Setup<br>";
            if ($row["sound"] == 'Yes') echo "Sound System<br>";
            if ($row["breakfast"] == 'Yes') echo "Breakfast<br>";
            if ($row["lunch"] == 'Yes') echo "Lunch<br>";
            if ($row["tea"] == 'Yes') echo "Tea & Snacks<br>";
            if ($row["dinner"] == 'Yes') echo "Dinner<br>";
            if ($row["veg"] == 'Yes') echo "Veg<br>";
            if ($row["nonveg"] == 'Yes') echo "Non Veg<br>";
            echo "</td></tr>";
            
            echo "</table>";
        } else {
            echo "No booking found for the provided booking ID.";
        }
    } else {
        echo "Booking ID is not provided.";
    }
    ?>
        <div class="total">
            Total Amount: <?php echo isset($row["total_cost"]) ? "RS " . $row["total_cost"] : "N/A"; ?>
        </div>
    </div>
    <div class="print-button">
        <button onclick="printReceipt()">Print Receipt</button>
    </div>
    <div class="footer">
        <p>Thank you for choosing our services!</p>
    </div>
    <script>
    function printReceipt() {
        // Generate a file name based on the booking details
        var fileName = generateFileName(); // You need to implement this function

        // Print the receipt
        window.print();
    }

    function generateFileName() {

        var date = new Date();
        var fileName = "receipt_" + date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + ".pdf";
        return fileName;
    }
    </script>

</body>

</html>