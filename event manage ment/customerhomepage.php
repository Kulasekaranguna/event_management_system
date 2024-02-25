<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Details</title>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="asset/css/main.css" />
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #333;
    text-align: center;
}

h3 {
    color: #666;
    margin-top: 20px;
}

.profile-pic {
    width: 150px;
    height: 150px;
    display: block;
    margin: 10px auto;
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
form {
    margin-top: 20px;
    text-align: center;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #666;
}

input[type="file"] {
    margin-bottom: 10px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

    </style>


</head>

<body>
    <div class="content">
    <div class="dashboard">
    <h2>Customer</h2>
   
   

    <ul>
        <li><a href="" class="active">Your Details</a></li>
        <li><a href="bookevent.php">Book Event</a></li>
        <li><a href="booking_status.php">Booking Status</a></li>
        <li><a href="feedback.html">Feedback</a></li>
        <li><a href="index.html">LogOut</a></li>
    </ul>
</div>

        <div class="maincontent">
            

        <?php
        
        session_start();
        require_once "db_connect.php";
if (isset($_SESSION['user_details'])) {
    $userData = $_SESSION['user_details'];

    echo "<h1>Welcome, " . htmlspecialchars($userData['username']) . "!</h1>";
   
    // Display user's profile picture if available
    if (!empty($userData['profile_picture'])) {
        echo "<img src='" . htmlspecialchars($userData['profile_picture']) . "' alt='Profile Picture' class='profile-pic'><br>";
    } else {
        // Display the upload form only if profile picture doesn't exist
        echo "<form action=\"upload_profile_picture.php\" method=\"post\" enctype=\"multipart/form-data\">";
        echo "<!-- Your existing form fields for user details -->";
        echo "<div>";
        echo "<label for=\"profile_picture\">Upload Profile Picture:</label>";
        echo "<input type=\"file\" id=\"profile_picture\" name=\"profile_picture\" accept=\"image/*\">";
        echo "</div>";
        echo "<button type=\"submit\">Submit</button>";
        echo "</form>";
    }

    echo "<h3>Your Details</h3>";
    echo "<table>";
    echo "<tr><th>Field</th><th>Value</th></tr>";
    echo "<tr><td>Username</td><td>" . htmlspecialchars($userData['username']) . "</td></tr>";
    echo "<tr><td>Mobile</td><td>" . htmlspecialchars($userData['mobile']) . "</td></tr>";
    echo "<tr><td>Email</td><td>" . htmlspecialchars($userData['email']) . "</td></tr>";
    echo "<tr><td>Address</td><td>" . htmlspecialchars($userData['address']) . "</td></tr>";
    echo "</table>";
} else {
    header("Location: login.php");
    exit();
}
?>




        </div>
    </div>

</body>

</html>