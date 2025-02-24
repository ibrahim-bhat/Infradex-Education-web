<?php
session_start();
if (!isset($_SESSION['user_role']) || in_array($_SESSION['user_role'], ['user'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = (int)$_POST['student_id'];
    $course_id = (int)$_POST['course_id'];
    $payment_method = $conn->real_escape_string($_POST['payment_method']);
    $amount = floatval($_POST['amount']);
    $transaction_id = $payment_method === 'online' ? $conn->real_escape_string($_POST['transaction_id']) : null;
    $assigned_by = $_SESSION['user_id'];

    $query = "INSERT INTO course_assignments (student_id, course_id, payment_method, transaction_id, amount, assigned_by) 
              VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iissdi", $student_id, $course_id, $payment_method, $transaction_id, $amount, $assigned_by);

    if ($stmt->execute()) {
        $success_message = "Course assigned successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Get current user's details
$user_query = "SELECT full_name, user_role FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user_result = $stmt->get_result();
$current_user = $user_result->fetch_assoc();

// Update any user selection queries
$students_query = "SELECT id, email, full_name FROM users WHERE user_role = 'student'";
$teachers_query = "SELECT id, email, full_name FROM users WHERE user_role = 'teacher'";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                    <h1>Assign Course</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="courses.php">Courses</a></li>
                            <li class="breadcrumb-item active">Assign Course</li>
                        </ol>
                    </nav>
                </div>

                <?php if (isset($success_message)): ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i><?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="" id="assignForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label">Search Student</label>
                                        <div class="position-relative">
                                            <input type="text" id="studentSearch" class="form-control" placeholder="Search by name, email or phone...">
                                            <div id="studentResults" class="search-results" style="display: none;"></div>
                                        </div>
                                        <input type="hidden" name="student_id" id="selectedStudentId" required>
                                        <div id="selectedStudent" class="selected-item" style="display: none;"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label">Search Course</label>
                                        <div class="position-relative">
                                            <input type="text" id="courseSearch" class="form-control" placeholder="Search by course name...">
                                            <div id="courseResults" class="search-results" style="display: none;"></div>
                                        </div>
                                        <input type="hidden" name="course_id" id="selectedCourseId" required>
                                        <div id="selectedCourse" class="selected-item" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="payment-info">
                                <h5 class="mb-4">Payment Information</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Amount (₹)</label>
                                            <input type="number" name="amount" id="amount" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method</label>
                                            <select name="payment_method" id="paymentMethod" class="form-select" required>
                                                <option value="">Select Method</option>
                                                <option value="cash">Cash</option>
                                                <option value="online">Online</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3" id="transactionIdField" style="display: none;">
                                            <label class="form-label">Transaction ID</label>
                                            <input type="text" name="transaction_id" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Assigned By</label>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($current_user['full_name'] . ' (' . ucfirst($current_user['user_role']) . ')'); ?>" readonly>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn btn-light" onclick="history.back()">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check me-2"></i>Assign Course
                                </button>
                            </div>
                        </form>
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
            // Student search
            $('#studentSearch').on('keyup', function() {
                const search = $(this).val();
                if (search.length >= 2) {
                    $.ajax({
                        url: 'ajax/search_students.php',
                        type: 'POST',
                        data: {
                            search: search
                        },
                        success: function(response) {
                            $('#studentResults').html(response).show();
                        }
                    });
                } else {
                    $('#studentResults').hide();
                }
            });

            // Course search
            $('#courseSearch').on('keyup', function() {
                const search = $(this).val();
                if (search.length >= 2) {
                    $.ajax({
                        url: 'ajax/search_courses.php',
                        type: 'POST',
                        data: {
                            search: search
                        },
                        success: function(response) {
                            $('#courseResults').html(response).show();
                        }
                    });
                } else {
                    $('#courseResults').hide();
                }
            });

            // Select student
            $(document).on('click', '.student-result', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const details = $(this).data('details');

                $('#selectedStudentId').val(id);
                $('#selectedStudent').html(`
                <strong>${name}</strong><br>
                <small>${details}</small>
            `).show();
                $('#studentResults').hide();
                $('#studentSearch').val('');
            });

            // Select course
            $(document).on('click', '.course-result', function() {
                const id = $(this).data('id');
                const title = $(this).data('title');
                const price = $(this).data('price');

                $('#selectedCourseId').val(id);
                $('#amount').val(price);
                $('#selectedCourse').html(`
                <strong>${title}</strong><br>
                <small>Price: ₹${price}</small>
            `).show();
                $('#courseResults').hide();
                $('#courseSearch').val('');
            });

            // Payment method change
            $('#paymentMethod').change(function() {
                if ($(this).val() === 'online') {
                    $('#transactionIdField').show();
                    $('input[name="transaction_id"]').prop('required', true);
                } else {
                    $('#transactionIdField').hide();
                    $('input[name="transaction_id"]').prop('required', false);
                }
            });

            // Form validation
            $('#assignForm').on('submit', function(e) {
                if (!$('#selectedStudentId').val() || !$('#selectedCourseId').val()) {
                    e.preventDefault();
                    alert('Please select both student and course');
                    return false;
                }
            });
        });
    </script>
</body>

</html>