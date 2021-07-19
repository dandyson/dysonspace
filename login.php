<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
include 'header.php'

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dyspace || Reliving old memories</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">

  <!-- CUSTOM STYLES -->
  <link rel="stylesheet" href="assets/css/general.css">
  <link rel="stylesheet" href="assets/css/login_register_styles.css">

  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
</head>

<body class="body-login-register">
  <div class="login-register__container">
    <h1>DYSPACE</h1>
    <div class="login-register__form">
      <h2>Login to your account</h2>
      <br>


      <form action="login.php" method="POST">
        <input type="email" name="log_email" placeholder="Email Address" value="<?php if (isset($_SESSION['log_email'])) {
                                                                                  echo $_SESSION['log_email'];
                                                                                } ?>" required>
        <br>
        <input type="password" name="log_password" placeholder="Password">
        <br>
        <input type="submit" name="login_button" value="Login" class="btn btn-primary main-action-button">

        <!-- Error message -->
        <?php if (in_array("<br>Email or Password incorrect, please try again<br>", $error_array)) echo "<br>Email or Password incorrect, please try again<br>"; ?>
        <!-- End of error message -->
      </form> 
      <small>Don't have an account yet? <a href="register.php">Register!</a></small>
    </div>
  </div>
</body>

</html>