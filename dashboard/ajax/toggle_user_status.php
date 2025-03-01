<?php
require_once '../../config/db_connect.php';
session_start();

// Check if user has permission
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])) {
    die(json_encode(['success' => false, 'message' => 'Unauthorized access']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
    $userId = $conn->real_escape_string($_POST['id']);
    $newStatus = $conn->real_escape_string($_POST['status']);
    
    // Validate status value
    if (!in_array($newStatus, ['active', 'blocked'])) {
        die(json_encode(['success' => false, 'message' => 'Invalid status value']));
    }
    
    try {
        // Check if user exists and get their role
        $check_query = "SELECT user_role FROM users WHERE id = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        // Prevent blocking super_admin users
        if ($user['user_role'] === 'super_admin') {
            die(json_encode(['success' => false, 'message' => 'Cannot block super admin users']));
        }
        
        // Update user status
        $update_query = "UPDATE users SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("si", $newStatus, $userId);
        
        if ($stmt->execute()) {
            echo json_encode([
                'success' => true,
                'message' => 'User status updated successfully',
                'new_status' => $newStatus
            ]);
        } else {
            throw new Exception('Failed to update user status');
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
} 