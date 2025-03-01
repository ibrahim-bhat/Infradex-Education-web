<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT full_name FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Constants for file uploads
define('MAX_FILE_SIZE', 92160); // 90KB in bytes
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png']);

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if uploads directory exists, create it if not
    $upload_base_dir = '../uploads';
    if (!file_exists($upload_base_dir)) {
        mkdir($upload_base_dir, 0755, true);
    }

    // Create date-based subdirectory (YYYY/MM)
    $date_subdir = date('Y/m');
    $upload_dir = $upload_base_dir . '/' . $date_subdir . '/' . $user_id;

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Process uploaded file
    if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
        $document_type = $_POST['document_type'];
        $file_tmp = $_FILES['document']['tmp_name'];
        $file_size = $_FILES['document']['size'];
        $file_name = $_FILES['document']['name'];

        // Get file extension
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Generate a unique filename
        $new_file_name = $document_type . '_' . time() . '.' . $file_ext;
        $file_destination = $upload_dir . '/' . $new_file_name;

        // Validate file size
        if ($file_size > MAX_FILE_SIZE) {
            $error_message = "File is too large! Maximum size is 90KB.";
        }
        // Validate file extension
        else if (!in_array($file_ext, ALLOWED_EXTENSIONS)) {
            $error_message = "Only JPG and PNG files are allowed!";
        }
        // Move and save the file
        else if (move_uploaded_file($file_tmp, $file_destination)) {
            // Save file information to database
            $upload_date = date('Y-m-d H:i:s');
            $file_path = $date_subdir . '/' . $user_id . '/' . $new_file_name;

            $insert_query = "INSERT INTO student_documents (user_id, document_type, file_path, upload_date) 
                             VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("isss", $user_id, $document_type, $file_path, $upload_date);

            if ($insert_stmt->execute()) {
                $success_message = "Document uploaded successfully!";
            } else {
                $error_message = "Database error: " . $conn->error;
            }
        } else {
            $error_message = "Failed to upload file!";
        }
    } else if (isset($_FILES['document'])) {
        $error_message = "Error uploading file. Error code: " . $_FILES['document']['error'];
    }
}

