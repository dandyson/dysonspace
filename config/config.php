<?php
ob_start(); //This turns on output buffering
session_start();

$timezone = date_default_timezone_set("Europe/London");
$con = mysqli_connect('localhost', 'root', 'root', 'social');
$query = "INSERT INTO test VALUES(2, 'Facemobiles')";

if (mysqli_connect_errno()) {
  echo "Failed to connect: ". mysqli_connect_errno();
}
?>