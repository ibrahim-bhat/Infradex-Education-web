<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    header('Location: userdash.php');
    exit();
}

require_once '../config/db_connect.php';

// Fetch all courses with pagination
$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

$courses_query = "SELECT c.*, u.full_name as added_by_name 
                 FROM courses c 
                 LEFT JOIN users u ON c.added_by = u.id 
                 ORDER BY c.created_at DESC LIMIT $start, $per_page";
$courses_result = $conn->query($courses_query);

// Get total courses count for pagination
$total_query = "SELECT COUNT(*) as count FROM courses";
$total_result = $conn->query($total_query);
$total_courses = $total_result->fetch_assoc()['count'];
$total_pages = ceil($total_courses / $per_page);
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
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1>Courses</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Courses</li>
                                </ol>
                            </nav>
                        </div>
                        <a href="add_course.php" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Course
                        </a>
                    </div>
                </div>

                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" id="searchCourse" class="form-control" placeholder="Search courses...">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="filterCategory">
                                    <option value="">All Categories</option>
                                    <option value="programming">Programming</option>
                                    <option value="design">Design</option>
                                    <option value="business">Business</option>
                                    <option value="marketing">Marketing</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="filterLevel">
                                    <option value="">All Levels</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" id="filterStatus">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="draft">Draft</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses List -->
                <div class="courses-grid">
                    <?php while ($course = $courses_result->fetch_assoc()): ?>
                        <div class="course-card">
                            <div class="course-status <?php echo $course['status']; ?>">
                                <?php echo ucfirst($course['status']); ?>
                            </div>
                            <div class="course-header">
                                <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                                <span class="course-category"><?php echo ucfirst($course['category']); ?></span>
                            </div>
                            <div class="course-body">
                                <p class="course-description"><?php echo substr(htmlspecialchars($course['description']), 0, 100) . '...'; ?></p>
                                <div class="course-meta">
                                    <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($course['duration']); ?></span>
                                    <span><i class="fas fa-signal"></i> <?php echo ucfirst($course['level']); ?></span>
                                    <span><i class="fas fa-rupee-sign"></i> <?php echo number_format($course['price'], 2); ?></span>
                                </div>
                                <div class="course-features">
                                    <?php
                                    $features = json_decode($course['features'], true);
                                    if ($features) {
                                        foreach (array_slice($features, 0, 3) as $feature) {
                                            echo "<span class='feature-tag'><i class='fas fa-check'></i> " . htmlspecialchars($feature) . "</span>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="course-footer">
                                <small>Added by: <?php echo htmlspecialchars($course['added_by_name']); ?></small>
                                <div class="course-actions">
                                    <button class="btn btn-sm btn-info view-course" data-id="<?php echo $course['id']; ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary edit-course" data-id="<?php echo $course['id']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-course" data-id="<?php echo $course['id']; ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
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

    <!-- View Course Modal -->
    <div class="modal fade" id="viewCourseModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Course Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Course details will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
    <script>
        $(document).ready(function() {
            // View course details
            $('.view-course').click(function() {
                const courseId = $(this).data('id');
                $.ajax({
                    url: 'ajax/get_course.php',
                    type: 'POST',
                    data: {
                        id: courseId
                    },
                    success: function(response) {
                        $('#viewCourseModal .modal-body').html(response);
                        $('#viewCourseModal').modal('show');
                    }
                });
            });

            // Edit course
            $('.edit-course').click(function() {
                const courseId = $(this).data('id');
                window.location.href = 'edit_course.php?id=' + courseId;
            });

            // Delete course
            $('.delete-course').click(function() {
                if (confirm('Are you sure you want to delete this course?')) {
                    const courseId = $(this).data('id');
                    $.ajax({
                        url: 'ajax/delete_course.php',
                        type: 'POST',
                        data: {
                            id: courseId
                        },
                        success: function(response) {
                            const result = JSON.parse(response);
                            if (result.success) {
                                location.reload();
                            } else {
                                alert(result.message);
                            }
                        }
                    });
                }
            });

            // Search functionality
            $('#searchCourse').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('.course-card').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Filters
            $('#filterCategory, #filterLevel, #filterStatus').change(function() {
                const category = $('#filterCategory').val();
                const level = $('#filterLevel').val();
                const status = $('#filterStatus').val();

                $('.course-card').each(function() {
                    const $card = $(this);
                    const showCategory = !category || $card.find('.course-category').text().toLowerCase() === category;
                    const showLevel = !level || $card.find('.course-meta').text().toLowerCase().includes(level);
                    const showStatus = !status || $card.find('.course-status').text().toLowerCase() === status;

                    $card.toggle(showCategory && showLevel && showStatus);
                });
            });
        });
    </script>
</body>

</html>