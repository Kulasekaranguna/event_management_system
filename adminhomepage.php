<?php
 require_once "db_connect.php"; 

// Fetch total costs from the database
$query = "SELECT category, SUM(total_cost) AS total FROM bookings GROUP BY category";
$result = $mysqli->query($query);

$chartData = array();
while ($row = $result->fetch_assoc()) {
    $chartData[$row['category']] = floatval($row['total']);
}

// Convert data to JSON format
$chartDataJSON = json_encode($chartData);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="asset/css/main.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var jsonData = <?php echo $chartDataJSON; ?>;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Category');
        data.addColumn('number', 'Total Cost');

        // Convert PHP associative array to Google Charts compatible array
        var dataArray = [];
        for (var key in jsonData) {
            dataArray.push([key, jsonData[key]]);
        }
        data.addRows(dataArray);

        var options = {
            title: 'Total Cost by Category',
            chartArea: {
                width: '50%'
            },
            hAxis: {
                title: 'Total Cost',
                minValue: 0
            },
            vAxis: {
                title: 'Category'
            },
            colors: ['#3366cc'], // Change bar color
            backgroundColor: {
                fill: 'transparent'
            }, // Transparent background
            bar: {
                groupWidth: '50%'
            }, // Adjust bar width
            legend: {
                position: 'none'
            }, // Hide legend
            borderRadius: 10 // Border radius
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    </script>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    h1 {
        margin: 25px;
    }

    h2 {
        font-family: "Inter", sans-serif;
        font-family: "Quicksand", sans-serif;
        font-weight: bolder;
        font-size: 30px;
        margin-left: 10px;
    }

    h3 {
        font-family: "Inter", sans-serif;
        font-family: "Quicksand", sans-serif;
        font-weight: lighter;
        font-size: 15px;
        margin: 10px;
    }

    .dashboard-container {
        display: flex;
        justify-content: space-around;
        margin-top: 50px;
        flex-wrap: wrap;
    }

    .dashboard-box {
        width: calc(25% - 10px);
        height: 150px;
        background-color: #f0f0f0;
        border-radius: 10px;
        text-align: center;
        padding: 20px;
        margin-bottom: 20px;
        box-sizing: border-box;
    }

    /* Responsive Styling */
    @media screen and (max-width: 1200px) {
        .dashboard-box {
            width: calc(33.33% - 20px);
        }
    }

    @media screen and (max-width: 800px) {
        .dashboard-box {
            width: calc(50% - 20px);
        }
    }

    @media screen and (max-width: 600px) {
        .dashboard-box {
            width: calc(100% - 20px);
        }
    }

    .dashboard-box h2 {
        font-family: "Inter", sans-serif;
        font-family: "Quicksand", sans-serif;
        font-size: 15px;
        margin: 25px;
    }

    .dashboard-box p {
        font-family: "Inter", sans-serif;
        font-family: "Quicksand", sans-serif;
        font-size: 35px;
        margin: 15px;
        text-align: center;
    }

    .total-members {
        background-color: #87CEEB;
    }

    .total-bookings {
        background-color: #90EE90;
    }

    .total-amount {
        background-color: #FFD700;
    }

    .total-categories {
        background-color: #FFA07A;
    }

    .chart {
        display: flex;
        margin: 15px;
    }

    .chart1 {
        width: 35%;
    }

    @media (max-width: 600px) {
        .chart {
            display: flex;
            flex-direction: column;
        }

        .chart1 {
            width: 100%;
        }

    }
    </style>

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
            <h2>Hello, Admin</h2>
            <h3>Your Company's overview</h3>

            <?php
    // Include database connection
    require_once "db_connect.php";

    // Retrieve total members count
    $membersQuery = "SELECT COUNT(*) AS total_members FROM users";
    $membersResult = $mysqli->query($membersQuery);
    $membersCount = $membersResult->fetch_assoc()['total_members'];

    // Retrieve total bookings count
    $bookingsQuery = "SELECT COUNT(*) AS total_bookings FROM bookings";
    $bookingsResult = $mysqli->query($bookingsQuery);
    $bookingsCount = $bookingsResult->fetch_assoc()['total_bookings'];

    // Retrieve total amount
    $totalAmountQuery = "SELECT SUM(total_cost) AS total_amount FROM bookings";
    $totalAmountResult = $mysqli->query($totalAmountQuery);
    $totalAmount = $totalAmountResult->fetch_assoc()['total_amount'];

    // Retrieve total categories count
    $categoriesQuery = "SELECT COUNT(*) AS total_categories FROM categories";
    $categoriesResult = $mysqli->query($categoriesQuery);
    $categoriesCount = $categoriesResult->fetch_assoc()['total_categories'];

    ?>
            <div class="dashboard-container">
                <div class="dashboard-box total-members">
                    <p><?php echo $membersCount; ?></p>
                    <h2>Total Members</h2>

                </div>
                <div class="dashboard-box total-bookings">
                    <p><?php echo $bookingsCount; ?></p>
                    <h2>Total Bookings</h2>

                </div>
                <div class="dashboard-box total-categories">
                    <p><?php echo $categoriesCount; ?></p>
                    <h2>Total Categories</h2>

                </div>
                <div class="dashboard-box total-amount">
                    <span>Rs:</span>
                    <p><?php echo $totalAmount; ?></p>
                    <h2>Total Amount </h2>

                </div>

            </div>

            <div class="chart">
                <div class="chart1">


                    <canvas id="bookingChart"></canvas>

                    <?php
// Include database connection
require_once "db_connect.php";

// Retrieve booking data from the database
$bookingQuery = "SELECT bookername, total_cost FROM bookings";
$bookingResult = $mysqli->query($bookingQuery);

// Initialize arrays to store data
$bookingLabels = [];
$bookingCosts = [];

// Fetch booking data and store it in arrays
while ($row = $bookingResult->fetch_assoc()) {
    $bookingLabels[] = $row['bookername'];
    $bookingCosts[] = $row['total_cost'];
}
?>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>
                    // Booking data from PHP
                    var bookingLabels = <?php echo json_encode($bookingLabels); ?>;
                    var bookingCosts = <?php echo json_encode($bookingCosts); ?>;

                    // Creating the graph
                    var ctx = document.getElementById('bookingChart').getContext('2d');
                    var bookingChart = new Chart(ctx, {
                        type: 'doughnut', // Change chart type to doughnut
                        data: {
                            labels: bookingLabels,
                            datasets: [{
                                label: 'Total Cost',
                                data: bookingCosts,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.6)', // Red
                                    'rgba(54, 162, 235, 0.6)', // Blue
                                    'rgba(255, 205, 86, 0.6)', // Yellow
                                    'rgba(75, 192, 192, 0.6)', // Green
                                    'rgba(153, 102, 255, 0.6)' // Purple
                                ],
                                borderColor: 'rgba(255, 255, 255, 1)', // White border
                                borderWidth: 2
                            }]
                        },
                        options: {
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Booking Data',
                                    font: {
                                        size: 20,
                                        weight: 'bold'
                                    }
                                },
                                legend: {
                                    display: true,
                                    position: 'right',
                                    labels: {
                                        font: {
                                            size: 14
                                        }
                                    }
                                }
                            }
                        }
                    });
                    </script>
                </div>
                <div class="chart2">
                    <div id="chart_div" style="width: 900px; height: 500px; "></div>
                </div>


            </div>









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