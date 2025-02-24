<?php
session_start();
if (isset($_SESSION['user_role'])) {
    // Redirect based on role
    if ($_SESSION['user_role'] == 'user') {
        header('Location: student-dashboard/index.php');
    } else {
        header('Location: dashboard/dashboard.php');
    }
    exit();
}

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
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            sendResponse(false, 'Email and password are required.');
        }

        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            sendResponse(false, 'Database error occurred.');
        }
        
        $stmt->bind_param("s", $email);
        
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            sendResponse(false, 'Database error occurred.');
        }
        
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['user_role'] = $user['user_role'];
                
                // Role-based redirection
                $redirect = $user['user_role'] == 'user' ? 'student-dashboard/index.php' : 'dashboard/dashboard.php';
                sendResponse(true, 'Login successful', $redirect);
            } else {
                sendResponse(false, 'Invalid password!');
            }
        } else {
            sendResponse(false, 'Email not found!');
        }
    }
} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    sendResponse(false, 'An error occurred. Please try again.');
}

// If direct access, redirect to index
if (!isset($_POST['email'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - School Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .signup-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>
        
        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign up</a>
        </div>
    </div>
</body>
</html> 