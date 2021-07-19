<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';

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
      <h2>Register for a free account!</h2>
      <br>
      <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" value="<?php if (isset($_SESSION['reg_fname'])) {
                                                                              echo $_SESSION['reg_fname'];
                                                                            } ?>" required>
        <br>
        <!-- Error message -->
        <?php if (in_array("<br>Your first name must be between 2 and 25 characters<br>", $error_array)) echo "<br>Your first name must be between 2 and 25 characters<br>"; ?>
        <!-- End of error message -->
        <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if (isset($_SESSION['reg_lname'])) {
                                                                              echo $_SESSION['reg_lname'];
                                                                            } ?>" required>
        <br>
        <!-- Error message -->
        <?php if (in_array("<br>Your last name must be between 2 and 25 characters<br>", $error_array)) echo "<br>Your last name must be between 2 and 25 characters<br>"; ?>
        <!-- End of error message -->
        <input type="email" name="reg_email" placeholder="Email" value="<?php if (isset($_SESSION['reg_email'])) {
                                                                          echo $_SESSION['reg_email'];
                                                                        } ?>" required>
        <br>
        <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if (isset($_SESSION['reg_email2'])) {
                                                                                    echo $_SESSION['reg_email2'];
                                                                                  } ?>" required>
        <br>
        <!-- Error message -->
        <?php if (in_array("<br>Email already in use<br>", $error_array)) echo "<br>Email already in use<br>"; ?>
        <?php if (in_array("<br>Invalid email format<br>", $error_array)) echo "<br>Invalid email format<br>"; ?>
        <?php if (in_array("<br>Emails do not match<br>", $error_array)) echo "<br>Emails do not match<br>"; ?>
        <!-- End of error message -->
        <input type="password" name="reg_password" placeholder="Password" required>
        <br>
        <input type="password" name="reg_password2" placeholder="Confirm Password" required>
        <br>
        <!-- Error message -->
        <?php if (in_array("<br>Your passwords do not match<br>", $error_array)) echo "<br>Your passwords do not match<br>"; ?>
        <?php if (in_array("<br>Your password can only contain english characters or numbers<br>", $error_array)) echo "<br>Your password can only contain english characters or numbers<br>"; ?>
        <?php if (in_array("<br>Your password must be between 5 and 30 characters<br>", $error_array)) echo "<br>Your password must be between 5 and 30 characters<br>"; ?>
        <!-- End of error message -->

        <input type="submit" name="register_button" value="Register" class="btn btn-primary main-action-button">
        <br>
        <?php if (in_array("<br><span style='color: #14c800'>You're all set to go ahead and login!</span><br>", $error_array)) echo "<br><span style='color: #14c800'>You're all set to go ahead and login!</span><br>"; ?>

      </form>
      <small>Already have an account? <a href="login.php">Login!</a></small>
    </div>
  </div>
</body>

</html>