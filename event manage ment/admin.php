<?php
// Simulated user data (replace this with a database check)
$registeredUsers = [
    'admin' => 'admin123'
    
    // Add more users as needed
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the user exists and the password is correct
    if (array_key_exists($username, $registeredUsers) && $registeredUsers[$username] == $password) {
        // Redirect to successful page with the username as a parameter
        header("Location: adminhomepage.php?username=" . $username);
        exit();
    } else {
        // Redirect back to the login page with an error message
        header("Location: adminlogin.html?error=1");
        exit();
    }
}
?>
