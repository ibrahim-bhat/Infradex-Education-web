<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'super_admin') {
    exit(json_encode(['success' => false, 'message' => 'Unauthorized']));
}

require_once '../../config/db_connect.php';

if(isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    
    // Prevent deleting self
    if($id == $_SESSION['user_id']) {
        exit(json_encode(['success' => false, 'message' => 'Cannot delete your own account']));
    }
    
    // Check if user exists and get their role
    $check_query = "SELECT user_role FROM users WHERE id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($user = $result->fetch_assoc()) {
        // Prevent deleting other super_admins
        if($user['user_role'] == 'super_admin') {
            exit(json_encode(['success' => false, 'message' => 'Cannot delete super admin accounts']));
        }
        
        // Delete the user
        $delete_query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting user']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
} 