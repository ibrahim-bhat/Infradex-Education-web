<?php
session_start();
require_once '../config/db_connect.php';

// Check if user is logged in and has admin privileges
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management', 'ground_team'])) {
    header('Location: ../login-new.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$success_message = '';
$error_message = '';

// Handle profile photo upload
if (isset($_FILES['profile_photo'])) {
    $file = $_FILES['profile_photo'];
    
    // Initialize error array
    $upload_errors = [];
    
    // Validate file
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
    $max_size = 5 * 1024 * 1024; // 5MB
    $upload_dir = '../uploads/profile_photos/';
    
    // Check for upload errors
    if ($file['error'] !== 0) {
        switch ($file['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $upload_errors[] = "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $upload_errors[] = "The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $upload_errors[] = "The uploaded file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $upload_errors[] = "No file was uploaded.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $upload_errors[] = "Missing a temporary folder.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $upload_errors[] = "Failed to write file to disk.";
                break;
            default:
                $upload_errors[] = "Unknown upload error.";
        }
    } else {
        // Validate file type
        if (!in_array($file['type'], $allowed_types)) {
            $upload_errors[] = "Invalid file type. Only JPG and PNG files are allowed.";
        }
        
        // Validate file size
        if ($file['size'] > $max_size) {
            $upload_errors[] = "File is too large. Maximum size is 5MB.";
        }
        
        // Create upload directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                $upload_errors[] = "Failed to create upload directory.";
            }
        }
        
        // Process upload if no errors
        if (empty($upload_errors)) {
            // Generate unique filename
            $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $new_filename = 'profile_' . $user_id . '_' . time() . '.' . $file_extension;
            $target_path = $upload_dir . $new_filename;
            
            // Delete old profile photo if exists
            $sql = "SELECT profile_photo FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $old_photo = $result->fetch_assoc();
            
            if ($old_photo && $old_photo['profile_photo']) {
                $old_photo_path = $upload_dir . $old_photo['profile_photo'];
                if (file_exists($old_photo_path)) {
                    unlink($old_photo_path);
                }
            }
            
            // Move uploaded file
            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                // Update database
                $sql = "UPDATE users SET profile_photo = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $new_filename, $user_id);
                
                if ($stmt->execute()) {
                    $_SESSION['profile_photo'] = $new_filename;
                    $success_message = "Profile photo updated successfully!";
                } else {
                    $upload_errors[] = "Failed to update database. Error: " . $conn->error;
                    // Delete uploaded file if database update fails
                    if (file_exists($target_path)) {
                        unlink($target_path);
                    }
                }
            } else {
                $upload_errors[] = "Failed to move uploaded file.";
            }
        }
    }
    
    // Set error message if there were any errors
    if (!empty($upload_errors)) {
        $error_message = implode("<br>", $upload_errors);
    }
}

// Handle password change
if (isset($_POST['change_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        if (strlen($new_password) >= 8) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $hashed_password, $user_id);

            if ($stmt->execute()) {
                $success_message = "Password changed successfully!";
            } else {
                $error_message = "Error updating password.";
            }
        } else {
            $error_message = "New password must be at least 8 characters long.";
        }
    } else {
        $error_message = "New passwords do not match.";
    }
}

