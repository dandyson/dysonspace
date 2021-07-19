<?php

// DECLARING VARIABLES 

$fname = ""; //First Name
$lname = ""; //Last Name
$em = ""; //Email
$em2 = ""; //Email 2
$password = ""; //Password
$password2 = ""; //Confirm password
$date = ""; //Sign up date
$error_array = array(); //Array to hold error messages

// HANDLE THE FORM

if (isset($_POST['register_button'])) {
  
  // Registration form values

  $fname = strip_tags($_POST['reg_fname']); //Remove HTML tags
  $fname = str_replace(' ', '', $fname); //Remove spaces
  $fname = ucfirst(strtolower($fname)); //Capitalise and lower case
  $_SESSION['reg_fname'] = $fname; //Stores first name into session variable

  $lname = strip_tags($_POST['reg_lname']); //Remove HTML tags
  $lname = str_replace(' ', '', $lname); //Remove spaces
  $lname = ucfirst(strtolower($lname)); //Capitalise and lower case
  $_SESSION['reg_lname'] = $lname; //Stores last name into session variable

  $em = strip_tags($_POST['reg_email']); //Remove HTML tags
  $em = str_replace(' ', '', $em); //Remove spaces
  $em = ucfirst(strtolower($em)); //Capitalise and lower case
  $_SESSION['reg_email'] = $em; //Stores email into session variable

  $em2 = strip_tags($_POST['reg_email2']); //Remove HTML tags
  $em2 = str_replace(' ', '', $em2); //Remove spaces
  $em2 = ucfirst(strtolower($em2)); //Capitalise and lower case
  $_SESSION['reg_email2'] = $em2; //Stores email into session variable

  $password = strip_tags($_POST['reg_password']); //Remove HTML tags
  $password2 = strip_tags($_POST['reg_password2']); //Remove HTML tags

  $date = date("Y-m-d"); //Gets the current date

  if ($em == $em2) {
    // Check if email is in a valid format
    if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
      $em = filter_var($em, FILTER_VALIDATE_EMAIL);

      // Check if email already exists
      $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

      // Count number of rows returned
      $num_rows = mysqli_num_rows($e_check);

      if($num_rows > 0) {
        array_push($error_array, "<br>Email already in use<br>");
      }

    } else {
      array_push($error_array, "<br>Invalid email format<br>");
    }
  } else {
    array_push($error_array, "<br>Emails do not match<br>");
  }

  if (strlen($fname) > 25 || strlen($fname) < 2) {
    array_push($error_array, "<br>Your first name must be between 2 and 25 characters<br>");
  }

  if (strlen($lname) > 25 || strlen($lname) < 2) {
    array_push($error_array, "<br>Your last name must be between 2 and 25 characters<br>");
  }

  if ($password != $password2) {
    array_push($error_array, "<br>Your passwords do not match<br>");
  } else {
    if (preg_match('/[^A-Za-z0-9]/', $password)) {
      array_push($error_array, "<br>Your password can only contain english characters or numbers<br>");
    }
  }

  if (strlen($password) > 30 || strlen($password) < 5) {
    array_push($error_array, "<br>Your password must be between 5 and 30 characters<br>");
  }

      if (empty($error_array)) {
        $password = md5($password); //Encrypt Password before sending to database

        //Generate username by concatenating first & last names
        $username = strtolower($fname . "_" . $lname);
        // Check if username already exists
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'" );
        
        $i = 0;
        // If username exists, add number to username
        while (mysqli_num_rows($check_username_query) != 0) {
          $i++; // Increment i
          $username = $username . "_" . $i;
          $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        }

        // Profile picture assignment
        $rand = rand(1, 2); // Random number between 1 and 2
        if ($rand == 1) {
          $profile_pic = "assets/images/profile_pics/defaults/blank-profile-picture.png";
        } else if ($rand == 2) {
          $profile_pic = "assets/images/profile_pics/defaults/blank-profile-picture-2.png";
        }
        $query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
        array_push($error_array, "<br><span style='color: #14c800'>You're all set to go ahead and login!</span><br>");
      }



      // Clear session variable

      $_SESSION['reg_fname'] = "";
      $_SESSION['reg_lname'] = "";
      $_SESSION['reg_email'] = "";
      $_SESSION['reg_email2'] = "";
    }
      ?>