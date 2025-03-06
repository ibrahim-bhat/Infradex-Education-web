<?php
session_start();
require_once 'config/db_connect.php';

// Function to send JSON response
function sendResponse($success, $message, $redirect = '') {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'redirect' => $redirect
    ]);
    exit;
}

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate required fields
        $required_fields = ['full_name', 'email', 'phone', 'password', 'confirm_password'];
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                sendResponse(false, 'All fields are required.');
            }
        }

        // Extract and sanitize input
        $full_name = $conn->real_escape_string(trim($_POST['full_name']));
        $email = $conn->real_escape_string(trim($_POST['email']));
        $phone = $conn->real_escape_string(trim($_POST['phone']));
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            sendResponse(false, 'Please enter a valid email address.');
        }

        // Validate phone number format (basic validation)
        if (!preg_match('/^\+?[1-9]\d{9,14}$/', preg_replace('/[^0-9+]/', '', $phone))) {
            sendResponse(false, 'Please enter a valid phone number.');
        }

        // Validate password match
        if ($password !== $confirm_password) {
            sendResponse(false, 'Passwords do not match.');
        }

        // Validate password strength
        if (strlen($password) < 8) {
            sendResponse(false, 'Password must be at least 8 characters long.');
        }

        // Check if email already exists
        $check_query = "SELECT id FROM users WHERE email = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows > 0) {
            sendResponse(false, 'Email address is already registered.');
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $insert_query = "INSERT INTO users (full_name, email, phone, password, user_role, created_at) VALUES (?, ?, ?, ?, 'user', NOW())";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ssss", $full_name, $email, $phone, $hashed_password);

        if ($insert_stmt->execute()) {
            sendResponse(true, 'Registration successful! Please login.', 'login.php');
        } else {
            sendResponse(false, 'Registration failed. Please try again.');
        }
    }
} catch (Exception $e) {
    error_log("Signup error: " . $e->getMessage());
    sendResponse(false, 'An error occurred. Please try again.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Infradex Education</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4ecdc4;
            --secondary-color: #ff6b6b;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--dark-color) 0%, #1a1a1a 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .signup-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .signup-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -50%;
            width: 200%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-container i {
            font-size: 48px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }

        h1 {
            color: var(--light-color);
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.2em;
        }

        .form-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            color: var(--light-color);
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            outline: none;
            background: rgba(255, 255, 255, 0.1);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: var(--light-color);
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: var(--secondary-color);
        }

        .error-message {
            background: rgba(255, 107, 107, 0.1);
            border-left: 4px solid var(--secondary-color);
            color: var(--light-color);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: none;
        }

        @media (max-width: 480px) {
            .signup-container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="logo-container">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <h1>Create Account</h1>
        <div class="error-message" id="errorMessage"></div>
        
        <form id="signupForm" method="POST">
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="full_name" placeholder="Full Name" required>
            </div>

            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <div class="form-group">
                <i class="fas fa-phone"></i>
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>

            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <button type="submit">
                <span>Sign Up</span>
            </button>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const errorMessage = document.getElementById('errorMessage');
            
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    errorMessage.style.display = 'block';
                    errorMessage.textContent = data.message;
                }
            })
            .catch(error => {
                errorMessage.style.display = 'block';
                errorMessage.textContent = 'An error occurred. Please try again.';
            });
        });
    </script>
</body>
</html> 