<?php
session_start();
if (isset($_SESSION['user_role'])) {
    header('Location: dashboard/dashboard.php');
    exit();
}

require_once 'config/db_connect.php';

$error_message = '';
$success_message = '';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate inputs
        if (empty($_POST['full_name']) || empty($_POST['email']) || empty($_POST['password'])) {
            $error_message = "All fields are required.";
        } else {
            $full_name = $conn->real_escape_string($_POST['full_name']);
            $email = $conn->real_escape_string($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // Check if email exists
            $check_query = "SELECT id FROM users WHERE email = ?";
            $check_stmt = $conn->prepare($check_query);
            $check_stmt->bind_param("s", $email);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
            
            if ($check_result->num_rows > 0) {
                $error_message = "Email already exists!";
            } else {
                // Insert new user
                $insert_query = "INSERT INTO users (full_name, email, password, user_role) VALUES (?, ?, ?, 'user')";
                $insert_stmt = $conn->prepare($insert_query);
                $insert_stmt->bind_param("sss", $full_name, $email, $password);
                
                if ($insert_stmt->execute()) {
                    $success_message = "Registration successful! You can now login.";
                    // Optionally redirect to login page after successful signup
                    header("Location: index.php?registered=true");
                    exit();
                } else {
                    $error_message = "Error creating account. Please try again.";
                    error_log("Signup error: " . $insert_stmt->error);
                }
            }
        }
    }
} catch (Exception $e) {
    error_log("Signup error: " . $e->getMessage());
    $error_message = "An error occurred. Please try again.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - InfradexEdu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="scanlines"></div>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="signup-container">
            <div class="signup-image">
                <h1>Welcome to Our School</h1>
                <p>Join our community and get access to world-class education, resources, and opportunities for growth.</p>
            </div>
            
            <div class="signup-form">
                <div class="form-header">
                    <h2>Create Account</h2>
                    <p>Fill in your details to get started</p>
                </div>

                <?php if (isset($error_message)): ?>
                    <div class="error"><?php echo $error_message; ?></div>
                <?php endif; ?>
                
                <?php if (isset($success_message)): ?>
                    <div class="success"><?php echo $success_message; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Choose a password (min. 6 characters)" required minlength="6">
                    </div>

                    <button type="submit">Create Account</button>
                </form>
                
                <div class="login-link">
                    Already have an account? <a href="login.php">Sign in</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 