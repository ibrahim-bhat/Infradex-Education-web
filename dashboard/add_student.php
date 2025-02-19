<?php
session_start();
// Check if user is logged in and has appropriate role
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $class = $conn->real_escape_string($_POST['class']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $pincode = $conn->real_escape_string($_POST['pincode']);
    $colony = $conn->real_escape_string($_POST['colony']);
    $parent_name = $conn->real_escape_string($_POST['parent_name']);
    $parent_phone = $conn->real_escape_string($_POST['parent_phone']);
    $added_by = $_SESSION['user_id']; // Get the current user's ID

    $check_email = $conn->query("SELECT id FROM users WHERE email = '$email'");
    if ($check_email->num_rows > 0) {
        $error_message = "Email already exists!";
    } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $query = "INSERT INTO users (email, password, full_name, user_role) 
                  VALUES ('$email', '$password', '$full_name', 'student')";
        
        if ($conn->query($query)) {
            // Add additional student details if needed
            $success_message = "Student added successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}

// Get current user's details
$user_query = "SELECT username, user_role FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user_result = $stmt->get_result();
$current_user = $user_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .success {
            color: green;
            padding: 10px;
            background: #e8f5e9;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            padding: 10px;
            background: #ffebee;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Student</h2>
        
        <?php if (isset($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="full_name" required>
            </div>

            <div class="form-group">
                <label>Phone Number:</label>
                <input type="tel" name="phone" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="date" name="dob" required>
            </div>

            <div class="form-group">
                <label>Gender:</label>
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Class:</label>
                <select name="class" required>
                    <option value="">Select Class</option>
                    <option value="nursery">Nursery</option>
                    <?php for($i=1; $i<=12; $i++): ?>
                        <option value="<?php echo $i; ?>">Class <?php echo $i; ?></option>
                    <?php endfor; ?>
                    <option value="college">College</option>
                </select>
            </div>

            <div class="form-group">
                <label>City:</label>
                <input type="text" name="city" required>
            </div>

            <div class="form-group">
                <label>State:</label>
                <input type="text" name="state" required>
            </div>

            <div class="form-group">
                <label>Pin Code:</label>
                <input type="text" name="pincode" required>
            </div>

            <div class="form-group">
                <label>Colony/Area:</label>
                <input type="text" name="colony" required>
            </div>

            <div class="form-group">
                <label>Parent's Name:</label>
                <input type="text" name="parent_name" required>
            </div>

            <div class="form-group">
                <label>Parent's Phone Number:</label>
                <input type="tel" name="parent_phone" required>
            </div>

            <div class="form-group mb-4">
                <label>Added By:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($current_user['username'] . ' (' . ucfirst($current_user['user_role']) . ')'); ?>" readonly>
                    <input type="hidden" name="added_by" value="<?php echo $_SESSION['user_id']; ?>">
                </div>
            </div>

            <button type="submit">Add Student</button>
        </form>

        <div style="margin-top: 20px;">
            <a href="dashboard.php" style="color: #4CAF50; text-decoration: none;">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html> 