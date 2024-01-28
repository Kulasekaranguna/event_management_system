<?php
require_once "db_connect.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash the password
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $address = $_POST["address"];


      // Create users table if not exists
      $createTableQuery = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(255) NOT NULL,
        mobile VARCHAR(12) NOT NULL,
        email VARCHAR(70) NOT NULL,
        address VARCHAR(255) NOT NULL
    )";

    if ($mysqli->query($createTableQuery) !== TRUE) {
        echo "Error creating table: " . $mysqli->error;
    }

    // Insert user data into the database
    $insertQuery = "INSERT INTO users (username, password, mobile, email, address) VALUES ('$username', '$password', '$mobile', '$email', '$address')";

    if ($mysqli->query($insertQuery) !== TRUE) {
        echo "Error inserting data: " . $mysqli->error;
    }

    // Close the database connection (optional as PHP automatically closes connections at the end of script execution)
    $mysqli->close();

    // Redirect to login page
    header("Location: login.html");
    exit();
}
?>
