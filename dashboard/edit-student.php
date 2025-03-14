<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])) {
    header('Location: userdash.php');
    exit();
}

require_once '../config/db_connect.php';

// Get student ID from URL
$student_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$student_id) {
    header('Location: students.php');
    exit();
}

// Fetch student data
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    header('Location: students.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $class = trim($_POST['class']);
    $dob = trim($_POST['dob']);
    $gender = trim($_POST['gender']);
    $parent_name = trim($_POST['parent_name']);
    $parent_phone = trim($_POST['parent_phone']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $pincode = trim($_POST['pincode']);
    $colony = trim($_POST['colony']);

    // Basic validation
    $errors = array();
    
    if(empty($full_name)) {
        $errors[] = "Full name is required";
    }
    if(empty($email)) {
        $errors[] = "Email is required";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if(!preg_match("/^\d{10}$/", $phone_number)) {
        $errors[] = "Phone number must be 10 digits";
    }
    if(!preg_match("/^\d{10}$/", $parent_phone)) {
        $errors[] = "Parent phone number must be 10 digits";
    }
    if(!preg_match("/^\d{6}$/", $pincode)) {
        $errors[] = "Pincode must be 6 digits";
    }

    if(empty($errors)) {
        try {
            // Update student data
            $update_sql = "UPDATE students SET 
                full_name = ?,
                email = ?,
                phone_number = ?,
                class = ?,
                dob = ?,
                gender = ?,
                parent_name = ?,
                parent_phone = ?,
                city = ?,
                state = ?,
                pincode = ?,
                colony = ?,
                updated_at = CURRENT_TIMESTAMP
                WHERE id = ?";

            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssssssssssssi", 
                $full_name, $email, $phone_number, $class, $dob, $gender,
                $parent_name, $parent_phone, $city, $state, $pincode, $colony,
                $student_id
            );

            if ($update_stmt->execute()) {
                $_SESSION['success_msg'] = "Student updated successfully";
                header("Location: students.php");
                exit();
            } else {
                $error = "Error updating student information: " . $conn->error;
            }
        } catch (Exception $e) {
            $error = "Error updating student: " . $e->getMessage();
        }
    } else {
        $error = implode("<br>", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - <?php echo htmlspecialchars($student['full_name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/components.css">
    <style>
        .edit-student-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 25px;
        }

        .section-title {
            color: var(--primary-color);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(78, 115, 223, 0.1);
        }

        .form-label {
            font-weight: 500;
            color: var(--dark-color);
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .btn-update {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            text-decoration: none;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--info-color);
            transform: translateX(-5px);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <?php include 'components/sidebar.php'; ?>
        
        <div class="main-content">
            <?php include 'components/header.php'; ?>
            
            <div class="content-wrapper">
                <div class="container-fluid">
                    <a href="students.php" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Back to Students List
                    </a>

                    <div class="edit-student-container">
                        <h1 class="mb-4">Edit Student Information</h1>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="" id="editStudentForm">
                            <!-- Personal Information -->
                            <div class="form-section">
                                <h2 class="section-title">Personal Information</h2>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="full_name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" 
                                               value="<?php echo htmlspecialchars($student['full_name']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?php echo htmlspecialchars($student['email']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone_number" name="phone_number" 
                                               value="<?php echo htmlspecialchars($student['phone_number']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="class" class="form-label">Class</label>
                                        <select class="form-select" id="class" name="class" required>
                                            <option value="nursery" <?php echo $student['class'] === 'nursery' ? 'selected' : ''; ?>>Nursery</option>
                                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                                <option value="<?php echo $i; ?>" <?php echo $student['class'] == $i ? 'selected' : ''; ?>>
                                                    Class <?php echo $i; ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" 
                                               value="<?php echo htmlspecialchars($student['dob']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select" id="gender" name="gender" required>
                                            <option value="male" <?php echo $student['gender'] === 'male' ? 'selected' : ''; ?>>Male</option>
                                            <option value="female" <?php echo $student['gender'] === 'female' ? 'selected' : ''; ?>>Female</option>
                                            <option value="other" <?php echo $student['gender'] === 'other' ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Parent Information -->
                            <div class="form-section">
                                <h2 class="section-title">Parent Information</h2>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="parent_name" class="form-label">Parent's Name</label>
                                        <input type="text" class="form-control" id="parent_name" name="parent_name" 
                                               value="<?php echo htmlspecialchars($student['parent_name']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="parent_phone" class="form-label">Parent's Phone Number</label>
                                        <input type="tel" class="form-control" id="parent_phone" name="parent_phone" 
                                               value="<?php echo htmlspecialchars($student['parent_phone']); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Address Information -->
                            <div class="form-section">
                                <h2 class="section-title">Address Information</h2>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" 
                                               value="<?php echo htmlspecialchars($student['city']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" class="form-control" id="state" name="state" 
                                               value="<?php echo htmlspecialchars($student['state']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pincode" class="form-label">Pin Code</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" 
                                               value="<?php echo htmlspecialchars($student['pincode']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="colony" class="form-label">Colony/Area</label>
                                        <input type="text" class="form-control" id="colony" name="colony" 
                                               value="<?php echo htmlspecialchars($student['colony']); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions text-end mt-4">
                                <a href="students.php" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-update">
                                    <i class="fas fa-save me-2"></i>Update Student
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
    <script>
        // Form validation
        document.getElementById('editStudentForm').addEventListener('submit', function(e) {
            const phoneRegex = /^\d{10}$/;
            const pincodeRegex = /^\d{6}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            const phone = document.getElementById('phone_number').value;
            const parentPhone = document.getElementById('parent_phone').value;
            const pincode = document.getElementById('pincode').value;
            const email = document.getElementById('email').value;

            let errors = [];

            if (!emailRegex.test(email)) {
                errors.push('Please enter a valid email address');
            }

            if (!phoneRegex.test(phone)) {
                errors.push('Student phone number must be 10 digits');
            }

            if (!phoneRegex.test(parentPhone)) {
                errors.push('Parent phone number must be 10 digits');
            }

            if (!pincodeRegex.test(pincode)) {
                errors.push('Pin code must be 6 digits');
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join('\n'));
            }
        });
    </script>
</body>

</html> 