<?php
session_start();
if (!isset($_SESSION['user_role'])) {
    exit('Unauthorized');
}

require_once '../../config/db_connect.php';

if(isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    
    $query = "SELECT r.*, u.full_name, u.email 
              FROM receipts r 
              JOIN users u ON r.user_id = u.id 
              WHERE r.id = ?";
              
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($payment = $result->fetch_assoc()) {
        ?>
        <div class="receipt">
            <div class="receipt-header">
                <img src="../images/logo.png" alt="Logo" class="receipt-logo">
                <h4>Payment Receipt</h4>
                <small>Receipt #<?php echo str_pad($payment['id'], 6, '0', STR_PAD_LEFT); ?></small>
            </div>
            
            <div class="receipt-details">
                <div class="receipt-row">
                    <span class="receipt-label">Date:</span>
                    <span class="receipt-value"><?php echo date('d M Y, h:i A', strtotime($payment['assigned_at'])); ?></span>
                </div>
                <div class="receipt-row">
                    <span class="receipt-label">Student Name:</span>
                    <span class="receipt-value"><?php echo htmlspecialchars($payment['full_name']); ?></span>
                </div>
                <div class="receipt-row">
                    <span class="receipt-label">Email:</span>
                    <span class="receipt-value"><?php echo htmlspecialchars($payment['email']); ?></span>
                </div>
                <div class="receipt-row">
                    <span class="receipt-label">Course:</span>
                    <span class="receipt-value"><?php echo htmlspecialchars($payment['course_name']); ?></span>
                </div>
                <div class="receipt-row">
                    <span class="receipt-label">Payment Method:</span>
                    <span class="receipt-value"><?php echo ucfirst($payment['payment_method']); ?></span>
                </div>
                <?php if($payment['payment_method'] == 'online'): ?>
                <div class="receipt-row">
                    <span class="receipt-label">Transaction ID:</span>
                    <span class="receipt-value"><?php echo htmlspecialchars($payment['transaction_id']); ?></span>
                </div>
                <?php endif; ?>
                <div class="receipt-row receipt-total">
                    <span class="receipt-label">Amount Paid:</span>
                    <span class="receipt-value">₹<?php echo number_format($payment['amount'], 2); ?></span>
                </div>
            </div>
            
            <div class="receipt-footer">
                <p>Collected by: <?php echo htmlspecialchars($payment['collected_by']); ?></p>
                <p>Thank you for your payment!</p>
            </div>
        </div>
        <?php
    }
} 