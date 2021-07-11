<?php 

$con = mysqli_connect('localhost', 'root', 'root', 'social');
$query = "INSERT INTO test VALUES(2, 'Facemobiles')";

if (mysqli_connect_errno()) {
  echo "Failed to connect: ". mysqli_connect_errno();
}

if ( false===$query ) {
  printf("error: %s\n", mysqli_error($con));
}
else {
  echo 'done.';
}

$insert = mysqli_query($con, $query);

?>