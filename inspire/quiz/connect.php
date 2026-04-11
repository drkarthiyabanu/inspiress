<?php

$servername = 'db';
$username = 'admin_inspiress';
$password = 'Ke2FES@e4evxIUT';
$db = 'admin_inspiress';

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<script>console.log('connected successfully' );</script>";
?> 