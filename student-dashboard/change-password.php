<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Verify passwords match
    if ($new_password !== $confirm_password) {
        $_SESSION['password_error'] = "New passwords do not match!";
        header('Location: profile-settings.php');
        exit();
    }

    // Get current user's password
    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verify current password
    if (!password_verify($current_password, $user['password'])) {
        $_SESSION['password_error'] = "Current password is incorrect!";
        header('Location: profile-settings.php');
        exit();
    }

    // Update password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_query = "UPDATE users SET password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("si", $hashed_password, $_SESSION['user_id']);

    if ($update_stmt->execute()) {
        $_SESSION['password_success'] = "Password updated successfully!";
    } else {
        $_SESSION['password_error'] = "Error updating password. Please try again.";
    }

    header('Location: profile-settings.php');
    exit();
} 