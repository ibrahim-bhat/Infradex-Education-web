<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
header('Content-Type: application/json');

try {
    require_once '../../config/db_connect.php';
    session_start();

    // Check if user has permission
    if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])) {
        throw new Exception('Unauthorized access');
    }

    // Handle both GET and POST requests
    $method = $_SERVER['REQUEST_METHOD'];
    $userId = null;
    
    if ($method === 'GET' && isset($_GET['id'])) {
        $userId = $_GET['id'];
    } elseif ($method === 'POST' && isset($_POST['id'])) {
        $userId = $_POST['id'];
    } else {
        throw new Exception('User ID is required');
    }
    
    $userId = $conn->real_escape_string($userId);
    
    $query = "SELECT id, full_name, email, user_role, status, created_at FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception('Failed to prepare statement: ' . $conn->error);
    }
    
    $stmt->bind_param("i", $userId);
    
    if (!$stmt->execute()) {
        throw new Exception('Failed to execute query: ' . $stmt->error);
    }
    
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        // Format date if needed
        if (isset($user['created_at'])) {
            $user['created_at_formatted'] = date('M d, Y', strtotime($user['created_at']));
        }
        
        echo json_encode([
            'success' => true,
            'user' => $user
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'User not found'
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => $e->getMessage()
    ]);
}
exit; 