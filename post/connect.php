<?php

$servername = 'db';
$username = 'edinztec_admin';
$password = 'Ke2FES@e4evxIUT';
$db = 'edinztec_admin';

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "<script>console.log('not connected successfully' );</script>";
}
echo "<script>console.log('connected successfully' );</script>";
?>