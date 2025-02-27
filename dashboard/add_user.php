<?php
session_start();
// Allow super_admin, admin, and management to access this page
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_role = $conn->real_escape_string($_POST['user_role']);

    // Management users can only create users with 'user' or 'ground_team' role
    if ($_SESSION['user_role'] == 'management' && !in_array($user_role, ['user', 'ground_team'])) {
        $_SESSION['error'] = "Management users can only create users with 'user' or 'ground_team' role.";
        header('Location: add_user.php');
        exit();
    }

    // Check if email already exists
    $check_query = "SELECT id FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $_SESSION['error'] = "Email already exists.";
    } else {
        $query = "INSERT INTO users (full_name, email, password, user_role) 
                  VALUES ('$full_name', '$email', '$password', '$user_role')";
        
        if ($conn->query($query)) {
            $_SESSION['success'] = "User added successfully.";
            header('Location: users.php');
            exit();
        } else {
            $_SESSION['error'] = "Error adding user: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/components.css">
</head>

<body>
    <div class="admin-container">
        <?php include 'components/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'components/header.php'; ?>

            <div class="content-wrapper">
                <div class="content-header">
                    <h1>Add New User</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                            <li class="breadcrumb-item active">Add User</li>
                        </ol>
                    </nav>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="form-card">
                            <div class="form-header">
                                <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Create New User Account</h4>
                            </div>
                            <div class="form-body">
                                <?php if (isset($_SESSION['error'])): ?>
                                    <div class="alert alert-danger">
                                        <?php 
                                            echo $_SESSION['error'];
                                            unset($_SESSION['error']);
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <form id="addUserForm" method="POST" action="">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Full Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                <input type="text" name="full_name" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="password-wrapper">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                <input type="password" name="password" id="password" class="form-control" required>
                                                <span class="input-group-text toggle-password" onclick="togglePassword()">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            <div class="password-strength" id="passwordStrength"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">User Role</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                            <select name="user_role" class="form-control role-select" required>
                                                <?php if ($_SESSION['user_role'] == 'super_admin'): ?>
                                                    <option value="admin">Admin</option>
                                                    <option value="management">Management</option>
                                                    <option value="ground_team">Ground Team</option>
                                                    <option value="user">User</option>
                                                <?php elseif ($_SESSION['user_role'] == 'admin'): ?>
                                                    <option value="management">Management</option>
                                                    <option value="ground_team">Ground Team</option>
                                                    <option value="user">User</option>
                                                <?php else: ?>
                                                    <option value="ground_team">Ground Team</option>
                                                    <option value="user">User</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="users.php" class="btn btn-light">
                                            <i class="fas fa-arrow-left me-2"></i>Back to Users
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-submit">
                                            <i class="fas fa-user-plus me-2"></i>Create User
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Password strength checker
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthDiv = document.getElementById('passwordStrength');
            let strength = 0;
            let message = '';

            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            if (password.length >= 8) strength++;

            switch (strength) {
                case 0:
                case 1:
                    message = '<span class="strength-weak"><i class="fas fa-times-circle"></i> Weak password</span>';
                    break;
                case 2:
                case 3:
                    message = '<span class="strength-medium"><i class="fas fa-exclamation-circle"></i> Medium password</span>';
                    break;
                case 4:
                case 5:
                    message = '<span class="strength-strong"><i class="fas fa-check-circle"></i> Strong password</span>';
                    break;
            }

            strengthDiv.innerHTML = message;
        });

        // Form validation
        $('#addUserForm').on('submit', function(e) {
            const password = $('#password').val();
            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters long');
                return false;
            }
        });
    </script>
</body>

</html>