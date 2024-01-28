<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Details</title>
    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css"
      rel="stylesheet"
    />
    
  
    <link rel="stylesheet" href="asset/css/main.css" />
   

  </head>
  <body>
    <div class="content">
      <div class="dashboard">
        <h2>Customer</h2>
        <ul>
          <li><a href="" class="active">Your Details</a></li>
          <li><a href="bookevent.php">Book Event</a></li>
          <li><a href="booking_status.php">Booking Status</a></li>
          <li><a href="">Search Category</a></li>
          <li><a href="">Feedback</a></li>

          <li><a href="index.html">LogOut</a></li>
        </ul>
       
      </div>
    
      <div class="maincontent">
        
        <?php
session_start(); // Start the session

// Check if user details are stored in session
if (isset($_SESSION['user_details'])) {
    $userData = $_SESSION['user_details'];

    // Display user details in a table
    echo "<h1>Welcome, " . $userData['username'] . "!</h1>";
    echo "<h3>Your Details</h3>";
    echo "<table>";
    echo "<tr><th>Field</th><th>Value</th></tr>";
    echo "<tr><td>Username</td><td>" . $userData['username'] . "</td></tr>";
    echo "<tr><td>Mobile</td><td>" . $userData['mobile'] . "</td></tr>";
    echo "<tr><td>Email</td><td>" . $userData['email'] . "</td></tr>";
    echo "<tr><td>Address</td><td>" . $userData['address'] . "</td></tr>";
    echo "</table>";
} else {
    // Redirect to login page if user details are not found
    header("Location: login.php");
    exit();
}
?>

      </div>
    </div>

  </body>
</html>

