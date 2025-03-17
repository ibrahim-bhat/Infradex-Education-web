<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    header('Location: ../login-new.php');
    exit();
}

require_once '../config/db_connect.php';

// Handle post actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete post 
    if (isset($_POST['delete_post'])) {
        $post_id = (int)$_POST['post_id'];
        
        // Get the featured image to delete
        $image_query = "SELECT featured_image FROM blog_posts WHERE id = ?";
        $image_stmt = $conn->prepare($image_query);
        $image_stmt->bind_param("i", $post_id);
        $image_stmt->execute();
        $image_result = $image_stmt->get_result();
        $image_data = $image_result->fetch_assoc();
        
        // Delete the post
        $sql = "DELETE FROM blog_posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $post_id);
        
        if ($stmt->execute()) {
            // Delete the featured image if it exists
            if (!empty($image_data['featured_image'])) {
                $image_path = "../uploads/blog/" . $image_data['featured_image'];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $_SESSION['success_msg'] = "Post deleted successfully!";
        } else {
            $_SESSION['error_msg'] = "Error deleting post: " . $conn->error;
        }
        header("Location: blog-posts.php");
        exit();
    }
    
    // Change post status
    if (isset($_POST['change_status'])) {
        $post_id = (int)$_POST['post_id'];
        $status = $_POST['status'];
        
        $sql = "UPDATE blog_posts SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $post_id);
        
        if ($stmt->execute()) {
            $_SESSION['success_msg'] = "Post status updated successfully!";
        } else {
            $_SESSION['error_msg'] = "Error updating post status: " . $conn->error;
        }
        header("Location: blog-posts.php");
        exit();
    }
}

// Pagination
$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

// Filters
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Build query
$where_clauses = [];
$params = [];
$types = "";

if ($category_filter > 0) {
    $where_clauses[] = "p.category_id = ?";
    $params[] = $category_filter;
    $types .= "i";
}

if (!empty($status_filter)) {
    $where_clauses[] = "p.status = ?";
    $params[] = $status_filter;
    $types .= "s";
}

if (!empty($search)) {
    $where_clauses[] = "(p.title LIKE ? OR p.content LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types .= "ss";
}

$where_sql = !empty($where_clauses) ? "WHERE " . implode(" AND ", $where_clauses) : "";

// Count total posts
$count_sql = "SELECT COUNT(*) as total FROM blog_posts p $where_sql";
$count_stmt = $conn->prepare($count_sql);

if (!empty($params)) {
    $count_stmt->bind_param($types, ...$params);
}

$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total_posts = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_posts / $per_page);

// Get posts
$posts_sql = "SELECT p.*, c.name as category_name, u.full_name as author_name 
              FROM blog_posts p 
              LEFT JOIN blog_categories c ON p.category_id = c.id 
              LEFT JOIN users u ON p.author_id = u.id 
              $where_sql 
              ORDER BY p.created_at DESC 
              LIMIT ?, ?";

$posts_stmt = $conn->prepare($posts_sql);
$limit_types = $types . "ii";
$limit_params = array_merge($params, [$start, $per_page]);
$posts_stmt->bind_param($limit_types, ...$limit_params);
$posts_stmt->execute();
$posts_result = $posts_stmt->get_result();

