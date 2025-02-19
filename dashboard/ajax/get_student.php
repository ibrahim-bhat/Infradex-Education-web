<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] === 'user') {
    exit('Unauthorized');
}

require_once '../../config/db_connect.php';

if(isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    
    $query = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($student = $result->fetch_assoc()) {
        echo json_encode($student);
    } else {
        echo json_encode(['error' => 'Student not found']);
    }
} 