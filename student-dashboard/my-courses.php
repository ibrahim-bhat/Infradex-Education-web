<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

// Fetch user details first
$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Fetch enrolled courses for the current student
$query = "SELECT 
    c.id,
    c.title,
    c.description,
    ca.assigned_at,
    ca.payment_method,
    ca.amount as paid_amount,
    ca.transaction_id
    FROM course_assignments ca
    JOIN courses c ON ca.course_id = c.id
    WHERE ca.student_id = ? 
    ORDER BY ca.assigned_at DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

// Debug
if ($result->num_rows === 0) {
    error_log("No courses found for user ID: " . $_SESSION['user_id']);
}

// Get course progress
function getCourseProgress($course_id, $student_id, $conn) {
    $query = "SELECT 
        COUNT(CASE WHEN completed = 1 THEN 1 END) as completed_lessons,
        COUNT(*) as total_lessons
        FROM lesson_progress 
        WHERE course_id = ? AND student_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $course_id, $student_id);
    $stmt->execute();
    $progress = $stmt->get_result()->fetch_assoc();
    
    if ($progress && $progress['total_lessons'] > 0) {
        return round(($progress['completed_lessons'] / $progress['total_lessons']) * 100);
    }
    return 0;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Courses - Student Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link href="./css/dashboard.css" rel="stylesheet" />
    <style>
        .course-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(128, 0, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(128, 0, 255, 0.1);
        }

        .course-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .course-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.8));
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .progress-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            position: absolute;
            top: 20px;
            right: 20px;
            border: 2px solid #8a2be2;
        }

        .course-content {
            padding: 20px;
        }

        .course-title {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .course-info {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .course-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .status-active {
            background: rgba(46, 204, 113, 0.2);
            color: #2ecc71;
        }

        .status-completed {
            background: rgba(52, 152, 219, 0.2);
            color: #3498db;
        }

        .no-courses {
            text-align: center;
            padding: 50px;
            color: rgba(255, 255, 255, 0.7);
        }

        .no-courses i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #8a2be2;
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
              <h2>My Courses</h2>
              <!-- <div class="course-filters">
                          <button class="filter-btn active">All Courses</button>
                          <button class="filter-btn">In Progress</button>
                          <button class="filter-btn">Completed</button>
                      </div> -->
            </div>

            <div class="content-wrapper">
     

              <?php if ($result->num_rows > 0): ?>
                <div class="row g-4">
                  <?php while($course = $result->fetch_assoc()): 
                    $progress = getCourseProgress($course['id'], $_SESSION['user_id'], $conn);
                  ?>
                    <div class="col-md-6 col-lg-4">
                      <div class="course-card">
                        <div class="course-image" style="background-image: url('../assets/images/course-default.jpg')">
                          <div class="course-overlay">
                            <div class="progress-circle">
                              <?php echo $progress; ?>%
                            </div>
                          </div>
                        </div>
                        <div class="course-content">
                          <h3 class="course-title"><?php echo htmlspecialchars($course['title']); ?></h3>
                          <div class="course-info">
                            <p><i class="fas fa-calendar-alt me-2"></i>Enrolled: <?php echo date('M d, Y', strtotime($course['assigned_at'])); ?></p>
                            <p><i class="fas fa-rupee-sign me-2"></i>Paid: ₹<?php echo number_format($course['paid_amount'], 2); ?></p>
                          </div>
                          <div class="course-meta">
                            <span class="course-status <?php echo $progress == 100 ? 'status-completed' : 'status-active'; ?>">
                              <?php echo $progress == 100 ? 'Completed' : 'In Progress'; ?>
                            </span>
                            <a href="course-details.php?id=<?php echo $course['id']; ?>" class="btn btn-sm btn-primary">
                              <i class="fas fa-play me-2"></i>Continue Learning
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endwhile; ?>
                </div>
              <?php else: ?>
                <div class="no-courses">
                  <i class="fas fa-graduation-cap"></i>
                  <h3>No Courses Found</h3>
                  <p>You haven't enrolled in any courses yet.</p>
                  <a href="available-courses.php" class="btn btn-primary mt-3">
                    <i class="fas fa-search me-2"></i>Browse Courses
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./components/header.js"></script>
    <script src="../js/dashboard.js"></script>
  </body>
</html>
