<?php
$servername = "localhost";
$username = "u873877420_infradexedu";  
$password = "Infradexedu123@";  
$dbname = "u873877420_infradexedu";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die($e->getMessage());
}
?>
