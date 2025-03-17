<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

// Create uploads directory if it doesn't exist
$upload_dir = "../uploads/blog";
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn->begin_transaction();

        $title = trim($_POST['title']);
        $slug = strtolower(str_replace(' ', '-', $title));
        $content = $_POST['content'];
        $excerpt = !empty($_POST['excerpt']) ? trim($_POST['excerpt']) : substr(strip_tags($content), 0, 150);
        $category_id = (int)$_POST['category_id'];
        $status = $_POST['status'];
        $meta_title = !empty($_POST['meta_title']) ? trim($_POST['meta_title']) : $title;
        $meta_description = !empty($_POST['meta_description']) ? trim($_POST['meta_description']) : $excerpt;
        $featured_image = '';
        
        // Handle featured image upload
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === 0) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            $max_size = 5 * 1024 * 1024; // 5MB
            
            $file_type = $_FILES['featured_image']['type'];
            $file_size = $_FILES['featured_image']['size'];
            
            if (!in_array($file_type, $allowed_types)) {
                throw new Exception("Only JPG, JPEG, PNG, and WEBP images are allowed.");
            } elseif ($file_size > $max_size) {
                throw new Exception("Image size should be less than 5MB.");
            } else {
                $file_name = time() . '_' . $_FILES['featured_image']['name'];
                $file_name = str_replace(' ', '_', $file_name);
                $upload_path = $upload_dir . '/' . $file_name;
                
                if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $upload_path)) {
                    $featured_image = 'uploads/blog/' . $file_name;
                } else {
                    throw new Exception("Failed to upload image.");
                }
            }
        }

        // Insert post
        $sql = "INSERT INTO blog_posts (
            title, slug, content, excerpt, category_id, status, 
            meta_title, meta_description, featured_image, author_id,
            display_type, card_subtitle, card_rating, card_reviews_count,
            card_highlight_text, card_button_text, card_button_link
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $display_type = $_POST['display_type'] ?? 'standard';
        $card_subtitle = $_POST['card_subtitle'] ?? null;
        $card_rating = $_POST['card_rating'] ? (float)$_POST['card_rating'] : null;
        $card_reviews_count = $_POST['card_reviews_count'] ? (int)$_POST['card_reviews_count'] : 0;
        $card_highlight_text = $_POST['card_highlight_text'] ?? null;
        $card_button_text = $_POST['card_button_text'] ?? null;
        $card_button_link = $_POST['card_button_link'] ?? null;
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param(
            "sssssssssissdisss",
            $title, $slug, $content, $excerpt, $category_id, $status,
            $meta_title, $meta_description, $featured_image, $_SESSION['user_id'],
            $display_type, $card_subtitle, $card_rating, $card_reviews_count,
            $card_highlight_text, $card_button_text, $card_button_link
        );
        
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        $post_id = $conn->insert_id;

        // Handle tags if provided
        if (!empty($_POST['tags'])) {
            $tags = array_map('trim', explode(',', $_POST['tags']));
            foreach ($tags as $tag_name) {
                if (empty($tag_name)) continue;
                
                // Create slug from tag name
                $tag_slug = strtolower(str_replace(' ', '-', $tag_name));
                
                // Insert tag if it doesn't exist
                $stmt = $conn->prepare("INSERT IGNORE INTO blog_tags (name, slug) VALUES (?, ?)");
                $stmt->bind_param("ss", $tag_name, $tag_slug);
                $stmt->execute();
                
                // Get tag ID
                $tag_id = $stmt->insert_id;
                if (!$tag_id) {
                    $stmt = $conn->prepare("SELECT id FROM blog_tags WHERE slug = ?");
                    $stmt->bind_param("s", $tag_slug);
                    $stmt->execute();
                    $tag_id = $stmt->get_result()->fetch_assoc()['id'];
                }
                
                // Link tag to post
                $stmt = $conn->prepare("INSERT IGNORE INTO blog_post_tags (post_id, tag_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $post_id, $tag_id);
                $stmt->execute();
            }
        }

        // Handle FAQs if provided
        if (isset($_POST['faq_questions']) && is_array($_POST['faq_questions'])) {
            $stmt = $conn->prepare("INSERT INTO blog_faqs (post_id, question, answer, order_index) VALUES (?, ?, ?, ?)");
            foreach ($_POST['faq_questions'] as $index => $question) {
                if (empty($question)) continue;
                $answer = $_POST['faq_answers'][$index] ?? '';
                $stmt->bind_param("issi", $post_id, $question, $answer, $index);
                $stmt->execute();
            }
        }

        // Handle statistics if provided
        if (isset($_POST['stat_keys']) && is_array($_POST['stat_keys'])) {
            $stmt = $conn->prepare("INSERT INTO blog_post_stats (post_id, stat_key, stat_value, stat_icon, order_index) VALUES (?, ?, ?, ?, ?)");
            foreach ($_POST['stat_keys'] as $index => $key) {
                if (empty($key)) continue;
                $value = $_POST['stat_values'][$index] ?? '';
                $icon = $_POST['stat_icons'][$index] ?? '';
                $stmt->bind_param("isssi", $post_id, $key, $value, $icon, $index);
                $stmt->execute();
            }
        }

        $conn->commit();
        $_SESSION['success_msg'] = "Blog post created successfully!";
        header("Location: blog-posts.php");
        exit();
            
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error_msg'] = "Error creating blog post: " . $e->getMessage();
        error_log("Blog post creation error: " . $e->getMessage());
    }
}

