<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

// Pagination
$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

// Base query
$query = "SELECT ca.*, s.full_name as student_name, s.email as student_email, 
          s.phone_number as student_phone, c.title as course_name, 
          c.price as course_price, u.full_name as assigned_by_name,
          u.user_role as assigned_by_role
          FROM course_assignments ca
          LEFT JOIN students s ON ca.student_id = s.id
          LEFT JOIN courses c ON ca.course_id = c.id
          LEFT JOIN users u ON ca.assigned_by = u.id";

// Filters
$where_conditions = [];
$params = [];
$param_types = "";

if (isset($_GET['search']) && $_GET['search'] != '') {
    $where_conditions[] = "(s.full_name LIKE ? OR s.email LIKE ? OR c.title LIKE ?)";
    $search_term = "%" . $_GET['search'] . "%";
    $params[] = $search_term;
    $params[] = $search_term;
    $params[] = $search_term;
    $param_types .= "sss";
}

if (isset($_GET['course_id']) && $_GET['course_id'] != '') {
    $where_conditions[] = "ca.course_id = ?";
    $params[] = $_GET['course_id'];
    $param_types .= "i";
}

if (isset($_GET['assigned_by']) && $_GET['assigned_by'] != '') {
    $where_conditions[] = "ca.assigned_by = ?";
    $params[] = $_GET['assigned_by'];
    $param_types .= "i";
}

if (!empty($where_conditions)) {
    $query .= " WHERE " . implode(" AND ", $where_conditions);
}

// Add ordering
$query .= " ORDER BY ca.assigned_at DESC LIMIT ?, ?";
$params[] = $start;
$params[] = $per_page;
$param_types .= "ii";

// Prepare and execute query
$stmt = $conn->prepare($query);
if (!empty($params) && !empty($param_types)) {
    $stmt->bind_param($param_types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Get total records for pagination
$total_query = "SELECT COUNT(*) as count FROM course_assignments ca";
if (!empty($where_conditions)) {
    $total_query .= " WHERE " . implode(" AND ", $where_conditions);
}
$total_stmt = $conn->prepare($total_query);
if (!empty($params) && !empty($param_types) && count($params) > 2) {
    array_pop($params);
    array_pop($params);
    $total_stmt->bind_param(substr($param_types, 0, -2), ...$params);
}
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_records = $total_result->fetch_assoc()['count'];
$total_pages = ceil($total_records / $per_page);

// Get courses for filter
$courses_query = "SELECT id, title FROM courses WHERE status = 'active'";
$courses_result = $conn->query($courses_query);

// Get users for filter
$users_query = "SELECT id, full_name FROM users";
$users_result = $conn->query($users_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Assignments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/components.css">
</head>

<body>
    <div class="admin-container">
        <?php include 'components/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'components/header.php'; ?>

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1>Course Assignments</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Course Assignments</li>
                                </ol>
                            </nav>
                        </div>
                        <a href="assign_course.php" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Assign New Course
                        </a>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search student, course..."
                                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            </div>
                            <div class="col-md-3">
                                <select name="course_id" class="form-select">
                                    <option value="">All Courses</option>
                                    <?php while ($course = $courses_result->fetch_assoc()): ?>
                                        <option value="<?php echo $course['id']; ?>"
                                            <?php echo isset($_GET['course_id']) && $_GET['course_id'] == $course['id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($course['title']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="assigned_by" class="form-select">
                                    <option value="">All Users</option>
                                    <?php while ($user = $users_result->fetch_assoc()): ?>
                                        <option value="<?php echo $user['id']; ?>"
                                            <?php echo isset($_GET['assigned_by']) && $_GET['assigned_by'] == $user['id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($user['full_name']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                                <a href="course_assignments.php" class="btn btn-light">
                                    <i class="fas fa-redo me-2"></i>Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Assignments List -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Student Details</th>
                                        <th>Course</th>
                                        <th>Amount</th>
                                        <th>Payment Info</th>
                                        <th>Assigned By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo date('d M Y, h:i A', strtotime($row['assigned_at'])); ?></td>
                                            <td>
                                                <div class="student-info">
                                                    <div class="student-name"><?php echo htmlspecialchars($row['student_name']); ?></div>
                                                    <div class="student-contact">
                                                        <small><i class="fas fa-envelope me-1"></i><?php echo htmlspecialchars($row['student_email']); ?></small>
                                                        <small><i class="fas fa-phone me-1"></i><?php echo htmlspecialchars($row['student_phone']); ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="course-title"><?php echo htmlspecialchars($row['course_name']); ?></span>
                                            </td>
                                            <td>
                                                <div class="amount-info">
                                                    <span class="amount">₹<?php echo number_format($row['amount'], 2); ?></span>
                                                    <?php if ($row['amount'] != $row['course_price']): ?>
                                                        <small class="text-muted">(Original: ₹<?php echo number_format($row['course_price'], 2); ?>)</small>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="payment-info">
                                                    <span class="badge <?php echo $row['payment_method'] == 'cash' ? 'bg-success' : 'bg-primary'; ?>">
                                                        <?php echo ucfirst($row['payment_method']); ?>
                                                    </span>
                                                    <?php if ($row['payment_method'] == 'online'): ?>
                                                        <small class="transaction-id"><?php echo htmlspecialchars($row['transaction_id']); ?></small>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="assigned-by">
                                                    <span class="user-name"><?php echo htmlspecialchars($row['assigned_by_name']); ?></span>
                                                    <small class="user-role"><?php echo ucfirst($row['assigned_by_role']); ?></small>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info view-details" data-id="<?php echo $row['id']; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary print-receipt" data-id="<?php echo $row['id']; ?>">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <?php if ($total_pages > 1): ?>
                            <nav aria-label="Page navigation" class="mt-4">
                                <ul class="pagination justify-content-center">
                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?><?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assignment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detailsContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/assignments.js"></script>
</body>

</html>