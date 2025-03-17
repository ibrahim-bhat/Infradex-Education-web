<?php
require_once '../../includes/db_connection.php';
session_start();

// Check if user is logged in and has appropriate role
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    die(json_encode(['success' => false, 'message' => 'Unauthorized access']));
}

try {
    $conn->begin_transaction();

    $post_id = $_POST['post_id'] ?? 0;
    $is_new = $post_id == 0;

    // Handle featured image upload
    $featured_image = null;
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] == 0) {
        $upload_dir = '../uploads/blog/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_extension = strtolower(pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($file_extension, $allowed_extensions)) {
            throw new Exception('Invalid file type. Only JPG, JPEG, PNG, and WEBP files are allowed.');
        }

        $new_filename = uniqid() . '.' . $file_extension;
        $upload_path = $upload_dir . $new_filename;

        if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $upload_path)) {
            $featured_image = 'uploads/blog/' . $new_filename;
        }
    }

    // Prepare blog post data
    $data = [
        'title' => $_POST['title'],
        'slug' => $_POST['slug'],
        'content' => $_POST['content'],
        'category_id' => $_POST['category_id'],
        'status' => $_POST['status'],
        'meta_title' => $_POST['meta_title'],
        'meta_description' => $_POST['meta_description'],
        'display_type' => $_POST['display_type'],
        'card_subtitle' => $_POST['card_subtitle'],
        'card_rating' => $_POST['card_rating'] ? $_POST['card_rating'] : null,
        'card_reviews_count' => $_POST['card_reviews_count'] ? $_POST['card_reviews_count'] : 0,
        'card_highlight_text' => $_POST['card_highlight_text'],
        'card_button_text' => $_POST['card_button_text'],
        'card_button_link' => $_POST['card_button_link']
    ];

    if ($featured_image) {
        $data['featured_image'] = $featured_image;
    }

    if ($is_new) {
        $data['author_id'] = $_SESSION['user_id'];
        
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));
        
        $stmt = $conn->prepare("INSERT INTO blog_posts ($columns) VALUES ($values)");
        $stmt->bind_param(str_repeat('s', count($data)), ...array_values($data));
        $stmt->execute();
        
        $post_id = $conn->insert_id;
    } else {
        $set_clause = implode(' = ?, ', array_keys($data)) . ' = ?';
        
        $stmt = $conn->prepare("UPDATE blog_posts SET $set_clause WHERE id = ?");
        $stmt->bind_param(str_repeat('s', count($data)) . 'i', ...array_values($data), $post_id);
        $stmt->execute();
    }

    // Handle FAQs
    if ($post_id) {
        // Delete existing FAQs
        $stmt = $conn->prepare("DELETE FROM blog_faqs WHERE post_id = ?");
        $stmt->bind_param('i', $post_id);
        $stmt->execute();

        // Insert new FAQs
        if (isset($_POST['faq_questions']) && is_array($_POST['faq_questions'])) {
            $stmt = $conn->prepare("INSERT INTO blog_faqs (post_id, question, answer, order_index) VALUES (?, ?, ?, ?)");
            
            foreach ($_POST['faq_questions'] as $index => $question) {
                if (empty($question)) continue;
                
                $answer = $_POST['faq_answers'][$index] ?? '';
                $stmt->bind_param('issi', $post_id, $question, $answer, $index);
                $stmt->execute();
            }
        }

        // Delete existing stats
        $stmt = $conn->prepare("DELETE FROM blog_post_stats WHERE post_id = ?");
        $stmt->bind_param('i', $post_id);
        $stmt->execute();

        // Insert new stats
        if (isset($_POST['stat_keys']) && is_array($_POST['stat_keys'])) {
            $stmt = $conn->prepare("INSERT INTO blog_post_stats (post_id, stat_key, stat_value, stat_icon, order_index) VALUES (?, ?, ?, ?, ?)");
            
            foreach ($_POST['stat_keys'] as $index => $key) {
                if (empty($key)) continue;
                
                $value = $_POST['stat_values'][$index] ?? '';
                $icon = $_POST['stat_icons'][$index] ?? '';
                $stmt->bind_param('isssi', $post_id, $key, $value, $icon, $index);
                $stmt->execute();
            }
        }
    }

    $conn->commit();
    echo json_encode(['success' => true, 'post_id' => $post_id]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?> 