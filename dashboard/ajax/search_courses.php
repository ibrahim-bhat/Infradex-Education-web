<?php
session_start();
if (!isset($_SESSION['user_role'])) {
    exit('Unauthorized');
}

require_once '../../config/db_connect.php';

if(isset($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);
    
    $query = "SELECT id, title, price, duration, level 
              FROM courses 
              WHERE title LIKE '%$search%' 
              AND status = 'active'
              LIMIT 5";
              
    $result = $conn->query($query);
    
    if($result->num_rows > 0) {
        while($course = $result->fetch_assoc()) {
            echo "<div class='search-item course-result' 
                       data-id='{$course['id']}' 
                       data-title='{$course['title']}'
                       data-price='{$course['price']}'>
                    <strong>{$course['title']}</strong><br>
                    <small>{$course['duration']} | {$course['level']} | ₹{$course['price']}</small>
                  </div>";
        }
    } else {
        echo "<div class='search-item'>No courses found</div>";
    }
} 