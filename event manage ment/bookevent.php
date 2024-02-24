<?php
session_start();
require_once "db_connect.php";

if (isset($_SESSION['user_details'])) {
    $userData = $_SESSION['user_details'];
}

// Fetch categories from the database
$categoryQuery = "SELECT * FROM categories";
$categoryResult = $mysqli->query($categoryQuery);

// Check if the form is submitted

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Event</title>
    <link
    href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css"
    rel="stylesheet"
  />
  
  <link rel="stylesheet" href="asset/css/style.css" />
  <link rel="stylesheet" href="asset/css/main.css" />


    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   




  <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            
        }
        h1 {
            color: rgb(48, 48, 48);
        }
       
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            font-weight: bold;
        }
        select, input[type="text"], input[type="date"] {
            width: calc(100% - 6px);
            padding: 8px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="checkbox"] {
            margin-right: 5px;
            margin: 20px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        #totalCost {
            font-weight: bold;
        }
       
  </style>
  </head>
  <body>
    <div class="content">
      <div class="dashboard">
      
      <h2>Customer</h2>
        <ul>
          <li><a href="customerhomepage.php" class="active">Your Details</a></li>
          <li><a href="bookevent.php">Book Event</a></li>
          <li><a href="booking_status.php">Booking Status</a></li>
         
          <li><a href="feedback.html">Feedback</a></li>

          <li><a href="index.html">LogOut</a></li>
        </ul>
      </div>
     
      <div class="maincontent">
        <h1>Event Booking Page</h1>
      
        
    
        <form id="bookingForm" method="post"  class="eventbooking">
                <label for="category">Event Type:</label>
                <select id="category" name="category">
                    <option value="0">Select</option>
                    <?php
                    // Display fetched categories as options
                    if ($categoryResult->num_rows > 0) {
                        while ($row = $categoryResult->fetch_assoc()) {
                            echo "<option value='{$row['category_name']}'>{$row['category_name']}</option>";
                        }
                    }
                    ?>
                </select>
            
            <label for="place">Event Place:</label>
            <input type="text" id="place" name="place">
            
            <label for="guests">No Of Guests:</label>
            <input type="text" id="guests" name="guests">
            
            <label for="date">Date:</label>
            <input type="date" id="date" name="date">
            
            <h2>Equipment</h2>
            <label><input type="checkbox" value="8000" name="dj" onchange="calculateCost()"> Dj Services</label><br>
            <label><input type="checkbox" value="7000" name="stage" onchange="calculateCost()"> Stage Setup</label><br>
            <label><input type="checkbox" value="5000" name="sound" onchange="calculateCost()"> Sound System</label>
            
            <h2>Food</h2>
            <label for="foodtype">Food Type</label>
            <select id="foodtype" name="foodtype" onchange="calculateCost()">
                <option value="0">Select</option>
                <option value="500">Normal</option>
                <option value="2000">Deluxe</option>
                <option value="5000">Royal</option>
            </select>
            <label><input type="checkbox" name="breakfast" value="8000" onchange="calculateCost()"> Breakfast</label><br>
            <label><input type="checkbox" name="lunch" value="8000" onchange="calculateCost()"> Lunch</label><br>
            <label><input type="checkbox" name="tea" value="2000" onchange="calculateCost()"> Tea & Snacks</label><br>
            <label><input type="checkbox" name="dinner" value="10000" onchange="calculateCost()"> Dinner</label><br>
            <label><input type="checkbox" name="veg" value="0" onchange="calculateCost()"> Veg</label><br>
            <label><input type="checkbox" name="nonveg" value="5000" onchange="calculateCost()"> Non Veg</label><br>
            
            <h2>Decoration</h2>
            <label for="light">Lightings</label>
            <select id="light" name="light" onchange="calculateCost()">
                <option value="0">No</option>
                <option value="1000">Normal</option>
                <option value="2000">Delux</option>
                <option value="4000">Royal</option>
            </select>
            <label for="flowers">Flowers</label>
            <select id="flowers" name="flowers" onchange="calculateCost()">
                <option value="0">No</option>
                <option value="1000">Normal</option>
                <option value="2000">Delux</option>
                <option value="4000">Royal</option>
            </select>
            <label for="seat">Seating</label>
            <select id="seat" name="seat" onchange="calculateCost()">
                <option value="0">Select</option>
                <option value="2000">Chair</option>
                <option value="5000">Chair & Sofa</option>
                <option value="12000">Sofa</option>
            </select>
            
            <h3>Total Cost: ₹<span id="totalCost" name="totalCost">0</span></h3>
        
            <input type="hidden" id="bookername" name="bookername" value="<?php echo $userData['username']; ?>">
            <input type="hidden" id="razorpay_payment_id" name="razorpay_payment_id" value="">

            <button type="button" id="payNowBtn">Pay Now</button>
        </form>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    
        <script>
            function calculateCost() {
                var totalCost = 0;
                var selectedOptions = document.querySelectorAll('input[type="checkbox"]:checked');
                
                var foodType = document.getElementById('foodtype').value;
                var light = document.getElementById('light').value;
                var flowers = document.getElementById('flowers').value;
                var seat = document.getElementById('seat').value;
    
                selectedOptions.forEach(function(option) {
                    totalCost += parseInt(option.value);
                });
             
                totalCost += parseInt(foodType);
                totalCost += parseInt(light);
                totalCost += parseInt(flowers);
                totalCost += parseInt(seat);
    
                document.getElementById('totalCost').textContent = totalCost;
            }
           
            $(document).ready(function () {
    $('#payNowBtn').click(function () {
        var form = $('#bookingForm');
        // Get the payment ID from Razorpay's response
        var razorpay_payment_id = null; // Initialize the variable

        var totalAmount = parseInt($('#totalCost').text()) * 100; // Convert to paisa/cents
        var options = {
            key: 'rzp_test_76kxDJ6sC5HQqM',
            amount: totalAmount,
            currency: 'INR',
            name: 'kulasekaran s Event Management',
            description: 'Event Booking Payment',
            image: 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fcdn.sanity.io%2Fimages%2Fkts928pd%2Fproduction%2F8e5bca865732d013fd24b9e71bb0a5f9e06d279b-731x731.png&tbnid=dBaGo3hdBW6OhM&vet=12ahUKEwjp67Lah5yEAxXElmMGHSe9B9sQMygFegUIARCAAQ..i&imgrefurl=https%3A%2F%2Flogo.com%2Flogos%2Fevent-management&docid=UUpRk1MCK8J5GM&w=731&h=731&q=event%20management%20logo&client=opera&ved=2ahUKEwjp67Lah5yEAxXElmMGHSe9B9sQMygFegUIARCAAQ',
            prefill: {
                name: '<?php echo $userData['username']; ?>',
                email: '<?php echo $userData['email']; ?>'
            },
            theme: {
                color: '#007bff'
            },
            handler: function (response) {
                // Store the payment ID
                razorpay_payment_id = response.razorpay_payment_id;

                // Add the payment ID to the form data
                form.append($('<input>').attr({
                    type: 'hidden',
                    id: 'razorpay_payment_id',
                    name: 'razorpay_payment_id',
                    value: razorpay_payment_id
                }));

                // Now submit the form via AJAX
                $.ajax({
                    type: 'POST',
                    url: 'submit_booking.php',
                    data: form.serialize(),
                    success: function (response) {
                        // Handle success response
                        console.log(response); // Log the response
                        // Add your code to handle the response as needed
                    },
                    error: function () {
                        // Handle error
                        alert('Error occurred while processing payment.');
                    }
                });
            }
        };
        var razorpay = new Razorpay(options);
        razorpay.open();
    });
});



        </script>
      </div>
    </div>
  </body>
</html>


