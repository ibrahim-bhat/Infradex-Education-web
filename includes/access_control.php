<?php
function checkUserAccess($allowed_roles = []) {
    session_start();
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
        header('Location: ../login-new.php');
        exit();
    }
    
    // If no specific roles are required, just being logged in is enough
    if (empty($allowed_roles)) {
        return true;
    }
    
    // Check if user's role is in the allowed roles array
    if (!in_array($_SESSION['user_role'], $allowed_roles)) {
        // Redirect based on role
        if ($_SESSION['user_role'] == 'user') {
            header('Location: ../student-dashboard/index.php');
        } else {
            header('Location: ../dashboard/dashboard.php');
        }
        exit();
    }
    
    return true;
} 