<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link
      href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css"
      rel="stylesheet"
    />
   
    <link rel="stylesheet" href="asset/css/main.css" >
    
  </head>
  <body>
    <div class="content">
      <div class="dashboard">
        <h2>Admin</h2>
        <ul>
          <li><a href="" class="active">Registered Users</a></li>
          <li><a href="newbookings.php">New Bookings</a></li>
          <li><a href="viewbooking.php">View Bookings</a></li>
          <li><a href="">Add Category</a></li>
          <li><a href="">View Category</a></li>
          <li><a href="">Veiw Feedback</a></li>
          <li><a href="index.html">LogOut</a></li>
        </ul>
      </div>
     

      <div class="maincontent">
        <h1>All Registered Customer</h1>

        <?php
       require_once "db_connect.php";
    
        // Retrieve all user data from the database
        $selectAllQuery = "SELECT * FROM users";
        $result = $mysqli->query($selectAllQuery);
    
        // Display user information
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Id</th><th>User Name</th><th>Mobile</th><th>Email</th><th>Address</th>";
            while ($userData = $result->fetch_assoc()) {
                
              
                echo "<tr> <td>" . $userData['id'] . "</td>
                <td>". $userData['username'] . "</td>
                <td>" . $userData['mobile'] .  "</td> 
                <td>" . $userData['email'] . "</td> 
                <td>"  . $userData['address'] . "</td> </tr>" ;
             
            }
            echo "</table>";
        } else {
            echo "<p>No registered users found.</p>";
        }
    
        // Close the database connection
        $mysqli->close();
        ?>
    </div>
    </div>
  </body>
</html>
