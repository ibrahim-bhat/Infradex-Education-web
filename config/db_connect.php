<?php
$servername = "localhost";
// $username = "root";  // Replace with your database username
// $password = "";  // Replace with your database password
// $dbname = "phpinfradex";

$username = "u873877420_infradexedu";  // Replace with your database username
$password = "infradexedu123@";  // Replace with your database password
$dbname = "u873877420_infradexedu";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 
