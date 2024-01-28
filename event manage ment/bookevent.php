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
      
        <ul>
            <h2>Customer</h2>
          <li><a href="customerhomepage.php" >Your Details</a></li>
          <li><a href=""class="active">Book Event</a></li>
          <li><a href="booking_status.php">Booking Status</a></li>
          <li><a href="">Search Category</a></li>
          <li><a href="">Feedback</a></li>

          <li><a href="index.html">LogOut</a></li>
        </ul>
      </div>
     
      <div class="maincontent">
        <h1>Event Booking Page</h1>
      
        
    
        <form action="submit_booking.php" method="post" class="eventbooking">
        <?php
session_start();

if (isset($_SESSION['user_details'])) {
    $userData = $_SESSION['user_details'];
    echo "<input type=\"hidden\" id=\"bookername\" name=\"bookername\" value=\"" . $userData['username'] . "\">";
}
?>

          
            <label for="category">Event Type:</label>
            <select id="category" name="category" onchange="calculateCost()">
                <option value="0">Select</option>
                <option value="20000">Marriage</option>
                <option value="12000">Reception</option>
                <option value="10000">BirthDay Party</option>
                <option value="15000">Sports Event</option>
                <option value="21000">Cultural Festival</option>
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
            <button type="button" onclick="generateReceipt()">Download Receipt</button>
            <button>Book Event</button>
        </form>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    
        <script>
            function calculateCost() {
                var totalCost = 0;
                var selectedOptions = document.querySelectorAll('input[type="checkbox"]:checked');
                var category = document.getElementById('category').value;
                var foodType = document.getElementById('foodtype').value;
                var light = document.getElementById('light').value;
                var flowers = document.getElementById('flowers').value;
                var seat = document.getElementById('seat').value;
    
                selectedOptions.forEach(function(option) {
                    totalCost += parseInt(option.value);
                });
                totalCost += parseInt(category);
                totalCost += parseInt(foodType);
                totalCost += parseInt(light);
                totalCost += parseInt(flowers);
                totalCost += parseInt(seat);
    
                document.getElementById('totalCost').textContent = totalCost;
            }
            function generateReceipt() {
                var bookername = document.getElementById('bookername').value;
                var category = document.getElementById('category').options[document.getElementById('category').selectedIndex].text;
                var place = document.getElementById('place').value;
                var guests = document.getElementById('guests').value;
                var date = document.getElementById('date').value;
                var totalCost = document.getElementById('totalCost').textContent;
    
                var receiptContent = "Event Booking Receipt\n\n";
                receiptContent += "Booker Name: " + bookername + "\n";
                receiptContent += "Event Type: " + category + "\n";
                receiptContent += "Event Place: " + place + "\n";
                receiptContent += "Number of Guests: " + guests + "\n";
                receiptContent += "Date: " + date + "\n";
                
                var selectedOptions = document.querySelectorAll('input[type="checkbox"]:checked');
                selectedOptions.forEach(function(option) {
                    receiptContent += option.parentElement.textContent + ": rs:" + option.value + "\n";
                });
    
                receiptContent += "Total Cost: RS: " + totalCost;
    
                var blob = new Blob([receiptContent], { type: "text/plain;charset=utf-8" });
                saveAs(blob, "event_receipt.txt");
            }
        </script>
      </div>
    </div>
  </body>
</html>
