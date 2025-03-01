<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error display for debugging
header('Content-Type: application/json');

try {
    require_once '../../config/db_connect.php';
    session_start();

    // Check if user has permission
    if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])) {
        throw new Exception('Unauthorized access');
    }

    // Handle GET request for fetching user details
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $userId = $conn->real_escape_string($_GET['id']);
        
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
            // Log successful fetch for debugging
            error_log("User data fetched successfully: " . json_encode($user));
            echo json_encode([
                'success' => true,
                'user' => $user
            ]);
        } else {
            error_log("User not found for ID: " . $userId);
            echo json_encode([
                'success' => false,
                'message' => 'User not found'
            ]);
        }
        exit;
    }

    // Handle POST request for updating user
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $response = ['success' => false, 'message' => ''];
        
        // Get and sanitize input
        $userId = $conn->real_escape_string($_POST['id']);
        $fullName = $conn->real_escape_string($_POST['full_name']);
        $email = $conn->real_escape_string($_POST['email']);
        $userRole = $conn->real_escape_string($_POST['user_role']);
        $status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : null;
        
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die(json_encode(['success' => false, 'message' => 'Invalid email format']));
        }
        
        // Validate user role
        $allowed_roles = ['super_admin', 'admin', 'management', 'ground_team', 'user'];
        if (!in_array($userRole, $allowed_roles)) {
            die(json_encode(['success' => false, 'message' => 'Invalid user role']));
        }
        
        try {
            // Start transaction
            $conn->begin_transaction();
            
            // Check user permissions for role changes 
            $check_query = "SELECT user_role FROM users WHERE id = ?";
            $stmt = $conn->prepare($check_query);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $current_user = $result->fetch_assoc();
            
            // Only super_admin can edit other super_admins
            if ($current_user['user_role'] === 'super_admin' && $_SESSION['user_role'] !== 'super_admin') {
                throw new Exception('You do not have permission to edit a super admin');
            }
            
            // Build update query based on provided data
            $updateFields = ["full_name = ?", "email = ?", "user_role = ?"];
            $params = [$fullName, $email, $userRole];
            $types = "sss";
            
            // Add password update if provided
            if (!empty($_POST['password'])) {
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $updateFields[] = "password = ?";
                $params[] = $hashedPassword;
                $types .= "s";
            }
            
            // Add status update if provided
            if ($status !== null) {
                $updateFields[] = "status = ?";
                $params[] = $status;
                $types .= "s";
            }
            
            // Add user ID to parameters
            $params[] = $userId;
            $types .= "i";
            
            // Prepare and execute update query
            $query = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0 || $stmt->errno === 0) {
                $conn->commit();
                
                // Fetch updated user data
                $query = "SELECT id, full_name, email, user_role, status FROM users WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $updated_user = $result->fetch_assoc();
                
                $response = [
                    'success' => true,
                    'message' => 'User updated successfully',
                    'user' => $updated_user
                ];
            } else {
                throw new Exception('No changes were made or an error occurred');
            }
            
        } catch (Exception $e) {
            $conn->rollback();
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
        
        echo json_encode($response);
        exit;
    }
} catch (Exception $e) {
    error_log("Error in update_user.php: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
    exit;
} 