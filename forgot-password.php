<?php
session_start();
require_once 'config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    
    // Check if email exists
    $query = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Generate unique token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        // Store token in password_resets table
        $insert_query = "INSERT INTO password_resets (email, token, expiry) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sss", $email, $token, $expiry);
        
        if ($stmt->execute()) {
            // Send email with reset link
            $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/reset-password.php?token=" . $token;
            $to = $email;
            $subject = "Password Reset Request";
            $message = "Hello,\n\nYou have requested to reset your password. Click the link below to reset it:\n\n";
            $message .= $reset_link . "\n\n";
            $message .= "This link will expire in 1 hour.\n\n";
            $message .= "If you didn't request this, please ignore this email.\n\n";
            $message .= "Best regards,\nYour Website Team";
            $headers = "From: noreply@yourwebsite.com";

            if (mail($to, $subject, $message, $headers)) {
                echo json_encode(['success' => true, 'message' => 'Password reset instructions have been sent to your email.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error sending email. Please try again.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error processing request. Please try again.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email address not found.']);
    }
    exit();
}
?> 