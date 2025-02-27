<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

// Fetch student details
$email = $_SESSION['email'];
$query = "SELECT * FROM students WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if student exists, if not create a basic record
if ($result->num_rows === 0) {
    // Insert basic student record with only necessary fields
    $insert_query = "INSERT INTO students (full_name, email, added_by, created_at) 
                    VALUES (?, ?, ?, NOW())";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("ssi", $_SESSION['full_name'], $email, $_SESSION['user_id']);
    
    if ($insert_stmt->execute()) {
        // Fetch the newly created student record
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
    } else {
        die("Error creating student record: " . $conn->error);
    }
} else {
    $student = $result->fetch_assoc();
}

$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Only process empty fields
    $updates = [];
    $types = "";
    $params = [];

    // Check each field - only allow updates for empty fields
    if (empty($student['phone_number']) && !empty($_POST['phone_number'])) {
        $updates[] = "phone_number = ?";
        $types .= "s";
        $params[] = $_POST['phone_number'];
    }
    if (empty($student['dob']) && !empty($_POST['dob'])) {
        $updates[] = "dob = ?";
        $types .= "s";
        $params[] = $_POST['dob'];
    }
    if (empty($student['gender']) && !empty($_POST['gender'])) {
        $updates[] = "gender = ?";
        $types .= "s";
        $params[] = $_POST['gender'];
    }
    if (empty($student['class']) && !empty($_POST['class'])) {
        $updates[] = "class = ?";
        $types .= "s";
        $params[] = $_POST['class'];
    }
    if (empty($student['city']) && !empty($_POST['city'])) {
        $updates[] = "city = ?";
        $types .= "s";
        $params[] = $_POST['city'];
    }
    if (empty($student['state']) && !empty($_POST['state'])) {
        $updates[] = "state = ?";
        $types .= "s";
        $params[] = $_POST['state'];
    }
    if (empty($student['pincode']) && !empty($_POST['pincode'])) {
        $updates[] = "pincode = ?";
        $types .= "s";
        $params[] = $_POST['pincode'];
    }
    if (empty($student['colony']) && !empty($_POST['colony'])) {
        $updates[] = "colony = ?";
        $types .= "s";
        $params[] = $_POST['colony'];
    }
    if (empty($student['parent_name']) && !empty($_POST['parent_name'])) {
        $updates[] = "parent_name = ?";
        $types .= "s";
        $params[] = $_POST['parent_name'];
    }
    if (empty($student['parent_phone']) && !empty($_POST['parent_phone'])) {
        $updates[] = "parent_phone = ?";
        $types .= "s";
        $params[] = $_POST['parent_phone'];
    }

    if (!empty($updates)) {
        $params[] = $email;
        $types .= "s";
        
        $sql = "UPDATE students SET " . implode(", ", $updates) . " WHERE email = ?";
        $update_stmt = $conn->prepare($sql);
        $update_stmt->bind_param($types, ...$params);

        if ($update_stmt->execute()) {
            $success_message = "Profile updated successfully!";
            // Refresh student data
            $stmt->execute();
            $result = $stmt->get_result();
            $student = $result->fetch_assoc();
        } else {
            $error_message = "Error updating profile: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings | Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="./css/dashboard.css" rel="stylesheet">
    <style>
        .form-control[readonly] {
            opacity: 0.8;
            cursor: not-allowed;
            border-color: rgba(255, 255, 255, 0.1);
            background: transparent !important;
            color: inherit !important;
        }
        .required-field::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }
    </style>
</head>
<body>
    <div class="glow-overlay"></div>
    <div class="scanlines"></div>

    <div class="dashboard-container">
        <?php include 'components/sidebar.php'; ?>

        <main class="main-content">
            <dashboard-header></dashboard-header>

            <div class="dashboard-content">
                <div class="section-header">
                    <h2>Profile Settings</h2>
                </div>

                <?php if ($success_message): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['password_success'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['password_success']; ?></div>
                    <?php unset($_SESSION['password_success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['password_error'])): ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['password_error']; ?></div>
                    <?php unset($_SESSION['password_error']); ?>
                <?php endif; ?>

                <div class="profile-settings">
                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($student['full_name']); ?>&size=200" alt="Profile">
                                <button class="change-avatar-btn">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                            <div class="profile-info">
                                <h3><?php echo htmlspecialchars($student['full_name']); ?></h3>
                                <p>Student ID: <?php echo htmlspecialchars($student['id']); ?></p>
                            </div>
                        </div>

                        <div class="account-info">
                            <h4>Account Information</h4>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" value="<?php echo htmlspecialchars($_SESSION['full_name']); ?>" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <form class="profile-form" method="POST" action="">
                            <div class="form-section">
                                <h4>Personal Information</h4>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label required-field">Phone Number</label>
                                        <input type="tel" name="phone_number" class="form-control" 
                                            value="<?php echo htmlspecialchars($student['phone_number'] ?? ''); ?>"
                                            <?php echo !empty($student['phone_number']) ? 'readonly' : 'required'; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label required-field">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" 
                                            value="<?php echo (!empty($student['dob']) && $student['dob'] != '0000-00-00') ? htmlspecialchars($student['dob']) : ''; ?>"
                                            <?php echo (!empty($student['dob']) && $student['dob'] != '0000-00-00') ? 'readonly' : 'required'; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label required-field">Gender</label>
                                        <select name="gender" class="form-control" 
                                            <?php echo (!empty($student['gender']) && $student['gender'] != '') ? 'disabled' : 'required'; ?>>
                                            <option value="">Select Gender</option>
                                            <option value="male" <?php echo ($student['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                            <option value="female" <?php echo ($student['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                            <option value="other" <?php echo ($student['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label required-field">Class</label>
                                        <select name="class" class="form-control" 
                                            <?php echo !empty($student['class']) ? 'readonly disabled' : 'required'; ?>>
                                            <option value="">Select Class</option>
                                            <option value="nursery" <?php echo ($student['class'] ?? '') == 'nursery' ? 'selected' : ''; ?>>Nursery</option>
                                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                                <option value="<?php echo $i; ?>" <?php echo ($student['class'] ?? '') == $i ? 'selected' : ''; ?>>
                                                    Class <?php echo $i; ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label required-field">City</label>
                                        <input type="text" name="city" class="form-control" 
                                            value="<?php echo htmlspecialchars($student['city'] ?? ''); ?>"
                                            <?php echo !empty($student['city']) ? 'readonly' : 'required'; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label required-field">State</label>
                                        <input type="text" name="state" class="form-control" 
                                            value="<?php echo htmlspecialchars($student['state'] ?? ''); ?>"
                                            <?php echo !empty($student['state']) ? 'readonly' : 'required'; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pin Code</label>
                                        <input type="text" name="pincode" class="form-control" 
                                            value="<?php echo htmlspecialchars($student['pincode'] ?? ''); ?>"
                                            <?php echo !empty($student['pincode']) ? 'readonly' : ''; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Colony/Area</label>
                                        <input type="text" name="colony" class="form-control" 
                                            value="<?php echo htmlspecialchars($student['colony'] ?? ''); ?>"
                                            <?php echo !empty($student['colony']) ? 'readonly' : ''; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label required-field">Parent's Name</label>
                                        <input type="text" name="parent_name" class="form-control" 
                                            value="<?php echo htmlspecialchars($student['parent_name'] ?? ''); ?>"
                                            <?php echo !empty($student['parent_name']) ? 'readonly' : 'required'; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label required-field">Parent's Phone</label>
                                        <input type="tel" name="parent_phone" class="form-control" 
                                            value="<?php echo htmlspecialchars($student['parent_phone'] ?? ''); ?>"
                                            <?php echo !empty($student['parent_phone']) ? 'readonly' : 'required'; ?>>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-save">Save Changes</button>
                            </div>
                        </form>

                        <div class="password-section">
                            <h4>Change Password</h4>
                            <form class="password-form" method="POST" action="change-password.php">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" name="current_password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="new_password" class="form-control" required minlength="6">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" name="confirm_password" class="form-control" required minlength="6">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn-change-password">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./components/header.js"></script>
    <script src="./js/dashboard.js"></script>
</body>
</html>