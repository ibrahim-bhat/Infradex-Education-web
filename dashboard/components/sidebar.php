<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar">
    <div class="sidebar-header">
        <img src="../images/eee.png" alt="Logo" class="sidebar-logo">
        <button class="mobile-close" id="sidebar-close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <h6 class="nav-section-title">MAIN MENU</h6>
            <ul>
                <li class="<?php echo $current_page == 'userdash.php' ? 'active' : ''; ?>">
                    <a href="userdash.php">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <?php if (in_array($_SESSION['user_role'], ['super_admin', 'admin'])): ?>
                    <li class="<?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>">
                        <a href="dashboard.php">
                            <i class="fas fa-chart-line"></i>
                            <span>Analytics</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <?php if (!in_array($_SESSION['user_role'], ['user'])): ?>
            <div class="nav-section">
                <h6 class="nav-section-title">STUDENTS</h6>
                <ul>
                    <?php if (!in_array($_SESSION['user_role'], ['ground_team'])): ?>
                        <li class="<?php echo $current_page == 'students.php' ? 'active' : ''; ?>">
                            <a href="students.php">
                                <i class="fas fa-user-graduate"></i>
                                <span>Students List</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="<?php echo $current_page == 'add_student.php' ? 'active' : ''; ?>">
                        <a href="add_student.php">
                            <i class="fas fa-user-plus"></i>
                            <span>Add Student</span>
                        </a>
                    </li>
                    <li class="<?php echo $current_page == 'student-documents.php' ? 'active' : ''; ?>">
                        <a href="student-documents.php">
                            <i class="fas fa-file-alt"></i>
                            <span>Student Documents</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- <div class="nav-section">
                <h6 class="nav-section-title">COURSES</h6>
                <ul>
                    <?php if (in_array($_SESSION['user_role'], ['super_admin', 'admin'])): ?>
                        <li class="<?php echo $current_page == 'courses.php' ? 'active' : ''; ?>">
                            <a href="courses.php">
                                <i class="fas fa-book"></i>
                                <span>Courses List</span>
                            </a>
                        </li>
                        <li class="<?php echo $current_page == 'add_course.php' ? 'active' : ''; ?>">
                            <a href="add_course.php">
                                <i class="fas fa-plus-circle"></i>
                                <span>Add Course</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="<?php echo $current_page == 'assign_course.php' ? 'active' : ''; ?>">
                        <a href="assign_course.php">
                            <i class="fas fa-user-check"></i>
                            <span>Assign Course</span>
                            <span class="nav-badge">New</span>
                        </a>
                    </li>
                    <?php if (!in_array($_SESSION['user_role'], ['ground_team'])): ?>
                        <li class="<?php echo $current_page == 'course_assignments.php' ? 'active' : ''; ?>">
                            <a href="course_assignments.php">
                                <i class="fas fa-tasks"></i>
                                <span>Assignment List</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div> -->
        <?php endif; ?>

        <?php if (in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])): ?>
            <div class="nav-section">
                <h6 class="nav-section-title">ADMINISTRATION</h6>
                <ul>
                    <li class="<?php echo $current_page == 'users.php' ? 'active' : ''; ?>">
                        <a href="users.php">
                            <i class="fas fa-users"></i>
                            <span>Users List</span>
                        </a>
                    </li>
                    <li class="<?php echo $current_page == 'add_user.php' ? 'active' : ''; ?>">
                        <a href="add_user.php">
                            <i class="fas fa-user-plus"></i>
                            <span>Add User</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- <div class="nav-section">
                <h6 class="nav-section-title">PAYMENT HISTORY</h6>
                <ul>
                    <li class="<?php echo $current_page == 'payment_history.php' ? 'active' : ''; ?>">
                        <a href="payment_history.php">
                            <i class="fas fa-history"></i>
                            <span>Payment History</span>
                        </a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>

        <div class="nav-section">
            <h6 class="nav-section-title">CONTENT MANAGEMENT</h6>
            <ul>
                <li class="<?php echo in_array($current_page, ['blog-posts.php', 'add-blog-post.php', 'blog-categories.php']) ? 'active' : ''; ?>">
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseBlog" aria-expanded="false">
                        <i class="fas fa-blog"></i>
                        <span>Blog Management</span>
                        <i class="fas fa-angle-down"></i>
                    </a>
                    <div id="collapseBlog" class="collapse">
                        <ul class="sub-menu">
                            <li class="<?php echo $current_page == 'blog-posts.php' ? 'active' : ''; ?>">
                                <a href="blog-posts.php">
                                    <i class="fas fa-list-alt"></i>
                                    <span>All Posts</span>
                                </a>
                            </li>
                            <li class="<?php echo $current_page == 'add-blog-post.php' ? 'active' : ''; ?>">
                                <a href="add-blog-post.php">
                                    <i class="fas fa-plus-circle"></i>
                                    <span>Add New Post</span>
                                </a>
                            </li>
                            <li class="<?php echo $current_page == 'blog-categories.php' ? 'active' : ''; ?>">
                                <a href="blog-categories.php">
                                    <i class="fas fa-tags"></i>
                                    <span>Categories</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div> -->
    </nav>
</div>