<?php 

session_start();

$con = mysqli_connect('localhost', 'root', '', 'social');

if (mysqli_connect_errno()) {
  echo "Failed to connect: ". mysqli_connect_errno();
}

//Declaring variables to prevent errors
$fname = ""; //First Name
$lname = ""; //Last Name
$em = ""; //Email
$em2 = ""; //Email 2
$password = ""; //Password
$password2 = ""; //Password 2
$date = ""; //Sign up date
$error_array[] = '';

if(isset($_POST['register_button'])) {
  
  //Registration Form Values
  
  //First name
  $fname = strip_tags($_POST['reg_fname']); //Remove HTML tags
  $fname = str_replace(' ', '', $fname); //Remove spaces
  $fname = ucfirst(strtolower($fname)); //Uppercase first letter
  $_SESSION['reg_fname'] = $fname; //Stores first name into session variable
  
  //Last name
  $lname = strip_tags($_POST['reg_lname']); //Remove HTML tags
  $lname = str_replace(' ', '', $lname); //Remove spaces
  $lname = ucfirst(strtolower($lname)); //Uppercase first letter
  $_SESSION['reg_lname'] = $lname; //Stores last name into session variable
  
  //Email
  $em = strip_tags($_POST['reg_email']); //Remove HTML tags
  $em = str_replace(' ', '', $em); //Remove spaces
  $em = ucfirst(strtolower($em)); //Uppercase first letter
  $_SESSION['reg_email'] = $em; //Stores email into session variable
  
  //Email 2
  $em2 = strip_tags($_POST['reg_email2']); //Remove HTML tags
  $em2 = str_replace(' ', '', $em2); //Remove spaces
  $em2 = ucfirst(strtolower($em2)); //Uppercase first letter
  $_SESSION['reg_email2'] = $em2; //Stores email 2 into session variable
  
  //Password
  $password = strip_tags($_POST['reg_password']); //Remove HTML tags
  $password2 = strip_tags($_POST['reg_password2']); //Remove HTML tags
  
  $date = date("Y-m-d"); //Current date
  
  if ($em == $em2) {
    if (filter_var($em, FILTER_VALIDATE_EMAIL)) 
    {
      $em = filter_var($em, FILTER_VALIDATE_EMAIL);
      
      // Check if email already exists
      $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
      
      //Count the number of rows returned
      $num_rows = mysqli_num_rows($e_check);
      
      if ($num_rows > 0) {
        array_push($error_array, "Email is already in use!<br>");
      }
      
      if (strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($error_array, "Your first name must be between 2 and 25 characters long<br>");
      } 
      
       if (strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($error_array, "Your last name must be between 2 and 25 characters long<br>");
      }
      
      if($password != $password2) {
       array_push($error_array, "Your passwords do not match<br>");
      } else {
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
          array_push($error_array, "Your password can only contain English characters or numbers<br>");
        }
      }
      
      if (strlen($password) > 30 || strlen($password) < 5) {
         array_push($error_array, "Your password must be between 5 and 30 characters long<br>");
        
      }
    } 
    else 
    {
      array_push($error_array, "Invalid email format<br>");
    }
  } 
  else 
  {
    array_push($error_array, "Emails do not match<br>");
  }
}


?>


<html>
  <head>
    <title>Dyson Space</title>
  </head>
  <body>
    <form action="register.php" method="POST">
            <input type="text" name="reg_fname" placeholder="First Name" value="<?php 
                   if(isset($_SESSION['reg_fname'])) {
                    echo $_SESSION['reg_fname'];
                   }
                   ?>" required>
      <br>
                <?php 
      
                  if (in_array("Your first name must be between 2 and 25 characters long<br>", $error_array)) echo "Your first name must be between 2 and 25 characters long<br>";
                
                ?>
            <input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
                   if(isset($_SESSION['reg_lname'])) {
                    echo $_SESSION['reg_lname'];
                   }
                   ?>" required>
      
                      <?php 
      
                  if (in_array("Your last name must be between 2 and 25 characters long<br>", $error_array)) echo "Your last name must be between 2 and 25 characters long<br>";
                
                ?>
      <br>
            <input type="email" name="reg_email" placeholder="Email" value="<?php 
                   if(isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                   }
                   ?>" required>
      <br>
            <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
                   if(isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                   }
                   ?>" required>
      
                <?php 
      
                  if (in_array("Email is already in use!<br>", $error_array)) echo "Email is already in use!<br>";
                  else if (in_array("Emails do not match<br>", $error_array)) echo "Emails do not match<br>";
                  else if (in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
                
                ?>
      <br>
            <input type="password" name="reg_password" placeholder="Password" required>
      <br>
            <input type="password" name="reg_password2" placeholder="Confirm Password" required>
      
            <?php 

              if (in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>";
              else if (in_array("Your password can only contain English characters or numbers<br>", $error_array)) echo "Your password can only contain English characters or numbers<br>";
              else if (in_array("Your password must be between 5 and 30 characters long<br>", $error_array)) echo "Your password must be between 5 and 30 characters long<br>";
            
              if (empty($error_array)) {
                $password = md5($password); //Encrypt password before sending to database
                //Generate new username by concatenating first & last name
                $username = strtolower($fname . "_" . $lname);
                $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
                
                $i = 0;
                //If username exists, add number to username
                while (mysqli_num_rows($check_username_query) != 0) {
                  $i++; //Add one to $i
                  $username = $username . "_" . $i;
                  $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
                }
                
                
                //Profile picture assignment
                $rand = rand(1, 2);
                if ($rand = 1) {
                  $profile_pic = "assets/images/profile_pics/defaults/blank-profile-picture.png";
                } else if ($rand = 2) {
                  $profile_pic = "assets/images/profile_pics/defaults/blank-profile-picture-2.png";
                  
                  $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', 'no', ',')");
                }
              }
      ?>
      <br>
      

            <input type="submit" name="register_button" value="Register">
    </form>
  </body>
</html>