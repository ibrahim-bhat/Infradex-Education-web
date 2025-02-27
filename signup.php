<?php
session_start();
if (isset($_SESSION['user_role'])) {
    header('Location: dashboard/dashboard.php');
    exit();
}

require_once 'config/db_connect.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Check if email already exists
        $check_query = "SELECT id FROM users WHERE email = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            throw new Exception("Email already exists!");
        }

        // Insert into users table
        $user_query = "INSERT INTO users (full_name, email, password, user_role) VALUES (?, ?, ?, 'user')";
        $user_stmt = $conn->prepare($user_query);
        $user_stmt->bind_param("sss", $full_name, $email, $password);
        
        if (!$user_stmt->execute()) {
            throw new Exception("Error creating user account");
        }

        $user_id = $conn->insert_id;

        // Insert into students table with basic info and default values
        $student_query = "INSERT INTO students (
            full_name, 
            email, 
            phone_number,
            dob,
            gender,
            class,
            city,
            state,
            pincode,
            colony,
            parent_name,
            parent_phone,
            added_by, 
            created_at
        ) VALUES (
            ?, 
            ?, 
            '', /* default empty phone */
            NULL, /* default null dob */
            '', /* default empty gender */
            '', /* default empty class */
            '', /* default empty city */
            '', /* default empty state */
            '', /* default empty pincode */
            '', /* default empty colony */
            '', /* default empty parent name */
            '', /* default empty parent phone */
            ?,
            NOW()
        )";
        $student_stmt = $conn->prepare($student_query);
        $student_stmt->bind_param("ssi", $full_name, $email, $user_id);
        
        if (!$student_stmt->execute()) {
            throw new Exception("Error creating student record");
        }

        // If everything is successful, commit the transaction
        $conn->commit();
        $success_message = "Account created successfully! Please login.";
        header("refresh:2;url=login.php");

    } catch (Exception $e) {
        // If there's an error, rollback the transaction
        $conn->rollback();
        $error_message = $e->getMessage();
        error_log("Signup error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - School Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .success {
            color: green;
            background-color: #dff0d8;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .error {
            color: #a94442;
            background-color: #f2dede;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
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

                <?php if ($success_message): ?>
                    <div class="success"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="error"><?php echo $error_message; ?></div>
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