// Get categories for filter
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
    <title>Blog Posts - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/components.css">
    <style>
        .post-card {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .post-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .post-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .post-card:hover .post-image img {
            transform: scale(1.05);
        }
        
        .post-category {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .post-status {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .post-status.published {
            background: var(--success-color);
            color: white;
        }
        
        .post-status.draft {
            background: var(--warning-color);
            color: white;
        }
        
        .post-content {
            padding: 20px;
        }
        
        .post-title {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark-color);
        }
        
        .post-excerpt {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .post-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
        
        .post-actions {
            display: flex;
            gap: 10px;
        }
        
        .filter-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .filter-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--primary-color);
        }
        
        .pagination {
            margin-top: 30px;
        }
        
        .page-link {
            color: var(--primary-color);
            border-radius: 5px;
            margin: 0 3px;
        }
        
        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .no-posts {
            background: white;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }
        
        .no-posts i {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1>Blog Posts</h1>
                        <a href="add-blog-post.php" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Post
                        </a>
                    </div>
                    
                    <?php if (isset($_SESSION['success_msg'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php 
                                echo $_SESSION['success_msg'];
                                unset($_SESSION['success_msg']);
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['error_msg'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php 
                                echo $_SESSION['error_msg'];
                                unset($_SESSION['error_msg']);
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Filters -->
                    <div class="filter-card">
                        <h5 class="filter-title">Filter Posts</h5>
                        <form action="" method="GET" class="row g-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="search" placeholder="Search posts..." value="<?php echo htmlspecialchars($search); ?>">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="category">
                                    <option value="0">All Categories</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category['id']; ?>" <?php echo $category_filter == $category['id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($category['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="status">
                                    <option value="">All Statuses</option>
                                    <option value="published" <?php echo $status_filter === 'published' ? 'selected' : ''; ?>>Published</option>
                                    <option value="draft" <?php echo $status_filter === 'draft' ? 'selected' : ''; ?>>Draft</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Posts Grid -->
                    <?php if ($posts_result->num_rows > 0): ?>
                        <div class="row">
                            <?php while ($post = $posts_result->fetch_assoc()): ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="post-card">
                                        <div class="post-image">
                                            <?php if (!empty($post['featured_image'])): ?>
                                                <img src="../uploads/blog/<?php echo htmlspecialchars($post['featured_image']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                            <?php else: ?>
                                                <img src="../images/blog-placeholder.jpg" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                            <?php endif; ?>
                                            
                                            <div class="post-category">
                                                <?php echo htmlspecialchars($post['category_name']); ?>
                                            </div>
                                            
                                            <div class="post-status <?php echo $post['status']; ?>">
                                                <?php echo ucfirst($post['status']); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="post-content">
                                            <h5 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                                            
                                            <div class="post-excerpt">
                                                <?php echo htmlspecialchars(substr(strip_tags($post['content']), 0, 150)) . '...'; ?>
                                            </div>
                                            
                                            <div class="post-meta">
                                                <div>
                                                    <i class="fas fa-user"></i> <?php echo htmlspecialchars($post['author_name']); ?>
                                                </div>
                                                <div>
                                                    <i class="fas fa-calendar"></i> <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
                                                </div>
                                            </div>
                                            
                                            <div class="post-actions">
                                                <a href="../blog-detail.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-outline-info" target="_blank">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="edit-blog-post.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger delete-post" 
                                                        data-id="<?php echo $post['id']; ?>"
                                                        data-title="<?php echo htmlspecialchars($post['title']); ?>">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                                
                                                <?php if ($post['status'] === 'draft'): ?>
                                                    <button class="btn btn-sm btn-outline-success change-status" 
                                                            data-id="<?php echo $post['id']; ?>"
                                                            data-status="published"
                                                            data-title="<?php echo htmlspecialchars($post['title']); ?>">
                                                        <i class="fas fa-check-circle"></i> Publish
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-outline-warning change-status" 
                                                            data-id="<?php echo $post['id']; ?>"
                                                            data-status="draft"
                                                            data-title="<?php echo htmlspecialchars($post['title']); ?>">
                                                        <i class="fas fa-file"></i> Draft
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        
                        <!-- Pagination -->
                        <?php if ($total_pages > 1): ?>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?>&category=<?php echo $category_filter; ?>&status=<?php echo $status_filter; ?>&search=<?php echo urlencode($search); ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="no-posts">
                            <i class="fas fa-file-alt"></i>
                            <h4>No Posts Found</h4>
                            <p>There are no posts matching your criteria. Try adjusting your filters or create a new post.</p>
                            <a href="add-blog-post.php" class="btn btn-primary mt-3">
                                <i class="fas fa-plus"></i> Create New Post
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Post Modal -->
    <div class="modal fade" id="deletePostModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the post "<span id="delete_post_title"></span>"?</p>
                    <p class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i> 
                        This action cannot be undone. The post and its featured image will be permanently deleted.
                    </p>
                    <form action="" method="POST" id="deletePostForm">
                        <input type="hidden" name="post_id" id="delete_post_id">
                        <button type="submit" name="delete_post" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete Post
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Change Status Modal -->
    <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Post Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to change the status of "<span id="status_post_title"></span>" to <span id="new_status"></span>?</p>
                    <form action="" method="POST" id="changeStatusForm">
                        <input type="hidden" name="post_id" id="status_post_id">
                        <input type="hidden" name="status" id="status_value">
                        <button type="submit" name="change_status" class="btn btn-primary">
                            <i class="fas fa-check"></i> Confirm
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Delete Post
        document.querySelectorAll('.delete-post').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                
                document.getElementById('delete_post_id').value = id;
                document.getElementById('delete_post_title').textContent = title;
                
                const deleteModal = new bootstrap.Modal(document.getElementById('deletePostModal'));
                deleteModal.show();
            });
        });
        
        // Change Status
        document.querySelectorAll('.change-status').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                const status = this.getAttribute('data-status');
                
                document.getElementById('status_post_id').value = id;
                document.getElementById('status_post_title').textContent = title;
                document.getElementById('status_value').value = status;
                document.getElementById('new_status').textContent = status.charAt(0).toUpperCase() + status.slice(1);
                
                const statusModal = new bootstrap.Modal(document.getElementById('changeStatusModal'));
                statusModal.show();
            });
        });
    </script>
</body>

</html> 