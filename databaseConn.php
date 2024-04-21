<?php

$db_host = "localhost";
$db_username = "root";
$db_password = "";  // Empty string for no password
$db_name = "snooker_league";

// Create connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
