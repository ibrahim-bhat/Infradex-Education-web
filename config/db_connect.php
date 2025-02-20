<?php
$servername = "localhost";
// $username = "root";  // Replace with your database username
// $password = "";  // Replace with your database password
// $dbname = "phpinfradex";

$username = "u873877420_infradexedu";  // Replace with your database username
$password = "infradexedu123@";  // Replace with your database password
$dbname = "u873877420_infradexedu";
// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?> 
