<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Fetch payment history with correct join
$payment_query = "SELECT 
    ca.id,
    ca.student_id,
    ca.course_id,
    ca.payment_method,
    ca.transaction_id,
    ca.amount,
    ca.assigned_by,
    ca.assigned_at,
    ca.payment_status,
    ca.payment_date,
    c.title as course_title,
    c.description as course_description,
    c.duration as course_duration
    FROM course_assignments ca
    JOIN courses c ON ca.course_id = c.id
    WHERE ca.student_id = ? 
    ORDER BY ca.assigned_at DESC";

$stmt = $conn->prepare($payment_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$payments = $stmt->get_result();

// Log any database errors
if (!$payments) {
    error_log("Database error: " . $conn->error);
}

// Debug
if ($payments->num_rows === 0) {
    error_log("No payments found for user ID: " . $user_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History | Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="./css/dashboard.css" rel="stylesheet">
</head>
<body>
    <div class="glow-overlay"></div>
    <div class="scanlines"></div>

    <div class="dashboard-container">
        <?php include 'components/sidebar.php'; ?>

        <main class="main-content">
            <dashboard-header></dashboard-header>

            <div class="dashboard-content">
                <div class="section-header">
                    <h2>Payment History</h2>
                </div>
                <?php include '../components/coming-soon.php'; ?>

                <!-- <div class="payment-history">
                    <?php if ($payments && $payments->num_rows > 0): ?>
                        <?php while($payment = $payments->fetch_assoc()): ?>
                            <div class="payment-card">
                                <div class="payment-info">
                                    <div class="payment-icon">
                                        <?php 
                                        $icon_class = match($payment['payment_method']) {
                                            'online' => 'fa-credit-card',
                                            'cash' => 'fa-money-bill',
                                            'upi' => 'fa-mobile-alt',
                                            'bank_transfer' => 'fa-university',
                                            'cheque' => 'fa-money-check',
                                            default => 'fa-credit-card'
                                        };
                                        ?>
                                        <i class="fas <?php echo $icon_class; ?>"></i>
                                    </div>
                                    <div class="payment-details">
                                        <h4><?php echo htmlspecialchars($payment['course_title']); ?></h4>
                                        <p class="course-desc"><?php echo htmlspecialchars(substr($payment['course_description'], 0, 100)) . '...'; ?></p>
                                        <p class="transaction-id">
                                            <?php if ($payment['transaction_id']): ?>
                                                Transaction ID: <?php echo htmlspecialchars($payment['transaction_id']); ?>
                                            <?php else: ?>
                                                Payment ID: <?php echo htmlspecialchars($payment['id']); ?>
                                            <?php endif; ?>
                                        </p>
                                        <span class="payment-date">
                                            Paid on: <?php echo date('d M Y, h:i A', strtotime($payment['payment_date'])); ?>
                                        </span>
                                        <span class="course-duration">
                                            <i class="fas fa-clock me-1"></i>
                                            Duration: <?php echo htmlspecialchars($payment['course_duration']); ?> hours
                                        </span>
                                    </div>
                                </div>
                                <div class="payment-amount">
                                    <span class="amount">₹<?php echo number_format($payment['amount'], 2); ?></span>
                                    <span class="status <?php echo strtolower($payment['payment_method']); ?>">
                                        <?php echo ucfirst($payment['payment_method']); ?>
                                    </span>
                                    <span class="payment-status <?php echo strtolower($payment['payment_status']); ?>">
                                        <?php echo ucfirst($payment['payment_status']); ?>
                                    </span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="no-payments">
                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                No payment history found. Please check back after making a course purchase.
                            </div>
                        </div>
                    <?php endif; ?>
                </div> -->

                <?php if ($payments && $payments->num_rows > 0): ?>
                <div class="payment-summary mt-4">
                    <div class="card bg-dark">
                        <div class="card-body">
                            <h5 class="card-title">Payment Summary</h5>
                            <?php 
                            // Reset result pointer
                            $payments->data_seek(0);
                            $total_spent = 0;
                            $total_transactions = $payments->num_rows;
                            $payment_methods = [];
                            
                            while($payment = $payments->fetch_assoc()) {
                                $total_spent += $payment['amount'];
                                $payment_methods[$payment['payment_method']] = ($payment_methods[$payment['payment_method']] ?? 0) + 1;
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="mb-1">Total Spent</p>
                                    <h3 class="text-primary">₹<?php echo number_format($total_spent, 2); ?></h3>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1">Total Transactions</p>
                                    <h3 class="text-primary"><?php echo $total_transactions; ?></h3>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1">Payment Methods Used</p>
                                    <div class="payment-methods">
                                        <?php foreach($payment_methods as $method => $count): ?>
                                            <span class="badge bg-primary me-2">
                                                <?php echo ucfirst($method) . ' (' . $count . ')'; ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./components/header.js"></script>
    <script src="./js/dashboard.js"></script>
</body>
</html> 