// Get user data
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="css/charts.css">
    <style>
        .profile-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(78, 115, 223, 0.15);
            border: 1px solid rgba(78, 115, 223, 0.1);
            backdrop-filter: blur(10px);
            overflow: hidden;
            margin-bottom: 30px;
        }
    
        .profile-header {
            background: linear-gradient(145deg, var(--primary-color) 0%, var(--info-color) 100%);
            padding: 40px;
            color: white;
            text-align: center;
            position: relative;
        }
    
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            opacity: 0.5;
        }
    
        .profile-photo-container {
            position: relative;
            width: 180px;
            height: 180px;
            margin: 0 auto 25px;
        }
    
        .profile-photo {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
    
        .photo-upload-label {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: var(--primary-color);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    
        .photo-upload-label:hover {
            transform: scale(1.1) rotate(5deg);
            background: var(--info-color);
        }
    
        .profile-info {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            margin-top: 20px;
        }
    
        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
    
        .info-item i {
            font-size: 20px;
            width: 30px;
            text-align: center;
        }
    
        .info-label {
            font-size: 14px;
            opacity: 0.9;
        }
    
        .info-value {
            font-weight: 600;
            font-size: 16px;
        }
    
        .profile-content {
            padding: 40px;
        }
    
        .section-title {
            color: var(--dark-color);
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid rgba(78, 115, 223, 0.1);
            position: relative;
        }
    
        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--info-color));
        }
    
        .password-form {
            background: rgba(78, 115, 223, 0.03);
            padding: 30px;
            border-radius: 15px;
            border: 1px solid rgba(78, 115, 223, 0.1);
        }
    
        .password-form .form-control {
            border: 2px solid rgba(78, 115, 223, 0.2);
            border-radius: 12px;
            padding: 15px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }
    
        .password-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(78, 115, 223, 0.1);
            background: #ffffff;
        }
    
        .password-form label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
        }
    
        .btn-change-password {
            background: linear-gradient(145deg, var(--primary-color) 0%, var(--info-color) 100%);
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }
    
        .btn-change-password:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(78, 115, 223, 0.2);
        }
    
        .password-strength {
            height: 6px;
            border-radius: 3px;
            margin-top: 8px;
            transition: all 0.3s ease;
            background: #e9ecef;
        }
    
        .password-strength-text {
            font-size: 14px;
            margin-top: 8px;
            font-weight: 500;
        }
    
        .alert {
            border-radius: 15px;
            border: none;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
    
        .alert i {
            font-size: 24px;
        }
    
        @media (max-width: 768px) {
            .profile-header {
                padding: 30px 20px;
            }
    
            .profile-photo-container {
                width: 150px;
                height: 150px;
            }
    
            .profile-photo {
                width: 150px;
                height: 150px;
            }
    
            .profile-content {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <?php include 'components/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'components/header.php'; ?>

            <div class="content-wrapper">
                <div class="container-fluid">
                    <?php if ($success_message): ?>
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle"></i>
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($error_message): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <div class="profile-section">
                        <div class="profile-header">
                            <div class="profile-photo-container">
                                <img src="<?php echo isset($user['profile_photo']) ? '../uploads/profile_photos/' . $user['profile_photo'] : 'https://via.placeholder.com/150'; ?>"
                                    alt="Profile Photo"
                                    class="profile-photo"
                                    id="profilePhotoPreview">
                                <label for="profilePhotoInput" class="photo-upload-label">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <form id="photoForm" method="POST" enctype="multipart/form-data" style="display: none;">
                                    <input type="file"
                                        id="profilePhotoInput"
                                        name="profile_photo"
                                        accept="image/jpeg,image/png,image/jpg"
                                        onchange="submitPhoto(this)">
                                </form>
                            </div>
                            <h2 class="profile-name"><?php echo htmlspecialchars($user['name']); ?></h2>
                            <div class="profile-role"><?php echo htmlspecialchars(ucfirst($user['role'])); ?></div>

                            <div class="profile-info">
                                <div class="info-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <div class="info-label">Email Address</div>
                                        <div class="info-value"><?php echo htmlspecialchars($user['email']); ?></div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-user-shield"></i>
                                    <div>
                                        <div class="info-label">Account Type</div>
                                        <div class="info-value"><?php echo htmlspecialchars(ucfirst($user['role'])); ?></div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <div>
                                        <div class="info-label">Member Since</div>
                                        <div class="info-value"><?php echo date('F j, Y', strtotime($user['created_at'])); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="profile-content">
                            <h3 class="section-title">Security Settings</h3>
                            <form class="password-form" method="POST" onsubmit="return validatePassword()">
                                <div class="mb-4">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <input type="password"
                                        class="form-control"
                                        id="newPassword"
                                        name="new_password"
                                        required
                                        onkeyup="checkPasswordStrength()"
                                        placeholder="Enter your new password">
                                    <div class="password-strength" id="passwordStrength"></div>
                                    <div class="password-strength-text" id="passwordStrengthText"></div>
                                </div>

                                <div class="mb-4">
                                    <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                    <input type="password"
                                        class="form-control"
                                        id="confirmPassword"
                                        name="confirm_password"
                                        required
                                        placeholder="Confirm your new password">
                                </div>

                                <button type="submit"
                                    name="change_password"
                                    class="btn btn-primary btn-change-password">
                                    <i class="fas fa-shield-alt me-2"></i>Update Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validatePassword() {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (newPassword !== confirmPassword) {
                alert('New passwords do not match!');
                return false;
            }

            if (newPassword.length < 8) {
                alert('Password must be at least 8 characters long!');
                return false;
            }

            return true;
        }

        function checkPasswordStrength() {
            const password = document.getElementById('newPassword').value;
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');

            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            switch (strength) {
                case 0:
                case 1:
                    strengthBar.style.width = '20%';
                    strengthBar.style.backgroundColor = '#dc3545';
                    strengthText.textContent = 'Weak Password';
                    strengthText.style.color = '#dc3545';
                    break;
                case 2:
                case 3:
                    strengthBar.style.width = '60%';
                    strengthBar.style.backgroundColor = '#ffc107';
                    strengthText.textContent = 'Medium Password';
                    strengthText.style.color = '#ffc107';
                    break;
                case 4:
                case 5:
                    strengthBar.style.width = '100%';
                    strengthBar.style.backgroundColor = '#28a745';
                    strengthText.textContent = 'Strong Password';
                    strengthText.style.color = '#28a745';
                    break;
            }
        }

        // Handle photo upload
        function submitPhoto(input) {
            const file = input.files[0];
            if (file) {
                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePhotoPreview').src = e.target.result;
                }
                reader.readAsDataURL(file);

                // Check file size
                if (file.size > 5 * 1024 * 1024) {
                    alert('File is too large. Maximum size is 5MB.');
                    return;
                }

                // Check file type
                if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    alert('Invalid file type. Only JPG and PNG files are allowed.');
                    return;
                }

                // Submit form
                document.getElementById('photoForm').submit();
            }
        }
    </script>
</body>

</html>