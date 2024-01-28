<?php
 require_once "db_connect.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

   
    // Retrieve user data from the database
    $selectQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($selectQuery);

    // Check if the user exists and the password is correct
    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        if (password_verify($password, $userData['password'])) {
            $_SESSION['user_details']=$userData;
            // Redirect to successful page with the username as a parameter
            header("Location: customerhomepage.php?username=" . $username);
            exit();
        }
    }

    // Close the database connection
    $mysqli->close();

    // Redirect back to the login page with an error message
    header("Location: login.php?error=1");
    echo"error occurred!, Please Tryagain.";
    exit();
}
?>