// Fetch existing documents
$documents_query = "SELECT document_type, file_path, upload_date FROM student_documents WHERE user_id = ?";
$documents_stmt = $conn->prepare($documents_query);
$documents_stmt->bind_param("i", $user_id);
$documents_stmt->execute();
$documents_result = $documents_stmt->get_result();
$documents = [];
while ($row = $documents_result->fetch_assoc()) {
    $documents[$row['document_type']] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Uploads | Student Dashboard | Infradex Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="./css/dashboard.css" rel="stylesheet">
    <style>
        .document-section {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .document-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .document-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .document-input-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            cursor: pointer;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-btn {
            background: linear-gradient(90deg, #8000ff, #6600cc);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .upload-btn:hover {
            background: linear-gradient(90deg, #9933ff, #7700e6);
        }

        .upload-status {
            margin-top: 5px;
            font-size: 0.85rem;
        }

        .uploaded-file {
            background: rgba(0, 255, 0, 0.1);
            border-radius: 4px;
            padding: 8px;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .upload-instructions {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 15px;
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
                <div class="content-header">
                    <h1>Document Uploads</h1>
                    <p>Upload your educational certificates and identification documents</p>
                </div>

                <?php if (!empty($success_message)): ?>
                    <div class="alert alert-success"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <div class="upload-instructions">
                    <ul>
                        <li>Only JPG and PNG formats are accepted</li>
                        <li>Maximum file size: 90KB per document</li>
                        <li>Make sure documents are clearly visible and all information is readable</li>
                        <li>Once uploaded, documents cannot be deleted (contact admin for changes)</li>
                    </ul>
                </div>

                <!-- Class 10 Documents Section -->
                <div class="document-section">
                    <h3 class="section-title">Class 10 Documents</h3>

                    <div class="document-card">
                        <div class="document-title">Class 10 Marks Sheet Certificate</div>
                        <?php if (isset($documents['10th_marksheet'])): ?>
                            <div class="uploaded-file">
                                <div class="file-info">
                                    <i class="fas fa-file-image"></i>
                                    <span>Uploaded on <?php echo date('d M Y', strtotime($documents['10th_marksheet']['upload_date'])); ?></span>
                                </div>
                                <!-- <span class="badge bg-success">Uploaded</span> -->
                            </div>
                        <?php else: ?>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="document_type" value="10th_marksheet">
                                <div class="document-input-group">
                                    <div class="file-input-wrapper">
                                        <button class="upload-btn"><i class="fas fa-upload"></i> Choose File</button>
                                        <input type="file" name="document" accept=".jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="upload-status" id="status-10th-marksheet">No file chosen</div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Upload Document</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>

                    <div class="document-card">
                        <div class="document-title">Class 10 DOB Certificate</div>
                        <?php if (isset($documents['10th_dob'])): ?>
                            <div class="uploaded-file">
                                <div class="file-info">
                                    <i class="fas fa-file-image"></i>
                                    <span>Uploaded on <?php echo date('d M Y', strtotime($documents['10th_dob']['upload_date'])); ?></span>
                                </div>
                                <!-- <span class="badge bg-success">Uploaded</span> -->
                            </div>
                        <?php else: ?>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="document_type" value="10th_dob">
                                <div class="document-input-group">
                                    <div class="file-input-wrapper">
                                        <button class="upload-btn"><i class="fas fa-upload"></i> Choose File</button>
                                        <input type="file" name="document" accept=".jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="upload-status" id="status-10th-dob">No file chosen</div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Upload Document</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Class 12 Documents Section -->
                <div class="document-section">
                    <h3 class="section-title">Class 12 Documents</h3>

                    <div class="document-card">
                        <div class="document-title">Class 12 Marks Sheet Certificate</div>
                        <?php if (isset($documents['12th_marksheet'])): ?>
                            <div class="uploaded-file">
                                <div class="file-info">
                                    <i class="fas fa-file-image"></i>
                                    <span>Uploaded on <?php echo date('d M Y', strtotime($documents['12th_marksheet']['upload_date'])); ?></span>
                                </div>
                                <!-- <span class="badge bg-success">Uploaded</span> -->
                            </div>
                        <?php else: ?>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="document_type" value="12th_marksheet">
                                <div class="document-input-group">
                                    <div class="file-input-wrapper">
                                        <button class="upload-btn"><i class="fas fa-upload"></i> Choose File</button>
                                        <input type="file" name="document" accept=".jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="upload-status" id="status-12th-marksheet">No file chosen</div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Upload Document</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>

                    <div class="document-card">
                        <div class="document-title">Class 12 DOB Certificate</div>
                        <?php if (isset($documents['12th_dob'])): ?>
                            <div class="uploaded-file">
                                <div class="file-info">
                                    <i class="fas fa-file-image"></i>
                                    <span>Uploaded on <?php echo date('d M Y', strtotime($documents['12th_dob']['upload_date'])); ?></span>
                                </div>
                                <!-- <span class="badge bg-success">Uploaded</span> -->
                            </div>
                        <?php else: ?>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="document_type" value="12th_dob">
                                <div class="document-input-group">
                                    <div class="file-input-wrapper">
                                        <button class="upload-btn"><i class="fas fa-upload"></i> Choose File</button>
                                        <input type="file" name="document" accept=".jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="upload-status" id="status-12th-dob">No file chosen</div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Upload Document</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Aadhar Card Section -->
                <div class="document-section">
                    <h3 class="section-title">Identification Documents</h3>

                    <div class="document-card">
                        <div class="document-title">Aadhaar Card (Front)</div>
                        <?php if (isset($documents['aadhaar_front'])): ?>
                            <div class="uploaded-file">
                                <div class="file-info">
                                    <i class="fas fa-file-image"></i>
                                    <span>Uploaded on <?php echo date('d M Y', strtotime($documents['aadhaar_front']['upload_date'])); ?></span>
                                </div>
                                <!-- <span class="badge bg-success">Uploaded</span> -->
                            </div>
                        <?php else: ?>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="document_type" value="aadhaar_front">
                                <div class="document-input-group">
                                    <div class="file-input-wrapper">
                                        <button class="upload-btn"><i class="fas fa-upload"></i> Choose File</button>
                                        <input type="file" name="document" accept=".jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="upload-status" id="status-aadhaar-front">No file chosen</div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Upload Document</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>

                    <div class="document-card">
                        <div class="document-title">Aadhaar Card (Back)</div>
                        <?php if (isset($documents['aadhaar_back'])): ?>
                            <div class="uploaded-file">
                                <div class="file-info">
                                    <i class="fas fa-file-image"></i>
                                    <span>Uploaded on <?php echo date('d M Y', strtotime($documents['aadhaar_back']['upload_date'])); ?></span>
                                </div>
                                <!-- <span class="badge bg-success">Uploaded</span> -->
                            </div>
                        <?php else: ?>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="document_type" value="aadhaar_back">
                                <div class="document-input-group">
                                    <div class="file-input-wrapper">
                                        <button class="upload-btn"><i class="fas fa-upload"></i> Choose File</button>
                                        <input type="file" name="document" accept=".jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="upload-status" id="status-aadhaar-back">No file chosen</div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Upload Document</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                    
                    <div class="document-card">
                        <div class="document-title">Passport (Front)</div>
                        <?php if (isset($documents['passport_front'])): ?>
                            <div class="uploaded-file">
                                <div class="file-info">
                                    <i class="fas fa-file-image"></i>
                                    <span>Uploaded on <?php echo date('d M Y', strtotime($documents['passport_front']['upload_date'])); ?></span>
                                </div>
                                <!-- <span class="badge bg-success">Uploaded</span> -->
                            </div>
                        <?php else: ?>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="document_type" value="passport_front">
                                <div class="document-input-group">
                                    <div class="file-input-wrapper">
                                        <button class="upload-btn"><i class="fas fa-upload"></i> Choose File</button>
                                        <input type="file" name="document" accept=".jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="upload-status" id="status-passport-front">No file chosen</div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Upload Document</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                    
                    <div class="document-card">
                        <div class="document-title">Passport (Back)</div>
                        <?php if (isset($documents['passport_back'])): ?>
                            <div class="uploaded-file">
                                <div class="file-info">
                                    <i class="fas fa-file-image"></i>
                                    <span>Uploaded on <?php echo date('d M Y', strtotime($documents['passport_back']['upload_date'])); ?></span>
                                </div>
                                <!-- <span class="badge bg-success">Uploaded</span> -->
                            </div>
                        <?php else: ?>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="document_type" value="passport_back">
                                <div class="document-input-group">
                                    <div class="file-input-wrapper">
                                        <button class="upload-btn"><i class="fas fa-upload"></i> Choose File</button>
                                        <input type="file" name="document" accept=".jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="upload-status" id="status-passport-back">No file chosen</div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Upload Document</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="components/header.js"></script>
    <script>
        // Display file name when selected
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
                const fileSize = this.files[0] ? (this.files[0].size / 1024).toFixed(2) + ' KB' : '';
                const documentType = this.closest('form').querySelector('input[name="document_type"]').value;
                const statusElement = document.getElementById('status-' + documentType.replace('_', '-'));

                if (statusElement) {
                    statusElement.textContent = fileName + (fileSize ? ' (' + fileSize + ')' : '');

                    // Check file size
                    if (this.files[0] && this.files[0].size > <?php echo MAX_FILE_SIZE; ?>) {
                        statusElement.innerHTML += ' <span class="text-danger">File too large (max 90KB)</span>';
                    }
                }
            });
        });
    </script>
</body>

</html>