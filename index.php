<?php 

$con = mysqli_connect('localhost', 'root', '', 'social');

if (mysqli_connect_errno()) {
  echo "Failed to connect: ". mysqli_connect_errno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'Snek')");

?>

<html>
  <head>
    <title>Dyson Space</title>
  </head>
</html>