<?php
session_start();
if (!isset($_SESSION['user_role'])) {
    exit('Unauthorized');
}

require_once '../../config/db_connect.php';

// Set headers for Excel download
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="payment_history.xls"');
header('Cache-Control: max-age=0');

// Build query with filters (similar to payment_history.php)
$query = "SELECT ca.*, s.full_name, s.email, c.title as course_name, 
          u.username as collected_by
          FROM course_assignments ca
          LEFT JOIN students s ON ca.student_id = s.id
          LEFT JOIN courses c ON ca.course_id = c.id
          LEFT JOIN users u ON ca.assigned_by = u.id";

// Add filters (similar to payment_history.php)
// ...

$result = $conn->query($query);

// Output Excel content
echo "Date\tStudent Name\tEmail\tCourse\tAmount\tPayment Method\tTransaction ID\tCollected By\n";

while($row = $result->fetch_assoc()) {
    echo date('Y-m-d H:i:s', strtotime($row['assigned_at'])) . "\t";
    echo $row['full_name'] . "\t";
    echo $row['email'] . "\t";
    echo $row['course_name'] . "\t";
    echo $row['amount'] . "\t";
    echo $row['payment_method'] . "\t";
    echo ($row['payment_method'] == 'online' ? $row['transaction_id'] : 'N/A') . "\t";
    echo $row['collected_by'] . "\n";
} 