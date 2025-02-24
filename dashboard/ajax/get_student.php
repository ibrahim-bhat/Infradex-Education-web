<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] === 'user') {
    exit('Unauthorized');
}

require_once '../../config/db_connect.php';

if(isset($_POST['id'])) {
    $student_id = (int)$_POST['id'];
    
    // Get student details with added by information
    $query = "SELECT s.*, u.full_name as added_by_name, u.user_role as added_by_role 
              FROM students s 
              LEFT JOIN users u ON s.added_by = u.id 
              WHERE s.id = ?";
              
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($student = $result->fetch_assoc()) {
        // Get enrolled courses
        $courses_query = "SELECT c.title, ca.assigned_at as enrollment_date, c.status
                         FROM course_assignments ca
                         JOIN courses c ON ca.course_id = c.id
                         WHERE ca.student_id = ?";
        $courses_stmt = $conn->prepare($courses_query);
        $courses_stmt->bind_param("i", $student_id);
        $courses_stmt->execute();
        $courses_result = $courses_stmt->get_result();
        $enrolled_courses = [];
        while($course = $courses_result->fetch_assoc()) {
            $enrolled_courses[] = $course;
        }

        // Get payment history from course_assignments
        $payments_query = "SELECT amount, payment_method, transaction_id, assigned_at as payment_date
                          FROM course_assignments 
                          WHERE student_id = ?";
        $payments_stmt = $conn->prepare($payments_query);
        $payments_stmt->bind_param("i", $student_id);
        $payments_stmt->execute();
        $payments_result = $payments_stmt->get_result();
        $payments = [];
        while($payment = $payments_result->fetch_assoc()) {
            $payments[] = $payment;
        }

        echo json_encode([
            'id' => $student['id'],
            'full_name' => $student['full_name'],
            'phone_number' => $student['phone_number'],
            'email' => $student['email'],
            'dob' => $student['dob'],
            'gender' => $student['gender'],
            'class' => $student['class'],
            'city' => $student['city'],
            'state' => $student['state'],
            'pincode' => $student['pincode'],
            'colony' => $student['colony'],
            'parent_name' => $student['parent_name'],
            'parent_phone' => $student['parent_phone'],
            'added_by_name' => $student['added_by_name'],
            'added_by_role' => ucfirst($student['added_by_role']),
            'created_at' => $student['created_at'],
            'enrolled_courses' => $enrolled_courses,
            'payments' => $payments
        ]);
    } else {
        echo json_encode(['error' => 'Student not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
} 