<?php
// Get user data from session
$user_id = $_SESSION['user_id'];
$sql = "SELECT profile_photo FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

// Set profile photo path
$profile_photo = isset($user_data['profile_photo']) && !empty($user_data['profile_photo']) 
    ? "../uploads/profile_photos/" . $user_data['profile_photo'] 
    : "../images/avatar.png";
?>

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
                <img src="<?php echo htmlspecialchars($profile_photo); ?>" alt="User" class="profile-image">
                <div class="profile-info">
                    <div class="user-info">
                        <span class="user-name"><?php echo htmlspecialchars($_SESSION['full_name']); ?></span>
                        <span class="user-email"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
                    </div>
                    <span class="profile-role"><?php echo htmlspecialchars(ucfirst($_SESSION['user_role'])); ?></span>
                </div>
                <i class="fas fa-chevron-down"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-header">
                    <img src="<?php echo htmlspecialchars($profile_photo); ?>" alt="User" class="dropdown-profile-image">
                    <div class="dropdown-profile-info">
                        <span class="dropdown-user-name"><?php echo htmlspecialchars($_SESSION['full_name']); ?></span>
                        <span class="dropdown-user-email"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="my-profile.php">
                        <i class="fas fa-user-circle"></i>
                        My Profile
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

<style>
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background: white;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
}

.user-profile-menu {
    position: relative;
}

.profile-toggle {
    display: flex;
    align-items: center;
    gap: 12px;
    background: rgba(78, 115, 223, 0.05);
    border: none;
    padding: 8px 16px;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.profile-toggle:hover {
    background: rgba(78, 115, 223, 0.1);
}

.profile-image {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid var(--primary-color);
}

.profile-info {
    text-align: left;
    margin: 0 10px;
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 600;
    color: var(--dark-color);
    font-size: 14px;
}

.user-email {
    font-size: 12px;
    color: var(--secondary-color);
}

.profile-role {
    font-size: 11px;
    color: var(--primary-color);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.dropdown-menu {
    padding: 0;
    border: none;
    border-radius: 12px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
    min-width: 280px;
    margin-top: 15px !important;
}

.dropdown-header {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.dropdown-profile-image {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid var(--primary-color);
}

.dropdown-profile-info {
    display: flex;
    flex-direction: column;
}

.dropdown-user-name {
    font-weight: 600;
    color: var(--dark-color);
    font-size: 16px;
}

.dropdown-user-email {
    font-size: 13px;
    color: var(--secondary-color);
}

.dropdown-divider {
    margin: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    color: var(--dark-color);
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background: rgba(78, 115, 223, 0.05);
    color: var(--primary-color);
}

.dropdown-item.text-danger:hover {
    background: rgba(231, 74, 59, 0.05);
}

.dropdown-item i {
    font-size: 16px;
    width: 20px;
    text-align: center;
    opacity: 0.8;
}

@media (max-width: 768px) {
    .profile-info {
        display: none;
    }
    
    .profile-toggle {
        padding: 8px;
    }
    
    .dropdown-menu {
        position: fixed;
        top: auto !important;
        bottom: 0;
        left: 0 !important;
        right: 0 !important;
        width: 100%;
        margin: 0 !important;
        border-radius: 20px 20px 0 0;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }
    
    .dropdown-menu.show {
        transform: translateY(0);
    }
}
</style> 