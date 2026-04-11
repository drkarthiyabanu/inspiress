<?php

$servername = 'db';
$username = 'admin_edinz';
$password = 'Ke2FES@e4evxIUT';
$db = 'admin_edinz';

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "<script>console.log('not connected successfully' );</script>";
}
echo "<script>console.log('connected successfully' );</script>";
?>