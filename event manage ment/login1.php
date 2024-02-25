<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Login</title>
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="asset/css/style.css">
  <style>
    /* Add this style to highlight error message */
.error-message {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}

  </style>
</head>
<body>
  <div class="loginbackground">
    <form action="login.php" method="post" class="registrationbox">
      <h1>Customer Login</h1>
      <label for="">User Name: </label><br>
      <input type="text" name="username" /><br>
      <label for="">Password: </label><br>
      <input type="password" name="password"/>
      <!-- Placeholder for login error message -->
      <?php if(isset($_GET['error']) && $_GET['error'] == '1') { ?>
        <p class="error-message">Incorrect username or password. Please try again.</p>
      <?php } ?>
      <p>Don't have an account? <a href="customer_registration.php" style="color:blue;">Register now</a></p>
      <button>Login</button>
    </form>
  </div>
</body>
</html>
