<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] === 'user') {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

// Fetch all students with pagination
$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

$students_query = "SELECT * FROM students ORDER BY created_at DESC LIMIT $start, $per_page";
$students_result = $conn->query($students_query);

// Get total students count for pagination
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
    <title>Students - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .student-actions {
            display: flex;
            gap: 10px;
        }
        .student-actions button {
            padding: 5px 10px;
            font-size: 14px;
        }
        .modal-body .student-info {
            margin-bottom: 20px;
        }
        .student-info h6 {
            color: #666;
            margin-bottom: 5px;
        }
        .student-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
    </style>
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
                                    <?php for($i=1; $i<=12; $i++): ?>
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
                                    <?php while($student = $students_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($student['class']); ?></td>
                                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                                        <td><?php echo htmlspecialchars($student['phone_number']); ?></td>
                                        <td><?php echo htmlspecialchars($student['parent_name']); ?></td>
                                        <td>
                                            <?php 
                                            $added_by_query = "SELECT username, user_role FROM users WHERE id = " . $student['added_by'];
                                            $added_by_result = $conn->query($added_by_query);
                                            $added_by_user = $added_by_result->fetch_assoc();
                                            echo htmlspecialchars($added_by_user['username']) . ' (' . ucfirst($added_by_user['user_role']) . ')';
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
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
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
                    <div class="text-center">
                        <img src="../images/avatar.png" alt="Student" class="student-avatar">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="student-info">
                                <h6>Full Name</h6>
                                <p id="studentName"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="student-info">
                                <h6>Class</h6>
                                <p id="studentClass"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="student-info">
                                <h6>Added By</h6>
                                <p id="studentAddedBy"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
    <script>
    $(document).ready(function() {
        // View Student Details
        $('.view-student').click(function() {
            const studentId = $(this).data('id');
            
            // AJAX call to fetch student details
            $.ajax({
                url: 'ajax/get_student.php',
                type: 'POST',
                data: { id: studentId },
                success: function(response) {
                    const student = JSON.parse(response);
                    $('#studentName').text(student.full_name);
                    $('#studentClass').text(student.class);
                    $('#studentAddedBy').text(student.added_by_username + ' (' + student.added_by_user_role + ')');
                }
            });
        });

        // Search functionality
        $('#searchStudent').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Class filter
        $('#filterClass').change(function() {
            const value = $(this).val();
            if(value) {
                $('table tbody tr').hide();
                $('table tbody tr').filter(function() {
                    return $(this).children('td:eq(1)').text() === value;
                }).show();
            } else {
                $('table tbody tr').show();
            }
        });
    });
    </script>
</body>
</html> 