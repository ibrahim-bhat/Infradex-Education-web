<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] === 'user') {
    exit('Unauthorized');
}

require_once '../../config/db_connect.php';
require_once '../../vendor/autoload.php'; // Make sure you have TCPDF installed

if(isset($_GET['id'])) {
    $student_id = (int)$_GET['id'];
    
    // Get all student information (use the same queries as in get_student.php)
    // ... fetch student details, courses, and payments ...

    // Create PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    // Set document information
    $pdf->SetCreator('Your System Name');
    $pdf->SetAuthor('Your Organization');
    $pdf->SetTitle('Student Details');

    // Add a page
    $pdf->AddPage();

    // Add content to the PDF
    // ... format and add all student information ...

    // Output the PDF
    $pdf->Output('student_details.pdf', 'D');
} else {
    echo 'Invalid request';
} 