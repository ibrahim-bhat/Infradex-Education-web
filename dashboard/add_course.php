<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = floatval($_POST['price']);
    $duration = $conn->real_escape_string($_POST['duration']);
    $level = $conn->real_escape_string($_POST['level']);
    $category = $conn->real_escape_string($_POST['category']);
    $features = isset($_POST['features']) ? json_encode($_POST['features']) : '[]';
    $status = $conn->real_escape_string($_POST['status']);
    $added_by = $_SESSION['user_id'];

    $query = "INSERT INTO courses (title, description, price, duration, level, category, features, status, added_by) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdsssssi", $title, $description, $price, $duration, $level, $category, $features, $status, $added_by);

    if ($stmt->execute()) {
        $success_message = "Course added successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
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
                    <h1>Add New Course</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="courses.php">Courses</a></li>
                            <li class="breadcrumb-item active">Add Course</li>
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

                <div class="card course-form-card">
                    <div class="card-body">
                        <form method="POST" action="" id="courseForm">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-4">
                                        <label class="form-label">Course Title</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="4" required></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Price (₹)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₹</span>
                                                    <input type="number" name="price" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Duration</label>
                                                <input type="text" name="duration" class="form-control" placeholder="e.g., 3 months" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Level</label>
                                                <select name="level" class="form-select" required>
                                                    <option value="">Select Level</option>
                                                    <option value="beginner">Beginner</option>
                                                    <option value="intermediate">Intermediate</option>
                                                    <option value="advanced">Advanced</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label class="form-label">Category</label>
                                                <select name="category" class="form-select" required>
                                                    <option value="">Select Category</option>
                                                    <option value="programming">Programming</option>
                                                    <option value="design">Design</option>
                                                    <option value="business">Business</option>
                                                    <option value="marketing">Marketing</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="course-features-section">
                                        <h5>Course Features</h5>
                                        <div class="features-list" id="featuresList">
                                            <div class="feature-item">
                                                <input type="text" name="features[]" class="form-control" placeholder="Add feature">
                                                <button type="button" class="btn btn-link text-danger remove-feature">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-light btn-sm w-100" id="addFeature">
                                            <i class="fas fa-plus me-2"></i>Add Feature
                                        </button>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select" required>
                                            <option value="active">Active</option>
                                            <option value="draft">Draft</option>
                                            <option value="archived">Archived</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn btn-light" onclick="history.back()">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Save Course
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
            // Add new feature field
            $('#addFeature').click(function() {
                const featureItem = `
                <div class="feature-item">
                    <input type="text" name="features[]" class="form-control" placeholder="Add feature">
                    <button type="button" class="btn btn-link text-danger remove-feature">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
                $('#featuresList').append(featureItem);
            });

            // Remove feature field
            $(document).on('click', '.remove-feature', function() {
                $(this).closest('.feature-item').remove();
            });

            // Form validation
            $('#courseForm').on('submit', function(e) {
                const price = $('input[name="price"]').val();
                if (price <= 0) {
                    e.preventDefault();
                    alert('Price must be greater than 0');
                    return false;
                }
            });
        });
    </script>
</body>

</html>