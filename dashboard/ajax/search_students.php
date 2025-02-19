<?php
session_start();
if (!isset($_SESSION['user_role'])) {
    exit('Unauthorized');
}

require_once '../../config/db_connect.php';

if(isset($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);
    
    $query = "SELECT id, full_name, email, phone_number, class 
              FROM students 
              WHERE full_name LIKE '%$search%' 
              OR email LIKE '%$search%' 
              OR phone_number LIKE '%$search%'
              LIMIT 5";
              
    $result = $conn->query($query);
    
    if($result->num_rows > 0) {
        while($student = $result->fetch_assoc()) {
            echo "<div class='search-item student-result' 
                       data-id='{$student['id']}' 
                       data-name='{$student['full_name']}'
                       data-details='Class: {$student['class']} | Email: {$student['email']} | Phone: {$student['phone_number']}'>
                    <strong>{$student['full_name']}</strong><br>
                    <small>Class: {$student['class']} | {$student['email']}</small>
                  </div>";
        }
    } else {
        echo "<div class='search-item'>No students found</div>";
    }
} 