<?php
include('./_includes/globals.php');
$servername = SERVERNAME;
$username = USERNAME;
$password = "";
$dbname = DBNAME;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 
?>