<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    exit(json_encode(['error' => 'Unauthorized']));
}

require_once '../../config/db_connect.php';

if(isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    
    // Don't select password field for security
    $query = "SELECT id, username, email, full_name, user_role, created_at 
              FROM users WHERE id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($user = $result->fetch_assoc()) {
        // Format dates and any other data processing
        $user['created_at_formatted'] = date('M d, Y', strtotime($user['created_at']));
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
} 