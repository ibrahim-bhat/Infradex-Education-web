<?php
session_start();
require_once '../config/db_connect.php';

// Check if user is admin
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])) {
    header('Location: ../login-new.php');
    exit();
}

// Handle document verification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $doc_id = $_POST['document_id'];
    $verified = $_POST['action'] === 'verify' ? 1 : 0;
    $notes = $_POST['notes'] ?? '';

    $update_query = "UPDATE student_documents SET 
                    verified = ?, 
                    verified_by = ?, 
                    verification_date = NOW(),
                    notes = ?
                    WHERE id = ?";  

    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("iiss", $verified, $_SESSION['user_id'], $notes, $doc_id);
    $stmt->execute();
}

// Fetch all student documents with student information
$query = "SELECT sd.*, s.full_name as student_name, s.email as student_email,
          v.full_name as verifier_name
          FROM student_documents sd
          LEFT JOIN students s ON sd.user_id = s.id 
          LEFT JOIN users v ON sd.verified_by = v.id
          ORDER BY sd.upload_date DESC";

$result = $conn->query($query);

if (!$result) {
    die("Error fetching documents: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Documents | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="css/charts.css">

    <style>
        .document-card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            border: 1px solid #e3e6f0;
            transition: all 0.3s ease;
        }

        .document-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .document-header {
            background: var(--primary-color);
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
        }

        .document-header h5 {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        .document-content {
            padding: 20px;
        }

        .verification-badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .verified {
            background-color: rgba(28, 200, 138, 0.1);
            color: var(--success-color);
            border: 1px solid var(--success-color);
        }

        .unverified {
            background-color: rgba(246, 194, 62, 0.1);
            color: var(--warning-color);
            border: 1px solid var(--warning-color);
        }

        .document-preview {
            width: 100%;
            height: 200px;
            object-fit: contain;
            border-radius: 6px;
            border: 1px solid #e3e6f0;
            background-color: #f8f9fc;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .document-preview:hover {
            transform: scale(1.02);
        }

        .document-info {
            margin: 20px 0;
        }

        .document-info p {
            margin-bottom: 8px;
            color: #858796;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .document-info strong {
            color: var(--dark-color);
            margin-right: 8px;
            min-width: 100px;
        }

        .notes-area {
            margin: 15px 0;
        }

        .notes-area textarea {
            border: 1px solid #e3e6f0;
            border-radius: 6px;
            padding: 10px;
            font-size: 0.9rem;
            resize: vertical;
            min-height: 80px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 8px 16px;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
        }

        .btn i {
            margin-right: 5px;
        }

        .filter-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e3e6f0;
        }

        .filter-section .form-select,
        .filter-section .form-control {
            border: 1px solid #e3e6f0;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        .section-title {
            color: var(--dark-color);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
        }

        /* Modal Styling */
        .modal-content {
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: var(--primary-color);
            color: #ffffff;
            border-radius: 8px 8px 0 0;
            padding: 15px 20px;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-body {
            padding: 20px;
        }

        .btn-close {
            color: #ffffff;
            opacity: 1;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .filter-section .row>div {
                margin-bottom: 15px;
            }

            .document-card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <?php include 'components/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'components/header.php'; ?>

            <main class="px-4 py-4">
                <h1 class="section-title">Student Documents</h1>

                <!-- Filter Section -->
                <div class="filter-section">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-select" id="documentTypeFilter">
                                <option value="">All Document Types</option>
                                <option value="id_proof">ID Proof</option>
                                <option value="address_proof">Address Proof</option>
                                <option value="qualification">Qualification</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="verificationFilter">
                                <option value="">All Status</option>
                                <option value="verified">Verified</option>
                                <option value="unverified">Unverified</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search by student name or email">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100" onclick="applyFilters()">
                                <i class="fas fa-filter"></i> Apply Filters
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Documents Grid -->
                <div class="row" id="documentsGrid">
                    <?php while ($doc = $result->fetch_assoc()): ?>
                        <div class="col-md-6 col-lg-4 document-item"
                            data-type="<?php echo htmlspecialchars($doc['document_type']); ?>"
                            data-verified="<?php echo $doc['verified'] ? 'verified' : 'unverified'; ?>"
                            data-student="<?php echo htmlspecialchars($doc['student_name'] . ' ' . $doc['student_email']); ?>">
                            <div class="document-card">
                                <div class="document-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5><?php echo ucfirst(str_replace('_', ' ', $doc['document_type'])); ?></h5>
                                        <span class="verification-badge <?php echo $doc['verified'] ? 'verified' : 'unverified'; ?>">
                                            <?php echo $doc['verified'] ? 'Verified' : 'Unverified'; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="document-content">
                                    <div class="document-info">
                                        <p><strong>Student:</strong> <?php echo htmlspecialchars($doc['student_name']); ?></p>
                                        <p><strong>Email:</strong> <?php echo htmlspecialchars($doc['student_email']); ?></p>
                                        <p><strong>Uploaded:</strong> <?php echo date('d M Y', strtotime($doc['upload_date'])); ?></p>
                                        <?php if ($doc['verified']): ?>
                                            <p><strong>Verified By:</strong> <?php echo htmlspecialchars($doc['verifier_name']); ?></p>
                                            <p><strong>Verified On:</strong> <?php echo date('d M Y', strtotime($doc['verification_date'])); ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Document Preview -->
                                    <img src="<?php echo htmlspecialchars($doc['file_path']); ?>"
                                        alt="Document Preview"
                                        class="document-preview"
                                        onclick="openDocumentPreview('<?php echo htmlspecialchars($doc['file_path']); ?>')">

                                    <!-- Notes Section -->
                                    <div class="notes-area">
                                        <textarea class="form-control"
                                            placeholder="Add verification notes..."
                                            id="notes_<?php echo $doc['id']; ?>"><?php echo htmlspecialchars($doc['notes']); ?></textarea>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="action-buttons">
                                        <?php if (!$doc['verified']): ?>
                                            <button class="btn btn-success"
                                                onclick="verifyDocument(<?php echo $doc['id']; ?>)">
                                                <i class="fas fa-check"></i> Verify
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-warning"
                                                onclick="unverifyDocument(<?php echo $doc['id']; ?>)">
                                                <i class="fas fa-times"></i> Unverify
                                            </button>
                                        <?php endif; ?>
                                        <button class="btn btn-primary"
                                            onclick="downloadDocument('<?php echo htmlspecialchars($doc['file_path']); ?>')">
                                            <i class="fas fa-download"></i> Download
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Document Preview Modal -->
    <div class="modal fade" id="documentPreviewModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Document Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="modalPreviewImage" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openDocumentPreview(path) {
            $('#modalPreviewImage').attr('src', path);
            $('#documentPreviewModal').modal('show');
        }

        function verifyDocument(docId) {
            const notes = $(`#notes_${docId}`).val();
            submitVerification(docId, 'verify', notes);
        }

        function unverifyDocument(docId) {
            const notes = $(`#notes_${docId}`).val();
            submitVerification(docId, 'unverify', notes);
        }

        function submitVerification(docId, action, notes) {
            const formData = new FormData();
            formData.append('document_id', docId);
            formData.append('action', action);
            formData.append('notes', notes);

            fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(() => window.location.reload())
                .catch(error => console.error('Error:', error));
        }

        function downloadDocument(path) {
            window.open(path, '_blank');
        }

        function applyFilters() {
            const type = $('#documentTypeFilter').val();
            const verified = $('#verificationFilter').val();
            const search = $('#searchInput').val().toLowerCase();

            $('.document-item').each(function() {
                const item = $(this);
                const matchesType = !type || item.data('type') === type;
                const matchesVerified = !verified || item.data('verified') === verified;
                const matchesSearch = !search ||
                    item.data('student').toLowerCase().includes(search);

                item.toggle(matchesType && matchesVerified && matchesSearch);
            });
        }

        // Initialize tooltips
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>