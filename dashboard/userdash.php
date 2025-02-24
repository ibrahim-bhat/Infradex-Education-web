<?php
session_start();
if (!isset($_SESSION['user_role'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

$user_id = $_SESSION['user_id'];

// Get user details
$user_query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Get user statistics
$stats_query = "SELECT 
    (SELECT COUNT(*) FROM students WHERE added_by = ?) as students_added,
    (SELECT COUNT(*) FROM course_assignments WHERE assigned_by = ?) as courses_assigned,
    (SELECT COUNT(DISTINCT student_id) FROM course_assignments WHERE assigned_by = ?) as active_students,
    (SELECT SUM(amount) FROM course_assignments WHERE assigned_by = ?) as total_revenue,
    (SELECT COUNT(*) FROM course_assignments WHERE assigned_by = ? AND DATE(assigned_at) = CURDATE()) as today_assignments,
    (SELECT SUM(amount) FROM course_assignments WHERE assigned_by = ? AND DATE(assigned_at) = CURDATE()) as today_revenue";

$stmt = $conn->prepare($stats_query);
$stmt->bind_param("iiiiii", $user_id, $user_id, $user_id, $user_id, $user_id, $user_id);
$stmt->execute();
$stats = $stmt->get_result()->fetch_assoc();

// Get recent activities
$activities_query = "SELECT 
    ca.assigned_at,
    s.full_name as student_name,
    c.title as course_name,
    ca.amount,
    ca.payment_method
    FROM course_assignments ca
    JOIN students s ON ca.student_id = s.id
    JOIN courses c ON ca.course_id = c.id
    WHERE ca.assigned_by = ?
    ORDER BY ca.assigned_at DESC
    LIMIT 5";

$stmt = $conn->prepare($activities_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$activities_result = $stmt->get_result();

// Get monthly statistics
$monthly_stats_query = "SELECT 
    DATE_FORMAT(assigned_at, '%Y-%m') as month,
    COUNT(*) as assignments,
    SUM(amount) as revenue
    FROM course_assignments 
    WHERE assigned_by = ? 
    AND assigned_at >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
    GROUP BY month 
    ORDER BY month DESC";

$stmt = $conn->prepare($monthly_stats_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$monthly_stats = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="css/charts.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'components/sidebar.php'; ?>
        <div class="main-content">
            <?php include 'components/header.php'; ?>
            <div class="content-wrapper">
                <!-- Welcome Section -->
                <div class="welcome-section mb-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="welcome-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h1 class="welcome-title">Welcome back, <?php echo htmlspecialchars($user['full_name']); ?>!</h1>
                            <p class="welcome-subtitle">
                                <i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($user['email']); ?>
                                <span class="mx-2">|</span>
                                <i class="fas fa-user-tag me-2"></i><?php echo ucfirst($user['user_role']); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(52,152,219,0.1); color: #3498db;">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo number_format($stats['students_added']); ?></h3>
                            <p>Students Added</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(46,204,113,0.1); color: #2ecc71;">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo number_format($stats['active_students']); ?></h3>
                            <p>Active Students</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(155,89,182,0.1); color: #9b59b6;">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo number_format($stats['courses_assigned']); ?></h3>
                            <p>Courses Assigned</p>
                        </div>
                    </div>
                    <?php if (in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])): ?>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(230,126,34,0.1); color: #e67e22;">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <div class="stat-info">
                            <h3>₹<?php echo number_format($stats['total_revenue']); ?></h3>
                            <p>Total Revenue</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="row mt-4">
                    <!-- Today's Summary -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Today's Summary</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-0">Assignments</h6>
                                        <h3 class="mb-0"><?php echo number_format($stats['today_assignments']); ?></h3>
                                    </div>
                                    <?php if (in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])): ?>
                                    <div>
                                        <h6 class="mb-0">Revenue</h6>
                                        <h3 class="mb-0">₹<?php echo number_format($stats['today_revenue']); ?></h3>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Performance -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Monthly Performance</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Month</th>
                                                <th>Assignments</th>
                                                <?php if (in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])): ?>
                                                <th>Revenue</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($month = $monthly_stats->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo date('M Y', strtotime($month['month'])); ?></td>
                                                <td><?php echo number_format($month['assignments']); ?></td>
                                                <?php if (in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])): ?>
                                                <td>₹<?php echo number_format($month['revenue']); ?></td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent Activities</h5>
                    </div>
                    <div class="card-body">
                        <div class="activities-timeline">
                            <?php while ($activity = $activities_result->fetch_assoc()): ?>
                                <div class="activity-item">
                                    <div class="activity-icon <?php echo $activity['payment_method'] == 'cash' ? 'bg-success' : 'bg-primary'; ?>">
                                        <i class="fas <?php echo $activity['payment_method'] == 'cash' ? 'fa-money-bill' : 'fa-credit-card'; ?>"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-header">
                                            <h6><?php echo htmlspecialchars($activity['student_name']); ?></h6>
                                            <small><?php echo date('d M Y, h:i A', strtotime($activity['assigned_at'])); ?></small>
                                        </div>
                                        <p>Enrolled in <?php echo htmlspecialchars($activity['course_name']); ?></p>
                                        <div class="activity-meta">
                                            <span class="badge <?php echo $activity['payment_method'] == 'cash' ? 'bg-success' : 'bg-primary'; ?>">
                                                <?php echo ucfirst($activity['payment_method']); ?>
                                            </span>
                                            <span class="amount">₹<?php echo number_format($activity['amount'], 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
</body>
</html>