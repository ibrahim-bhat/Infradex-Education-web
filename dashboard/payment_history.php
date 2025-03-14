<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin', 'management'])) {
    header('Location: userdash.php');
    exit();
}

require_once '../config/db_connect.php';

// Pagination
$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

// Add check for payments table existence
$check_payments_table = "SHOW TABLES LIKE 'payments'";
$table_exists = $conn->query($check_payments_table)->num_rows > 0;

if (!$table_exists) {
    // Create payments table if it doesn't exist
    $create_payments_table = "CREATE TABLE IF NOT EXISTS payments (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        payment_method ENUM('cash', 'online') NOT NULL,
        transaction_id VARCHAR(100),
        assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    $conn->query($create_payments_table);
}

// Get payment statistics
$stats_query = "SELECT 
    COUNT(*) as total_payments,
    SUM(amount) as total_revenue,
    COUNT(CASE WHEN payment_method = 'cash' THEN 1 END) as cash_payments,
    COUNT(CASE WHEN payment_method = 'online' THEN 1 END) as online_payments,
    SUM(CASE WHEN payment_method = 'cash' THEN amount END) as cash_revenue,
    SUM(CASE WHEN payment_method = 'online' THEN amount END) as online_revenue
    FROM payments";
$stats_result = $conn->query($stats_query);
$payment_stats = $stats_result->fetch_assoc();

// Base query
$query = "SELECT p.*, u.full_name, u.email 
          FROM payments p 
          JOIN users u ON p.user_id = u.id";

// Filters
$where_conditions = [];
$params = [];
$param_types = "";

if (isset($_GET['payment_method']) && $_GET['payment_method'] != '') {
    $where_conditions[] = "p.payment_method = ?";
    $params[] = $_GET['payment_method'];
    $param_types .= "s";
}

if (isset($_GET['search']) && $_GET['search'] != '') {
    $where_conditions[] = "(u.full_name LIKE ? OR u.email LIKE ? OR p.transaction_id LIKE ?)";
    $search_term = "%" . $_GET['search'] . "%";
    $params[] = $search_term;
    $params[] = $search_term;
    $params[] = $search_term;
    $param_types .= "sss";
}

if (isset($_GET['date_from']) && $_GET['date_from'] != '') {
    $where_conditions[] = "DATE(p.assigned_at) >= ?";
    $params[] = $_GET['date_from'];
    $param_types .= "s";
}

if (isset($_GET['date_to']) && $_GET['date_to'] != '') {
    $where_conditions[] = "DATE(p.assigned_at) <= ?";
    $params[] = $_GET['date_to'];
    $param_types .= "s";
}

if (!empty($where_conditions)) {
    $query .= " WHERE " . implode(" AND ", $where_conditions);
}

// Add ordering
$query .= " ORDER BY p.assigned_at DESC LIMIT ?, ?";
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
$total_query = "SELECT COUNT(*) as count FROM payments p";
if (!empty($where_conditions)) {
    $total_query .= " WHERE " . implode(" AND ", $where_conditions);
}
$total_stmt = $conn->prepare($total_query);
if (!empty($params) && !empty($param_types) && count($params) > 2) {
    // Remove the last two parameters (LIMIT parameters)
    array_pop($params);
    array_pop($params);
    $total_stmt->bind_param(substr($param_types, 0, -2), ...$params);
}
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_records = $total_result->fetch_assoc()['count'];
$total_pages = ceil($total_records / $per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
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
                            <h1>Payment History</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Payment History</li>
                                </ol>
                            </nav>
                        </div>
                        <button class="btn btn-primary" onclick="exportToExcel()">
                            <i class="fas fa-download me-2"></i>Export
                        </button>
                    </div>
                </div>

                <!-- Payment Statistics Section -->
                <?php if (in_array($_SESSION['user_role'], ['super_admin', 'admin'])): ?>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon" style="background: rgba(52,152,219,0.1); color: #3498db;">
                                    <i class="fas fa-rupee-sign"></i>
                                </div>
                                <div class="stat-info">
                                    <h3>₹<?php echo number_format($payment_stats['total_revenue']); ?></h3>
                                    <p>Total Revenue</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon" style="background: rgba(46,204,113,0.1); color: #2ecc71;">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                                <div class="stat-info">
                                    <h3><?php echo number_format($payment_stats['cash_payments']); ?></h3>
                                    <p>Cash Payments</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon" style="background: rgba(155,89,182,0.1); color: #9b59b6;">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="stat-info">
                                    <h3><?php echo number_format($payment_stats['online_payments']); ?></h3>
                                    <p>Online Payments</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="stat-icon" style="background: rgba(230,126,34,0.1); color: #e67e22;">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="stat-info">
                                    <h3><?php echo number_format($payment_stats['total_payments']); ?></h3>
                                    <p>Total Transactions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search student, email..."
                                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            </div>
                            <div class="col-md-2">
                                <select name="payment_method" class="form-select">
                                    <option value="">All Methods</option>
                                    <option value="cash" <?php echo isset($_GET['payment_method']) && $_GET['payment_method'] == 'cash' ? 'selected' : ''; ?>>Cash</option>
                                    <option value="online" <?php echo isset($_GET['payment_method']) && $_GET['payment_method'] == 'online' ? 'selected' : ''; ?>>Online</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="date_from" class="form-control"
                                    value="<?php echo isset($_GET['date_from']) ? htmlspecialchars($_GET['date_from']) : ''; ?>">
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="date_to" class="form-control"
                                    value="<?php echo isset($_GET['date_to']) ? htmlspecialchars($_GET['date_to']) : ''; ?>">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                                <a href="payment_history.php" class="btn btn-light">
                                    <i class="fas fa-redo me-2"></i>Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payment History Table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Student</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Transaction ID</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo date('d M Y, h:i A', strtotime($row['assigned_at'])); ?></td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold"><?php echo htmlspecialchars($row['full_name']); ?></span>
                                                    <small class="text-muted"><?php echo htmlspecialchars($row['email']); ?></small>
                                                </div>
                                            </td>
                                            <td>₹<?php echo number_format($row['amount'], 2); ?></td>
                                            <td>
                                                <span class="badge <?php echo $row['payment_method'] == 'cash' ? 'bg-success' : 'bg-primary'; ?>">
                                                    <?php echo ucfirst($row['payment_method']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($row['payment_method'] == 'online'): ?>
                                                    <span class="text-primary"><?php echo htmlspecialchars($row['transaction_id']); ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">N/A</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info view-receipt" data-id="<?php echo $row['id']; ?>">
                                                    <i class="fas fa-receipt"></i>
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
                                            <a class="page-link" href="?page=<?php echo $i; ?><?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?><?php echo isset($_GET['payment_method']) ? '&payment_method=' . $_GET['payment_method'] : ''; ?>">
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

    <!-- Receipt Modal -->
    <div class="modal fade" id="receiptModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Receipt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="receiptContent">
                    <!-- Receipt content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printReceipt()">
                        <i class="fas fa-print me-2"></i>Print
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/payments.js"></script>
</body>

</html>