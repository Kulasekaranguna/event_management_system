<?php
require_once "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bookername = $_POST["bookername"];
    $place = $_POST["place"];
    $guests = $_POST["guests"];
    $date = $_POST["date"];
    $razorpay_payment_id = $_POST["razorpay_payment_id"];
    $category = isset($_POST["category"]) ? $_POST["category"] : ""; // Corrected line

    // Checkbox items
    $dj = isset($_POST["dj"]) ? "Yes" : "No";
    $stage = isset($_POST["stage"]) ? "Yes" : "No";
    $sound = isset($_POST["sound"]) ? "Yes" : "No";
    $breakfast = isset($_POST["breakfast"]) ? "Yes" : "No";
    $lunch = isset($_POST["lunch"]) ? "Yes" : "No";
    $tea = isset($_POST["tea"]) ? "Yes" : "No";
    $dinner = isset($_POST["dinner"]) ? "Yes" : "No";
    $veg = isset($_POST["veg"]) ? "Yes" : "No";
    $nonveg = isset($_POST["nonveg"]) ? "Yes" : "No";

    // Selected option text
    $foodTypeOptions = array("0" => "Select", "500" => "Normal", "2000" => "Deluxe", "5000" => "Royal");
    $lightOptions = array("0" => "No", "1000" => "Normal", "2000" => "Deluxe", "4000" => "Royal");
    $flowersOptions = array("0" => "No", "1000" => "Normal", "2000" => "Deluxe", "4000" => "Royal");
    $seatOptions = array("0" => "Select", "2000" => "Chair", "5000" => "Chair & Sofa", "12000" => "Sofa");

    // Get the selected option text for category and food type
    $foodTypeText = isset($_POST["foodtype"]) ? $foodTypeOptions[$_POST["foodtype"]] : "";
    $lightText = isset($_POST["light"]) ? $lightOptions[$_POST["light"]] : "";
    $flowersText = isset($_POST["flowers"]) ? $flowersOptions[$_POST["flowers"]] : "";
    $seatText = isset($_POST["seat"]) ? $seatOptions[$_POST["seat"]] : "";

    // Add costs of selected options to the total cost
    $totalCost = 0;
    // Add costs of selected items (checkboxes)
    $totalCost += $dj == "Yes" ? 8000 : 0;
    $totalCost += $stage == "Yes" ? 7000 : 0;
    $totalCost += $sound == "Yes" ? 5000 : 0;
    $totalCost += $breakfast == "Yes" ? 8000 : 0;
    $totalCost += $lunch == "Yes" ? 8000 : 0;
    $totalCost += $tea == "Yes" ? 2000 : 0;
    $totalCost += $dinner == "Yes" ? 10000 : 0;
    $totalCost += $veg == "Yes" ? 0 : 0;
    $totalCost += $nonveg == "Yes" ? 5000 : 0;

    // Add costs of selected options (dropdowns)
    $totalCost += $lightText != "No" ? array_search($lightText, $lightOptions) : 0;
    $totalCost += $flowersText != "No" ? array_search($flowersText, $flowersOptions) : 0;
    $totalCost += $seatText != "Select" ? array_search($seatText, $seatOptions) : 0;
    $totalCost += $foodTypeText != "Select" ? array_search($foodTypeText, $foodTypeOptions) : 0;

    // Create the bookings table if not exists
    $createTableQuery = "CREATE TABLE IF NOT EXISTS bookings (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            bookername VARCHAR(255) NOT NULL,
            category VARCHAR(50) NOT NULL,
            place VARCHAR(255) NOT NULL,
            guests INT(6) NOT NULL,
            date DATE NOT NULL,
            dj VARCHAR(3) NOT NULL,
            stage VARCHAR(3) NOT NULL,
            sound VARCHAR(3) NOT NULL,
            breakfast VARCHAR(3) NOT NULL,
            lunch VARCHAR(3) NOT NULL,
            tea VARCHAR(3) NOT NULL,
            dinner VARCHAR(3) NOT NULL,
            veg VARCHAR(3) NOT NULL,
            nonveg VARCHAR(3) NOT NULL,
            light VARCHAR(50) NOT NULL,
            flowers VARCHAR(50) NOT NULL,
            seat VARCHAR(50) NOT NULL,
            foodtype VARCHAR(50) NOT NULL,
            total_cost DECIMAL(10, 2) NOT NULL,
            razorpay_payment_id VARCHAR(255) NOT NULL,
            status VARCHAR(20) DEFAULT 'Pending'
        )";
    if ($mysqli->query($createTableQuery) !== TRUE) {
        echo "Error creating table: " . $mysqli->error;
    }

    // Insert data into the bookings table
    $insertQuery = "INSERT INTO bookings (bookername, category, place, guests, date, dj, stage, sound, breakfast, lunch, tea, dinner, veg, nonveg, light, flowers, seat, foodtype, total_cost, razorpay_payment_id)
        VALUES ('$bookername', '$category', '$place', $guests, '$date', '$dj', '$stage', '$sound', '$breakfast', '$lunch', '$tea', '$dinner', '$veg', '$nonveg', '$lightText', '$flowersText', '$seatText', '$foodTypeText', $totalCost, '$razorpay_payment_id')";

    if ($mysqli->query($insertQuery) !== TRUE) {
        echo "Error inserting data: " . $mysqli->error;
    } else {
        echo "<p>Booking successfully submitted!</p>";
    }
}

?>
