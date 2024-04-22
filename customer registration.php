<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <style>
    .message-box {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .
    </style>
    <link rel="stylesheet" href="asset/css/style.css" />
</head>

<body>
    <div class="loginbackground">
        <form action="register.php" method="post" class="registrationbox">
            <h1>Customer Registration</h1>
            <!-- Add a message box for displaying errors -->
            <div class="message-box">
                <?php if(isset($_GET['error'])) { ?>
                <p><?php echo $_GET['error']; ?></p>
                <?php } ?>
            </div>
            <label for="">User Name: </label><br>
            <input type="text" name="username" required /><br>
            <label for="">Password: </label><br>
            <input type="password" name="password" required /><br>
            <label for="">Mobile Number: </label><br>
            <input type="text" name="mobile" required /><br>
            <label for="">Email: </label><br>
            <input type="email" name="email" required /><br>
            <label for="">Address: </label><br>
            <textarea name="address" id="" cols="25" rows="7" style="border-radius: 10px;
          border: 1px solid black;
          margin: 10px 0 10px 25px;
          padding: 10px;
          background-color: #ffffffd5;"></textarea>
            <p>Already a user? <a href="login1.php" style="color:blue;">Login</a></p>
            <button>Register</button>
        </form>
    </div>

</body>

</html>