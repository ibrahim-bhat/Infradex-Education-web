<?php
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// If $user is not passed, fetch it here
if (!isset($user) && isset($_SESSION['user_id'])) {
    $user_query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
}
?>

<aside class="sidebar">
    <div class="sidebar-content">
        <div class="sidebar-header">
            <img src="../images/eee.png" alt="Logo" class="logo">
            <button class="close-sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <nav class="sidebar-nav">
            <ul>
                <li class="<?php echo $current_page === 'index' ? 'active' : ''; ?>">
                    <a href="index.php">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>
                </li>
                <!-- <li class="<?php echo $current_page === 'scholarship' ? 'active' : ''; ?>">
                    <a href="scholarship.php">
                        <i class="fas fa-graduation-cap"></i> Scholarships
                    </a>
                </li> -->
                <li class="<?php echo $current_page === 'my-courses' ? 'active' : ''; ?>">
                    <a href="my-courses.php">
                        <i class="fas fa-book"></i> My Courses
                    </a>
                </li>
                <li class="<?php echo $current_page === 'payment-history' ? 'active' : ''; ?>">
                    <a href="payment-history.php">
                        <i class="fas fa-history"></i> Payment History
                    </a>
                </li>
                <li class="<?php echo $current_page === 'document-uploads' ? 'active' : ''; ?>">
                    <a href="document-uploads.php">
                        <i class="fas fa-file-upload"></i> Document Uploads
                    </a>
                </li>
                <li class="<?php echo $current_page === 'profile-settings' ? 'active' : ''; ?>">
                    <a href="profile-settings.php">
                        <i class="fas fa-user-cog"></i> Profile Settings
                    </a>
                </li>
                <li>
                    <a href="../">
                        <i class="fas fa-arrow-left"></i> Back to Web
                    </a>
                </li>
                <li class="logout-item">
                    <a href="logout.php" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=<?php echo isset($user) ? urlencode($user['full_name']) : 'User'; ?>" alt="Profile" class="user-avatar">
                <div class="user-details">
                    <h6><?php echo isset($user) ? htmlspecialchars($user['full_name']) : 'User'; ?></h6>
                    <span>Student</span>
                </div>
            </div>
        </div>
    </div>
</aside>

<style>
.logout-item {
    margin-top: auto;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.logout-link {
    color: #dc3545 !important;
    transition: all 0.3s ease;
}

.logout-link:hover {
    background: rgba(220, 53, 69, 0.1) !important;
    color: #dc3545 !important;
}

.logout-link i {
    color: #dc3545 !important;
}

.sidebar-nav ul {
    display: flex;
    flex-direction: column;
    height: 100%;
}
</style>