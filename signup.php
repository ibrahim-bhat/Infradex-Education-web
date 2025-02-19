<?php
session_start();
if (isset($_SESSION['user_role'])) {
    header('Location: dashboard/dashboard.php');
    exit();
}

require_once 'config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $conn->real_escape_string($_POST['full_name']);
    
    // Always set default role as 'user' for public signups
    $user_role = 'user';

    // Check if email already exists
    $check_email = $conn->query("SELECT id FROM users WHERE email = '$email'");
    if ($check_email->num_rows > 0) {
        $error_message = "Email already exists!";
    } else {
        $query = "INSERT INTO users (email, password, full_name, user_role) 
                  VALUES ('$email', '$password', '$full_name', '$user_role')";
        
        if ($conn->query($query)) {
            $success_message = "Registration successful! Please login.";
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