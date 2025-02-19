<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
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
</head>
<body>
    <div class="glow-overlay"></div>
    <div class="scanlines"></div>

    <div class="dashboard-container">
        <dashboard-sidebar></dashboard-sidebar>

        <main class="main-content">
            <dashboard-header></dashboard-header>

            <div class="dashboard-content">
                <div class="section-header">
                    <h2>Profile Settings</h2>
                </div>

                <div class="profile-settings">
                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['full_name']); ?>&size=200" alt="Profile">
                                <button class="change-avatar-btn">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                            <div class="profile-info">
                                <h3><?php echo htmlspecialchars($user['full_name']); ?></h3>
                                <p>Student ID: <?php echo htmlspecialchars($user['id']); ?></p>
                            </div>
                        </div>

                        <form class="profile-form" id="profileForm">
                            <div class="form-section">
                                <h4>Personal Information</h4>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" value="<?php echo htmlspecialchars($user['full_name']); ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="tel" name="phone" value="<?php echo isset($user['phone']) ? htmlspecialchars($user['phone']) : ''; ?>" class="form-control" placeholder="Add your phone number" <?php echo isset($user['phone']) ? 'readonly' : ''; ?>>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h4>Change Password</h4>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="new_password" class="form-control" minlength="8">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-save">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./components/sidebar.js"></script>
    <script src="./components/header.js"></script>
    <script src="../js/dashboard.js"></script>
</body>
</html>