<?php
session_start();
require_once 'config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    // Check if user exists and get their status
    $query = "SELECT id, email, password, full_name, user_role, status FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        // Check if account is blocked
        if ($user['status'] === 'blocked') {
            $_SESSION['login_error'] = "Your account has been blocked. Please contact the administrator.";
            header('Location: login.php');
            exit();
        }
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['user_role'] = $user['user_role'];
            
            // Redirect based on user role
            switch ($user['user_role']) {
                case 'super_admin':
                case 'admin':
                case 'management':
                    header('Location: dashboard/index.php');
                    break;
                default:
                    header('Location: userdash.php');
            }
            exit();
        }
    }
    
    // If we get here, login failed
    $_SESSION['login_error'] = "Invalid email or password";
    header('Location: login.php');
    exit();
}

// If not POST request, redirect to login page
header('Location: login.php');
exit(); 