// Get categories for dropdown
$categories_query = "SELECT id, name FROM blog_categories ORDER BY name";
$categories_result = $conn->query($categories_query);
$categories = [];
while ($row = $categories_result->fetch_assoc()) {
    $categories[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Blog Post - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/components.css">
    <!-- Include Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .blog-form-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .form-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 25px;
        }
        
        .section-title {
            color: var(--primary-color);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(78, 115, 223, 0.1);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .image-preview {
            width: 100%;
            height: 200px;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
            border: 2px dashed rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .image-preview-placeholder {
            color: var(--secondary-color);
            text-align: center;
            padding: 20px;
        }
        
        .image-preview-placeholder i {
            font-size: 3rem;
            margin-bottom: 10px;
            display: block;
        }
        
        .note-editor {
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
        }
        
        .note-toolbar {
            background-color: #f8f9fc;
            border-radius: 8px 8px 0 0;
        }
        
        .note-statusbar {
            border-radius: 0 0 8px 8px;
        }
        
        .tag-input {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            min-height: 100px;
        }
        
        .tag {
            background: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .tag-remove {
            cursor: pointer;
            font-size: 0.8rem;
        }
        
        .tag-input input {
            flex: 1;
            border: none;
            outline: none;
            padding: 5px;
            min-width: 100px;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-color);
            text-decoration: none;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .back-link:hover {
            color: var(--info-color);
            transform: translateX(-5px);
        }
        
        .btn-publish {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-publish:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }
        
        .btn-draft {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-draft:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <?php include 'components/sidebar.php'; ?>
        
        <div class="main-content">
            <?php include 'components/header.php'; ?>
            
            <div class="content-wrapper">
                <div class="container-fluid">
                    <a href="blog-posts.php" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Back to Posts
                    </a>
                    
                    <div class="blog-form-container">
                        <h1 class="mb-4">Add New Blog Post</h1>
                        
                        <?php if (isset($_SESSION['error_msg'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php 
                                    echo $_SESSION['error_msg'];
                                    unset($_SESSION['error_msg']);
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form action="" method="POST" enctype="multipart/form-data" id="blogForm">
                            <div class="row">
                                <div class="col-lg-8">
                                    <!-- Main Content Section -->
                                    <div class="form-section">
                                        <h2 class="section-title">Post Content</h2>
                                        <div class="mb-3">
                                            <label for="display_type" class="form-label">Display Type</label>
                                            <select class="form-select" id="display_type" name="display_type">
                                                <option value="standard">Standard Blog</option>
                                                <option value="card">Card Layout</option>
                                            </select>
                                        </div>

                                        <!-- Card Layout Options -->
                                        <div id="cardOptions" style="display: none;">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="card_subtitle" class="form-label">Card Subtitle</label>
                                                        <input type="text" class="form-control" id="card_subtitle" name="card_subtitle" placeholder="e.g., Business Today '24">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="card_rating" class="form-label">Rating (0.0 - 5.0)</label>
                                                        <input type="number" class="form-control" id="card_rating" name="card_rating" min="0" max="5" step="0.1" placeholder="e.g., 4.6">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="card_reviews_count" class="form-label">Reviews Count</label>
                                                        <input type="number" class="form-control" id="card_reviews_count" name="card_reviews_count" min="0" placeholder="e.g., 60">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="card_highlight_text" class="form-label">Highlight Text</label>
                                                        <input type="text" class="form-control" id="card_highlight_text" name="card_highlight_text" placeholder="e.g., NIRF #2">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="card_button_text" class="form-label">Button Text</label>
                                                        <input type="text" class="form-control" id="card_button_text" name="card_button_text" placeholder="e.g., Compare">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="card_button_link" class="form-label">Button Link</label>
                                                        <input type="text" class="form-control" id="card_button_link" name="card_button_link" placeholder="e.g., /compare/iim-bangalore">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Stats Section -->
                                            <div class="mb-4">
                                                <h3 class="h5 mb-3">Statistics</h3>
                                                <div id="statsContainer">
                                                    <!-- Stats will be added here dynamically -->
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="addStat">
                                                    <i class="fas fa-plus"></i> Add Statistic
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="title" class="form-label">Post Title</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" id="content" name="content" rows="15"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="excerpt" class="form-label">Excerpt (Optional)</label>
                                            <textarea class="form-control" id="excerpt" name="excerpt" rows="3" placeholder="A short summary of your post. If left empty, it will be generated automatically."></textarea>
                                        </div>
                                    </div>

                                    <!-- FAQ Section -->
                                    <div class="form-section">
                                        <h2 class="section-title">FAQs</h2>
                                        <div id="faqContainer">
                                            <!-- FAQs will be added here dynamically -->
                                        </div>
                                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="addFaq">
                                            <i class="fas fa-plus"></i> Add FAQ
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <!-- Publish Section -->
                                    <div class="form-section">
                                        <h2 class="section-title">Publish</h2>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="published">Published</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary btn-publish" id="publishBtn">
                                                <i class="fas fa-paper-plane"></i> Publish
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary btn-draft" id="draftBtn">
                                                <i class="fas fa-save"></i> Save as Draft
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Categories Section -->
                                    <div class="form-section">
                                        <h2 class="section-title">Categories</h2>
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Select Category</label>
                                            <select class="form-select" id="category_id" name="category_id" required>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo $category['id']; ?>">
                                                        <?php echo htmlspecialchars($category['name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <a href="blog-categories.php" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-plus"></i> Add New Category
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <!-- Tags Section -->
                                    <div class="form-section">
                                        <h2 class="section-title">Tags</h2>
                                        <div class="mb-3">
                                            <label for="tags" class="form-label">Add Tags</label>
                                            <input type="text" class="form-control" id="tag_input" placeholder="Type tag and press Enter">
                                            <div class="tag-input mt-2" id="tag_container"></div>
                                            <input type="hidden" name="tags" id="tags">
                                            <small class="text-muted">Separate tags with commas or press Enter after each tag.</small>
                                        </div>
                                    </div>
                                    
                                    <!-- Featured Image Section -->
                                    <div class="form-section">
                                        <h2 class="section-title">Featured Image</h2>
                                        <div class="mb-3">
                                            <label for="featured_image" class="form-label">Upload Image</label>
                                            <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                                            <div class="image-preview" id="image_preview">
                                                <div class="image-preview-placeholder">
                                                    <i class="fas fa-image"></i>
                                                    <p>No image selected</p>
                                                </div>
                                            </div>
                                            <small class="text-muted">Recommended size: 1200x630 pixels. Max size: 5MB.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Summernote
            $('#content').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            uploadImage(files[i]);
                        }
                    }
                }
            });
            
            // Upload image to server
            function uploadImage(file) {
                let formData = new FormData();
                formData.append('file', file);
                
                $.ajax({
                    url: 'upload_image.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#content').summernote('insertImage', data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            }
            
            // Featured image preview
            $('#featured_image').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_preview').html(`<img src="${e.target.result}" alt="Preview">`);
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#image_preview').html(`
                        <div class="image-preview-placeholder">
                            <i class="fas fa-image"></i>
                            <p>No image selected</p>
                        </div>
                    `);
                }
            });
            
            // Tags handling
            const tagInput = $('#tag_input');
            const tagContainer = $('#tag_container');
            const tagsInput = $('#tags');
            let tags = [];
            
            function updateTags() {
                tagContainer.empty();
                tags.forEach(tag => {
                    tagContainer.append(`
                        <div class="tag">
                            ${tag}
                            <span class="tag-remove" data-tag="${tag}">×</span>
                        </div>
                    `);
                });
                tagsInput.val(tags.join(','));
            }
            
            function addTag(tag) {
                tag = tag.trim();
                if (tag && !tags.includes(tag)) {
                    tags.push(tag);
                    updateTags();
                }
                tagInput.val('');
            }
            
            tagInput.on('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();
                    const value = tagInput.val();
                    if (value.includes(',')) {
                        value.split(',').forEach(tag => addTag(tag));
                    } else {
                        addTag(value);
                    }
                }
            });
            
            tagInput.on('blur', function() {
                const value = tagInput.val();
                if (value) {
                    if (value.includes(',')) {
                        value.split(',').forEach(tag => addTag(tag));
                    } else {
                        addTag(value);
                    }
                }
            });
            
            $(document).on('click', '.tag-remove', function() {
                const tag = $(this).data('tag');
                tags = tags.filter(t => t !== tag);
                updateTags();
            });
            
            // Draft button
            $('#draftBtn').click(function() {
                $('#status').val('draft');
                $('form').submit();
            });
            
            // Publish button
            $('#publishBtn').click(function() {
                $('#status').val('published');
            });

            // Display Type Toggle
            $('#display_type').change(function() {
                if (this.value === 'card') {
                    $('#cardOptions').slideDown();
                } else {
                    $('#cardOptions').slideUp();
                }
            });

            // Add Statistic
            $('#addStat').click(function() {
                const statHtml = `
                    <div class="stat-item row mb-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="stat_keys[]" placeholder="Stat Key (e.g., NIRF)">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="stat_values[]" placeholder="Stat Value (e.g., #2)">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="stat_icons[]" placeholder="Icon Class">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-stat">×</button>
                        </div>
                    </div>
                `;
                $('#statsContainer').append(statHtml);
            });

            // Remove Statistic
            $(document).on('click', '.remove-stat', function() {
                $(this).closest('.stat-item').remove();
            });

            // Add FAQ
            $('#addFaq').click(function() {
                const faqHtml = `
                    <div class="faq-item card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="mb-2">
                                        <input type="text" class="form-control" name="faq_questions[]" placeholder="Question">
                                    </div>
                                    <div class="mb-2">
                                        <textarea class="form-control" name="faq_answers[]" rows="2" placeholder="Answer"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm remove-faq">×</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $('#faqContainer').append(faqHtml);
            });

            // Remove FAQ
            $(document).on('click', '.remove-faq', function() {
                $(this).closest('.faq-item').remove();
            });

            // Add some CSS for the new sections
            $('<style>')
                .text(`
                    .stat-item, .faq-item {
                        background: #f8f9fc;
                        border-radius: 8px;
                        padding: 15px;
                        margin-bottom: 10px;
                    }
                    .remove-stat, .remove-faq {
                        padding: 0.2rem 0.5rem;
                        font-size: 1.2rem;
                    }
                    #cardOptions {
                        background: #f8f9fc;
                        padding: 20px;
                        border-radius: 8px;
                        margin-bottom: 20px;
                    }
                `)
                .appendTo('head');
        });
    </script>
</body>

</html> 