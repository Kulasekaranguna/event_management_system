



<?php
require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    // Check if username or email already exists
    $checkQuery = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = $mysqli->query($checkQuery);

    if ($result->num_rows > 0) {
        // Username or email already exists
        header("Location: customer registration.php.?error=Username or email already exists");
        exit();
    } else {
        //Create users table if not exists
      $createTableQuery = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(255) NOT NULL,
        mobile VARCHAR(12) NOT NULL,
        email VARCHAR(70) NOT NULL,
        address VARCHAR(255) NOT NULL,
      profile_picture VARCHAR(255) DEFAULT NULL
    )";

    if ($mysqli->query($createTableQuery) !== TRUE) {
        echo "Error creating table: " . $mysqli->error;
    }
        // Insert user data into the database
        $insertQuery = "INSERT INTO users (username, password, mobile, email, address) VALUES ('$username', '$password', '$mobile', '$email', '$address')";
        
        if ($mysqli->query($insertQuery) !== TRUE) {
            echo "Error inserting data: " . $mysqli->error;
            exit();
        }

        // Close the database connection
        $mysqli->close();

        // Redirect to login page after successful registration
        header("Location: login.html");
        exit();
    }
}
?>
