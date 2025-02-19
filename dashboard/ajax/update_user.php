<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    exit(json_encode(['success' => false, 'message' => 'Unauthorized']));
}

require_once '../../config/db_connect.php';

if(isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    
    // Check if user exists and get their current role
    $check_query = "SELECT user_role FROM users WHERE id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $current_user = $result->fetch_assoc();
    
    if (!$current_user) {
        exit(json_encode(['success' => false, 'message' => 'User not found']));
    }
    
    // Prevent editing super_admin users
    if ($current_user['user_role'] == 'super_admin') {
        exit(json_encode(['success' => false, 'message' => 'Super admin accounts cannot be modified']));
    }
    
    // Only super_admin can edit admin accounts
    if ($current_user['user_role'] == 'admin' && $_SESSION['user_role'] != 'super_admin') {
        exit(json_encode(['success' => false, 'message' => 'You cannot edit admin accounts']));
    }
    
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $user_role = $conn->real_escape_string($_POST['user_role']);
    
    // Role restriction checks
    if ($_SESSION['user_role'] != 'super_admin') {
        // Non-super_admin users can only assign management or user roles
        if ($user_role == 'admin' || $user_role == 'super_admin') {
            exit(json_encode(['success' => false, 'message' => 'You cannot assign admin or super admin roles']));
        }
        
        // Prevent changing admin roles
        if ($current_user['user_role'] == 'admin') {
            $user_role = 'admin'; // Maintain admin role
        }
    } else {
        // Even super_admin cannot assign super_admin role
        if ($user_role == 'super_admin') {
            exit(json_encode(['success' => false, 'message' => 'Super admin role cannot be assigned']));
        }
    }
    
    // Check if username or email already exists
    $check_query = "SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ssi", $username, $email, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        exit(json_encode(['success' => false, 'message' => 'Username or email already exists!']));
    }
    
    // Start building the update query
    $query = "UPDATE users SET username = ?, email = ?, full_name = ?, user_role = ?";
    $params = [$username, $email, $full_name, $user_role];
    $types = "ssss";
    
    // If password is being changed
    if (!empty($_POST['password'])) {
        if (strlen($_POST['password']) < 8) {
            exit(json_encode(['success' => false, 'message' => 'Password must be at least 8 characters long']));
        }
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query .= ", password = ?";
        $params[] = $password;
        $types .= "s";
    }
    
    $query .= " WHERE id = ?";
    $params[] = $id;
    $types .= "i";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'User updated successfully' . (!empty($_POST['password']) ? ' with new password' : '')
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating user']);
    }
} 