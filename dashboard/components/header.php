<header class="dashboard-header">
    <div class="header-left">
        <a href="../index.php" class="back-to-web">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Website</span>
        </a>
    </div>
    
    <div class="header-right">
        <div class="header-actions">

        
        <div class="user-profile-menu dropdown">
            <button class="profile-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../images/avatar.png" alt="User" class="profile-image">
                <div class="profile-info">
                    <div class="user-info">
                        <span class="user-name"><?php echo $_SESSION['full_name']; ?></span>
                        <span class="user-email"><?php echo $_SESSION['email']; ?></span>
                    </div>
                    <span class="profile-role"><?php echo ucfirst($_SESSION['user_role']); ?></span>
                </div>
                <i class="fas fa-chevron-down"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="profile.php">
                        <i class="fas fa-user-circle"></i>
                        My Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="settings.php">
                        <i class="fas fa-cog"></i>
                        Settings
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="../logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header> 