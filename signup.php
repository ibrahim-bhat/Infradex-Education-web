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
    <title>Sign Up - Infradex Education</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .signup-container {
            display: flex;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            max-width: 1000px;
            width: 90%;
            margin: 2rem auto;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .signup-image {
            flex: 1;
            background: linear-gradient(135deg, rgba(128, 0, 255, 0.8), rgba(74, 0, 224, 0.8)),
                        url('images/education-bg.jpg') center/cover;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .signup-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(128, 0, 255, 0.3) 0%, transparent 70%);
            animation: pulse 2s infinite;
        }

        .signup-image h1 {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .signup-image p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .signup-form {
            flex: 1;
            padding: 3rem;
            background: rgba(0, 0, 0, 0.3);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h2 {
            font-size: 2rem;
            color: white;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #8000ff;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 2px rgba(128, 0, 255, 0.2);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        button[type="submit"] {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(45deg, #8000ff, #6600cc);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        button[type="submit"]:hover {
            background: linear-gradient(45deg, #9933ff, #7700e6);
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .login-link a {
            color: #8000ff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: #9933ff;
            text-decoration: underline;
        }

        .success {
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid rgba(40, 167, 69, 0.3);
            color: #2ecc71;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .error {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #ff6b6b;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .signup-container {
                flex-direction: column;
                width: 95%;
            }

            .signup-image {
                padding: 2rem;
                text-align: center;
            }

            .signup-image h1 {
                font-size: 2rem;
            }

            .signup-form {
                padding: 2rem;
            }
        }

        @keyframes pulse {
            0% {
                opacity: 0.6;
            }
            50% {
                opacity: 0.8;
            }
            100% {
                opacity: 0.6;
            }
        }
    </style>
</head>
<body>
    <div class="scanlines"></div>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="signup-container">
            <div class="signup-image">
                <h1>Welcome to Infradex Education</h1>
                <p>Join our community and get access to world-class education, resources, and opportunities for growth. Start your learning journey today!</p>
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
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Choose a password (min. 6 characters)" required minlength="6">
                    </div>

                    <button type="submit">Create Account</button>
                </form>
                
                <div class="login-link">
                    Already have an account? <a href="login.php">Sign in</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Add password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            updatePasswordStrength(strength);
        });

        function calculatePasswordStrength(password) {
            let strength = 0;
            
            // Length check
            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;
            
            // Character variety checks
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[a-z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            return Math.min(strength, 5);
        }

        function updatePasswordStrength(strength) {
            const input = document.getElementById('password');
            const colors = ['#ff4444', '#ffbb33', '#00C851', '#33b5e5', '#8000ff'];
            
            if (strength > 0) {
                input.style.borderColor = colors[strength - 1];
                input.style.boxShadow = `0 0 0 2px ${colors[strength - 1]}33`;
            } else {
                input.style.borderColor = 'rgba(255, 255, 255, 0.1)';
                input.style.boxShadow = 'none';
            }
        }
    </script>
</body>
</html> 