<?php
session_start();
if (isset($_SESSION['user_role'])) {
    // Redirect based on role
    if ($_SESSION['user_role'] == 'user') {
        header('Location: student-dashboard/index.php');
        exit();
    } elseif (in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management', 'ground_team'])) {
        header('Location: dashboard/userdash.php');
        exit();
    } else {
        header('Location: dashboard/dashboard.php');
        exit();
    }
}

require_once 'config/db_connect.php';

// Function to send JSON response
function sendResponse($success, $message, $redirect = '')
{
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
                if ($user['user_role'] == 'user') {
                    $redirect = 'student-dashboard/index.php';
                } elseif (in_array($user['user_role'], ['super_admin', 'admin', 'management', 'ground_team'])) {
                    $redirect = 'dashboard/userdash.php';
                } else {
                    $redirect = 'dashboard/dashboard.php';
                }
                
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - InfradexEducation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
            /* box-sizing: border-box; */
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--dark-color) 0%, #1a1a1a 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            /* padding: 20px; */
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
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

        .login-container::before {
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
            0% {
                transform: translateX(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) rotate(45deg);
            }
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

        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: var(--light-color);
        }

        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
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
            .login-container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 2em;
            }
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="login-container">
            <div class="logo-container">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h1> Infradex Edu</h1>
            <div class="error-message" id="errorMessage"></div>

            <form id="loginForm" method="POST">
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit">
                    <span>Sign In</span>
                </button>
            </form>

            <div class="signup-link">
                Don't have an account? <a href="signup.php">Sign up</a>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
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