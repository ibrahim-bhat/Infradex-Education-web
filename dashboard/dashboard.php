<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    header('Location: userdash.php');
    exit();
}

require_once '../config/db_connect.php';

$counts_query = "SELECT 
    (SELECT COUNT(*) FROM students) as total_students,
    (SELECT COUNT(*) FROM users) as total_users,
    (SELECT COUNT(*) FROM courses) as total_courses,
    (SELECT COUNT(*) FROM course_assignments) as total_assignments,
    (SELECT SUM(amount) FROM course_assignments) as total_revenue";
$counts_result = $conn->query($counts_query);
$counts = $counts_result->fetch_assoc();

$today_query = "SELECT 
    COUNT(*) as assignments_today,
    SUM(amount) as revenue_today,
    COUNT(CASE WHEN payment_method = 'cash' THEN 1 END) as cash_payments,
    COUNT(CASE WHEN payment_method = 'online' THEN 1 END) as online_payments
    FROM course_assignments 
    WHERE DATE(assigned_at) = CURDATE()";
$today_result = $conn->query($today_query);
$today_stats = $today_result->fetch_assoc();

$monthly_revenue_query = "SELECT 
    DATE_FORMAT(assigned_at, '%Y-%m') as month,
    SUM(amount) as revenue,
    COUNT(*) as assignments
    FROM course_assignments
    WHERE assigned_at >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
    GROUP BY month
    ORDER BY month";
$monthly_revenue_result = $conn->query($monthly_revenue_query);
$revenue_data = [];
$assignment_data = [];
while ($row = $monthly_revenue_result->fetch_assoc()) {
    $revenue_data[] = $row['revenue'];
    $assignment_data[] = $row['assignments'];
}

$popular_courses_query = "SELECT 
    c.title, 
    COUNT(ca.id) as enrollment_count,
    SUM(ca.amount) as total_revenue
    FROM courses c
    LEFT JOIN course_assignments ca ON c.id = ca.course_id
    GROUP BY c.id
    ORDER BY enrollment_count DESC
    LIMIT 5";
$popular_courses_result = $conn->query($popular_courses_query);

$recent_activities_query = "SELECT 
    ca.assigned_at,
    s.full_name as student_name,
    c.title as course_name,
    ca.amount,
    ca.payment_method,
    u.full_name as assigned_by
    FROM course_assignments ca
    JOIN students s ON ca.student_id = s.id
    JOIN courses c ON ca.course_id = c.id
    JOIN users u ON ca.assigned_by = u.id
    ORDER BY ca.assigned_at DESC
    LIMIT 10";
$recent_activities_result = $conn->query($recent_activities_query);

$payment_stats_query = "SELECT 
    payment_method,
    COUNT(*) as count,
    SUM(amount) as total
    FROM course_assignments
    GROUP BY payment_method";
$payment_stats_result = $conn->query($payment_stats_query);
$payment_stats = [];
while ($row = $payment_stats_result->fetch_assoc()) {
    $payment_stats[$row['payment_method']] = $row;
}

$users_query = "SELECT id, email, full_name, user_role FROM users";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                <div class="content-header">
                    <h1>Dashboard Overview</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </nav>
                </div>

                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(52,152,219,0.1); color: #3498db;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo number_format($counts['total_students']); ?></h3>
                            <p>Total Students</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(46,204,113,0.1); color: #2ecc71;">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo number_format($counts['total_courses']); ?></h3>
                            <p>Total Courses</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(155,89,182,0.1); color: #9b59b6;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo number_format($counts['total_users']); ?></h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(230,126,34,0.1); color: #e67e22;">
                            <i class="fas fa-rupee-sign"></i>
                        </div>
                        <div class="stat-info">
                            <h3>₹<?php echo number_format($counts['total_revenue']); ?></h3>
                            <p>Total Revenue</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="chart-container">
                            <div class="chart-header">
                                <h5 class="chart-title">Revenue Overview</h5>
                                <div class="chart-filters">
                                    <button class="chart-filter active">Week</button>
                                    <button class="chart-filter">Month</button>
                                    <button class="chart-filter">Year</button>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="chart-container">
                            <div class="chart-header">
                                <h5 class="chart-title">Course Distribution</h5>
                            </div>
                            <div class="chart-wrapper">
                                <canvas id="courseDistribution"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Popular Courses</h5>
                                <div class="popular-courses">
                                    <?php while ($course = $popular_courses_result->fetch_assoc()): ?>
                                        <div class="course-item">
                                            <div class="course-info">
                                                <h6><?php echo htmlspecialchars($course['title']); ?></h6>
                                                <small><?php echo $course['enrollment_count']; ?> students enrolled</small>
                                            </div>
                                            <div class="course-revenue">
                                                ₹<?php echo number_format($course['total_revenue']); ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Activities</h5>
                                <div class="activities-timeline">
                                    <?php while ($activity = $recent_activities_result->fetch_assoc()): ?>
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
                                                    <span class="assigned-by">by <?php echo htmlspecialchars($activity['assigned_by']); ?></span>
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
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/dashboard.js"></script>
</body>

</html>