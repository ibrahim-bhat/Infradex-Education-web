<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    header('HTTP/1.1 403 Forbidden');
    exit('Access denied');
}

// Create uploads directory if it doesn't exist
$upload_dir = "../uploads/blog/content";
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Handle file upload
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // Validate file
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
    $max_size = 5 * 1024 * 1024; // 5MB
    
    if ($file['error'] !== 0) {
        header('HTTP/1.1 400 Bad Request');
        exit('File upload failed with error code: ' . $file['error']);
    }
    
    if (!in_array($file['type'], $allowed_types)) {
        header('HTTP/1.1 400 Bad Request');
        exit('Only JPG, JPEG, PNG, GIF, and WEBP images are allowed.');
    }
    
    if ($file['size'] > $max_size) {
        header('HTTP/1.1 400 Bad Request');
        exit('File size should be less than 5MB.');
    }
    
    // Generate unique filename
    $file_name = time() . '_' . $file['name'];
    $file_name = str_replace(' ', '_', $file_name);
    $upload_path = $upload_dir . '/' . $file_name;
    
    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        // Return the URL to the uploaded file
        echo '../uploads/blog/content/' . $file_name;
    } else {
        header('HTTP/1.1 500 Internal Server Error');
        exit('Failed to upload file.');
    }
} else {
    header('HTTP/1.1 400 Bad Request');
    exit('No file uploaded.');
}
?> 