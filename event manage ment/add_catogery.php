<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="asset/css/main.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            margin:15px
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: calc(100% - 6px);
            padding: 8px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: black;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="content">
      <div class="dashboard">
      
      <h2>Admin</h2>
        <ul>
          <li><a href="adminhomepage.php">Registered Users</a></li>
          <li><a href="newbookings.php"  class="active">New Bookings</a></li>
          <li><a href="viewbooking.php">View Bookings</a></li>
          <li><a href="add_catogery.php">Add Category</a></li>
          <li><a href="view_catogery.php">View Category</a></li>
          <li><a href="feedback_view.php">Veiw Feedback</a></li>
          <li><a href="index.html">LogOut</a></li>
        </ul>
      </div>
      
      <div class="maincontent">
    <div class="container">
        <h1>Add New Category</h1>
        <form action="process_catogery.php" method="post">
            <label for="categoryName">category Name:</label>
            <input type="text" id="categoryName" name="categoryName" required>
            <button type="submit">Add Category</button>
        </form>
    </div>
    </div>
    </div>
</body>
</html>
