<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])) {
    header('Location: userdash.php');
    exit();
}

require_once '../config/db_connect.php';

$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

$students_query = "SELECT * FROM students ORDER BY created_at DESC LIMIT $start, $per_page";
$students_result = $conn->query($students_query);

$total_query = "SELECT COUNT(*) as count FROM students";
$total_result = $conn->query($total_query);
$total_students = $total_result->fetch_assoc()['count'];
$total_pages = ceil($total_students / $per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management</title>
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
                        <h1>Students Management</h1>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                            <i class="fas fa-plus"></i> Add New Student
                        </button>
                    </div>
                </div>

                <!-- Search and Filter Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" id="searchStudent" class="form-control" placeholder="Search students...">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="filterClass">
                                    <option value="">All Classes</option>
                                    <option value="nursery">Nursery</option>
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?php echo $i; ?>">Class <?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Students List -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Parent Name</th>
                                        <th>Added By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($student = $students_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($student['class']); ?></td>
                                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                                        <td><?php echo htmlspecialchars($student['phone_number']); ?></td>
                                        <td><?php echo htmlspecialchars($student['parent_name']); ?></td>
                                        <td>
                                            <?php 
                                                $added_by_query = "SELECT full_name, user_role FROM users WHERE id = " . $student['added_by'];
                                            $added_by_result = $conn->query($added_by_query);
                                            $added_by_user = $added_by_result->fetch_assoc();
                                                echo htmlspecialchars($added_by_user['full_name']) . ' (' . ucfirst($added_by_user['user_role']) . ')';
                                            ?>
                                        </td>
                                        <td>
                                            <div class="student-actions">
                                                <button class="btn btn-info btn-sm view-student" 
                                                        data-id="<?php echo $student['id']; ?>"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#viewStudentModal">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button> -->
                                            </div>
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
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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

    <!-- View Student Modal -->
    <div class="modal fade" id="viewStudentModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img src="../images/avatar.png" alt="Student" class="student-avatar">
                    </div>

                    <!-- Personal Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Personal Information</h6>
                        </div>
                        <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                                    <div class="student-info mb-3">
                                <h6>Full Name</h6>
                                <p id="studentName"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                                    <div class="student-info mb-3">
                                        <h6>Phone Number</h6>
                                        <p id="studentPhone"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="student-info mb-3">
                                        <h6>Email</h6>
                                        <p id="studentEmail"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="student-info mb-3">
                                        <h6>Date of Birth</h6>
                                        <p id="studentDOB"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="student-info mb-3">
                                        <h6>Gender</h6>
                                        <p id="studentGender"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="student-info mb-3">
                                <h6>Class</h6>
                                <p id="studentClass"></p>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Address Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="student-info mb-3">
                                        <h6>City</h6>
                                        <p id="studentCity"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="student-info mb-3">
                                        <h6>State</h6>
                                        <p id="studentState"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="student-info mb-3">
                                        <h6>Pin Code</h6>
                                        <p id="studentPincode"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="student-info mb-3">
                                        <h6>Colony/Area</h6>
                                        <p id="studentColony"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Parent Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Parent Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="student-info mb-3">
                                        <h6>Parent's Name</h6>
                                        <p id="parentName"></p>
                                    </div>
                                </div>
                        <div class="col-md-6">
                                    <div class="student-info mb-3">
                                        <h6>Parent's Phone Number</h6>
                                        <p id="parentPhone"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrolled Courses -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Enrolled Courses</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Course Name</th>
                                            <th>Enrollment Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="enrolledCourses">
                                        <!-- Courses will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Payment History -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Payment History</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Transaction ID</th>
                                        </tr>
                                    </thead>
                                    <tbody id="paymentHistory">
                                        <!-- Payments will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Added By Information -->
                    <div class="card">
                        <div class="card-body">
                            <small class="text-muted">
                                Added By: <span id="studentAddedBy"></span>
                                <br>
                                Added On: <span id="studentAddedDate"></span>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="downloadStudentDetails()">
                        <i class="fas fa-download me-2"></i>Download Details
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/students.js"></script>
</body>

</html> 