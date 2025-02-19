<?php
$current_page = basename($_SERVER['PHP_SELF'], '.php');
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
            </ul>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['full_name']); ?>" alt="Profile" class="user-avatar">
                <div class="user-details">
                    <h6><?php echo htmlspecialchars($user['full_name']); ?></h6>
                    <span>User</span>
                </div>
            </div>
        </div>
    </div>
</aside>