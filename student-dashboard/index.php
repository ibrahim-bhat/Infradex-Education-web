<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

// Check if student profile is complete
$check_profile_query = "SELECT phone_number, dob, gender, class, city, state, pincode, colony, parent_name, parent_phone 
                       FROM students 
                       WHERE email = ?";
$check_stmt = $conn->prepare($check_profile_query);
$check_stmt->bind_param("s", $_SESSION['email']);
$check_stmt->execute();
$result = $check_stmt->get_result();
$student = $result->fetch_assoc();

// Check if any required fields are empty
$profile_incomplete = empty($student['phone_number']) ||
    empty($student['dob']) ||
    empty($student['gender']) ||
    empty($student['class']) ||
    empty($student['city']) ||
    empty($student['parent_name']) ||
    empty($student['parent_phone']);
if ($profile_incomplete) {
    $_SESSION['profile_message'] = '<div class="alert alert-danger">Please complete your profile in profile settings</div>';
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT full_name FROM users WHERE id = ?";
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
    <title>Student Dashboard | Infradex Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="./css/dashboard.css" rel="stylesheet">
</head>

<body>
    <div class="glow-overlay"></div>
    <div class="scanlines"></div>

    <div class="dashboard-container">
        <?php include 'components/sidebar.php'; ?>

        <main class="main-content">
            <dashboard-header></dashboard-header>

            <div class="dashboard-content">
                <div class="welcome-section">
                    <div class="welcome-card">
                        <div class="welcome-info">
                            <div class="greeting-header">
                                <div class="user-welcome">
                                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['full_name']); ?>&background=8000ff&color=fff" alt="Profile" class="welcome-avatar">
                                    <div>
                                        <h1>Welcome back, <?php echo htmlspecialchars($user['full_name']); ?>!</h1>
                                        <p class="last-login">Last login: Today at 9:30 AM</p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="stats-overview">
                                <div class="stat-item">
                                    <span class="stat-label">Courses</span>
                                    <span class="stat-value">4</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Progress</span>
                                    <span class="stat-value">75%</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Hours</span>
                                    <span class="stat-value">24h</span>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>

                <!-- <?php include '../components/coming-soon copy.php'; ?> -->

                <div class="courses-section">
                    <div class="section-header">
                        <h2>Available Scholarships</h2>
                        <p class="text-muted">Exclusive scholarship opportunities for our students</p>
                    </div>
                    <div class="course-grid">
                        <div class="course-card scholarship-card">
                            <div class="scholarship-banner">
                                <div class="scholarship-tag">Featured</div>
                            </div>
                            <div class="course-header">
                                <div class="course-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <span class="course-status">Limited Time Offer</span>
                            </div>
                            <h3>MBBS Scholarship Program</h3>
                            <div class="scholarship-details">
                                <div class="detail-item">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span>₹5,000 Monthly Stipend</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Duration: 5 Years</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Location: Bangladesh</span>
                                </div>
                            </div>
                            <!-- <div class="scholarship-benefits">
                                <h4>Benefits Include:</h4>
                                <ul>
                                    <li><i class="fas fa-check-circle"></i> Monthly Stipend</li>
                                    <li><i class="fas fa-check-circle"></i> Accommodation Support</li>
                                    <li><i class="fas fa-check-circle"></i> Study Materials</li>
                                </ul>
                            </div> -->
                            <!-- <div class="application-deadline">
                                <i class="fas fa-clock"></i>
                                <span>Application Deadline: July 30, 2025</span>
                            </div> -->
                            <button class="continue-btn apply-btn" onclick="window.location.href='tel:9796931231'">
                                <i class="fas fa-phone"></i>
                                Call Now: 979-693-1231
                            </button>
                        </div>

                        <div class="course-card scholarship-card">
                            <div class="course-header">
                                <div class="course-icon">
                                    <i class="fas fa-user-nurse"></i>
                                </div>
                                <span class="course-status">New</span>
                            </div>
                            <h3>MBBS Scholarship Program</h3>
                            <div class="scholarship-details">
                                <div class="detail-item">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span>With a Gift</span>
                                </div>
                                <!-- <div class="detail-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Duration: 5 Years</span>
                                </div> -->
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Location: Iran</span>
                                </div>
                            </div>
                            <!-- <div class="scholarship-benefits">
                                <h4>Benefits Include:</h4>
                                <ul>
                                    <li><i class="fas fa-check-circle"></i> Monthly Stipend</li>
                                    <li><i class="fas fa-check-circle"></i> Clinical Training</li>
                                    <li><i class="fas fa-check-circle"></i> Job Placement</li>
                                </ul>
                            </div> -->
                            <!-- <div class="application-deadline">
                                <i class="fas fa-clock"></i>
                                <span>Application Deadline: August 15, 2024</span>
                            </div> -->
                            <button class="continue-btn apply-btn" onclick="window.location.href='tel:9796931231'">
                                <i class="fas fa-phone"></i>
                                Call Now: 979-693-1231
                            </button>
                        </div>
                    </div>
                </div>


                <!-- <div class="courses-section">
                    <div class="section-header">
                        <h2>Active Courses</h2>
                    </div>
                    <div class="course-grid">
                        <div class="course-card">
                            <div class="course-header">
                                <div class="course-icon">
                                    <i class="fas fa-code"></i>
                                </div>
                                <span class="course-status">In Progress</span>
                            </div>
                            <h3>Web Development</h3>
                            <div class="progress-info">
                                <div class="progress">
                                    <div class="progress-bar" style="width: 75%"></div>
                                </div>
                                <div class="progress-text">
                                    <span>15/20 Lessons</span>
                                    <span>75%</span>
                                </div>
                            </div>
                            <button class="continue-btn">Continue</button>
                        </div>
                    </div>
                </div>  -->

                <!-- <div class="upcoming-section">
                    <div class="section-header">
                        <div class="header-left">
                            <h2>Upcoming Sessions</h2>
                            <span class="subtitle">Next 24 hours</span>
                        </div>
                    </div>
                    <div class="session-timeline">
                        <div class="timeline-card">
                            <div class="time-badge">10:30 AM</div>
                            <div class="session-content">
                                <div class="session-info">
                                    <h4>Career Counselling</h4>
                                    <p class="session-desc">One-on-one career guidance session</p>
                                    <div class="session-meta">
                                        <span><i class="fas fa-user-tie"></i> Prof. Sarah Wilson</span>
                                        <span><i class="fas fa-clock"></i> 1h 30m</span>
                                        <span><i class="fas fa-video"></i> Online</span>
                                    </div>
                                </div>
                                <button class="join-btn">Join Session</button>
                            </div>
                        </div>

                    </div>
                </div>  -->
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./components/sidebar.js"></script>
    <script src="./components/header.js"></script>
    <script src="./js/dashboard.js"></script>
</body>

</html>