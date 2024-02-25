<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Feedback</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .feedback {
        position: relative;
        /* To position the delete button */
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 5px;
    }

    .feedback p {
        margin: 0;
    }

    .delete-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #dc3545;
        /* Red color for delete button */
        color: #fff;
        border: none;
        border-radius: 50%;
        /* Circular shape */
        width: 30px;
        height: 30px;
        font-size: 16px;
        cursor: pointer;
    }

    .delete-btn:hover {
        background-color: #c82333;
        /* Darker red on hover */
    }
    </style>
    <link rel="stylesheet" href="asset/css/main.css">
</head>

<body>

    <div class="content">
        <div class="dashboard">

            <h2>Admin</h2>
            <ul>
                <li><a href="adminhomepage.php">Dashboard</a></li>
                <li><a href="newbookings.php" class="active">New Bookings</a></li>
                <li><a href="viewbooking.php">View Bookings</a></li>
                <li><a href="add_catogery.php">Add Category</a></li>
                <li><a href="view_catogery.php">View Category</a></li>
                <li><a href="feedback_view.php">Veiw Feedback</a></li>
                <li><a href="index.html">LogOut</a></li>
            </ul>
        </div>
        <div class="maincontent">
            <div class="container">
                <h2>All Feedback</h2>
                <?php
        // Include database connection
        include 'db_connect.php';

        // Fetch all feedback entries from the database
        $sql = "SELECT * FROM feedback";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            // Output each feedback entry
            while($row = $result->fetch_assoc()) {
                echo '<div class="feedback">';
                echo '<p><strong>Name:</strong> ' . $row['name'] . '</p>';
                echo '<p><strong>Feedback:</strong> ' . $row['feedback'] . '</p>';
                echo '<button class="delete-btn" onclick="deleteFeedback(' . $row['id'] . ')">X</button>';
                echo '</div>';
            }
        } else {
            echo "<p>No feedback entries yet.</p>";
        }
        // Close database connection
        $mysqli->close();
        ?>
            </div>
        </div>
    </div>
    <script>
    function deleteFeedback(id) {
        if (confirm("Are you sure you want to delete this feedback?")) {
            // Redirect to a PHP script to handle the deletion, passing the feedback ID
            window.location.href = "delete_feedback.php?id=" + id;
        }
    }
    </script>
</body>

</html>