<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $user_role = $conn->real_escape_string($_POST['user_role']);
    
    // Check if email exists
    $check_email = $conn->query("SELECT id FROM users WHERE email = '$email'");
    if ($check_email->num_rows > 0) {
        $error_message = "Email already exists!";
    } else {
        $query = "INSERT INTO users (email, password, full_name, user_role) 
                  VALUES ('$email', '$password', '$full_name', '$user_role')";
        
        if ($conn->query($query)) {
            $success_message = "User added successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .form-header {
            background: linear-gradient(45deg, #4e73df, #224abe);
            padding: 20px;
            color: white;
            text-align: center;
        }
        .form-body {
            padding: 30px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 2px solid #e3e6f0;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78,115,223,0.25);
        }
        .form-label {
            font-weight: 600;
            color: #4e73df;
            margin-bottom: 8px;
        }
        .password-wrapper {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
        .role-select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }
        .btn-submit {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            background: linear-gradient(45deg, #4e73df, #224abe);
            border: none;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78,115,223,0.4);
        }
        .alert {
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #1cc88a20;
            border-color: #1cc88a;
            color: #1cc88a;
        }
        .alert-danger {
            background-color: #e74a3b20;
            border-color: #e74a3b;
            color: #e74a3b;
        }
        .password-strength {
            margin-top: 5px;
            font-size: 12px;
        }
        .strength-weak { color: #e74a3b; }
        .strength-medium { color: #f6c23e; }
        .strength-strong { color: #1cc88a; }
    </style>
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
                                <?php if (isset($success_message)): ?>
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (isset($error_message)): ?>
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i><?php echo $error_message; ?>
                                    </div>
                                <?php endif; ?>

                                <form id="addUserForm" method="POST" action="">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Full Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                <input type="text" name="full_name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" name="email" class="form-control" required>
                                            </div>
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
                                                <?php endif; ?>
                                                <option value="management">Management</option>
                                                <option value="user">User</option>
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

        switch(strength) {
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