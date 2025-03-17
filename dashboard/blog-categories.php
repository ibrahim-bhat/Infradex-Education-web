<?php
session_start();
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    header('Location: ../login-new.php');
    exit();
}

require_once '../config/db_connect.php';

// Handle category operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new category
    if (isset($_POST['add_category'])) {
        $name = trim($_POST['category_name']);
        $slug = strtolower(str_replace(' ', '-', $name));
        $description = trim($_POST['category_description']);
        $parent_id = !empty($_POST['parent_category']) ? (int)$_POST['parent_category'] : NULL;
        
        $sql = "INSERT INTO blog_categories (name, slug, description, parent_id, created_by) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $name, $slug, $description, $parent_id, $_SESSION['user_id']);
        
        if ($stmt->execute()) {
            $_SESSION['success_msg'] = "Category added successfully!";
        } else {
            $_SESSION['error_msg'] = "Error adding category: " . $conn->error;
        }
        header("Location: blog-categories.php");
        exit();
    }
    
    // Update category
    if (isset($_POST['update_category'])) {
        $id = (int)$_POST['category_id'];
        $name = trim($_POST['category_name']);
        $slug = strtolower(str_replace(' ', '-', $name));
        $description = trim($_POST['category_description']);
        $parent_id = !empty($_POST['parent_category']) ? (int)$_POST['parent_category'] : NULL;
        
        $sql = "UPDATE blog_categories SET name = ?, slug = ?, description = ?, parent_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $name, $slug, $description, $parent_id, $id);
        
        if ($stmt->execute()) {
            $_SESSION['success_msg'] = "Category updated successfully!";
        } else {
            $_SESSION['error_msg'] = "Error updating category: " . $conn->error;
        }
        header("Location: blog-categories.php");
        exit();
    }
    
    // Delete category
    if (isset($_POST['delete_category'])) {
        $id = (int)$_POST['category_id'];
        
        // First, update any posts using this category to uncategorized
        $sql = "UPDATE blog_posts SET category_id = 1 WHERE category_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Then, update any subcategories to be under the parent category or null
        $sql = "UPDATE blog_categories SET parent_id = NULL WHERE parent_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Finally, delete the category
        $sql = "DELETE FROM blog_categories WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $_SESSION['success_msg'] = "Category deleted successfully!";
        } else {
            $_SESSION['error_msg'] = "Error deleting category: " . $conn->error;
        }
        header("Location: blog-categories.php");
        exit();
    }
}

// Get all categories
$categories_query = "SELECT c.*, p.name as parent_name, 
                    (SELECT COUNT(*) FROM blog_posts WHERE category_id = c.id) as post_count 
                    FROM blog_categories c 
                    LEFT JOIN blog_categories p ON c.parent_id = p.id 
                    ORDER BY c.parent_id IS NULL DESC, c.parent_id, c.name";
$categories_result = $conn->query($categories_query);
$categories = [];
while ($row = $categories_result->fetch_assoc()) {
    $categories[] = $row;
}

// Get parent categories for dropdown
$parent_categories_query = "SELECT id, name FROM blog_categories WHERE parent_id IS NULL ORDER BY name";
$parent_categories_result = $conn->query($parent_categories_query);
$parent_categories = [];
while ($row = $parent_categories_result->fetch_assoc()) {
    $parent_categories[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Categories - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/components.css">
    <style>
        .category-card {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .category-name {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        .category-actions {
            display: flex;
            gap: 8px;
        }
        
        .category-description {
            color: var(--secondary-color);
            margin: 10px 0;
            font-size: 0.9rem;
        }
        
        .category-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--secondary-color);
        }
        
        .subcategory-card {
            margin-left: 30px;
            border-left: 3px solid var(--primary-color);
        }
        
        .add-category-form {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }
        
        .form-label {
            font-weight: 500;
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
                        <h1>Blog Categories</h1>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                            <i class="fas fa-plus"></i> Add New Category
                        </button>
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
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Categories List -->
                            <?php if (count($categories) > 0): ?>
                                <?php foreach ($categories as $category): ?>
                                    <?php if ($category['parent_id'] === NULL): ?>
                                        <div class="card category-card mb-3">
                                            <div class="card-body">
                                                <div class="category-header">
                                                    <h5 class="category-name"><?php echo htmlspecialchars($category['name']); ?></h5>
                                                    <div class="category-actions">
                                                        <button class="btn btn-sm btn-outline-primary edit-category" 
                                                                data-id="<?php echo $category['id']; ?>"
                                                                data-name="<?php echo htmlspecialchars($category['name']); ?>"
                                                                data-description="<?php echo htmlspecialchars($category['description']); ?>"
                                                                data-parent="<?php echo $category['parent_id']; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-danger delete-category"
                                                                data-id="<?php echo $category['id']; ?>"
                                                                data-name="<?php echo htmlspecialchars($category['name']); ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="category-description">
                                                    <?php echo !empty($category['description']) ? htmlspecialchars($category['description']) : 'No description available.'; ?>
                                                </p>
                                                <div class="category-meta">
                                                    <span>
                                                        <i class="fas fa-file-alt"></i> <?php echo $category['post_count']; ?> posts
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-link"></i> Slug: <?php echo htmlspecialchars($category['slug']); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Subcategories -->
                                        <?php foreach ($categories as $subcategory): ?>
                                            <?php if ($subcategory['parent_id'] == $category['id']): ?>
                                                <div class="card category-card subcategory-card mb-3">
                                                    <div class="card-body">
                                                        <div class="category-header">
                                                            <h5 class="category-name">
                                                                <?php echo htmlspecialchars($subcategory['name']); ?>
                                                                <small class="text-muted">
                                                                    (Child of <?php echo htmlspecialchars($category['name']); ?>)
                                                                </small>
                                                            </h5>
                                                            <div class="category-actions">
                                                                <button class="btn btn-sm btn-outline-primary edit-category" 
                                                                        data-id="<?php echo $subcategory['id']; ?>"
                                                                        data-name="<?php echo htmlspecialchars($subcategory['name']); ?>"
                                                                        data-description="<?php echo htmlspecialchars($subcategory['description']); ?>"
                                                                        data-parent="<?php echo $subcategory['parent_id']; ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-danger delete-category"
                                                                        data-id="<?php echo $subcategory['id']; ?>"
                                                                        data-name="<?php echo htmlspecialchars($subcategory['name']); ?>">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <p class="category-description">
                                                            <?php echo !empty($subcategory['description']) ? htmlspecialchars($subcategory['description']) : 'No description available.'; ?>
                                                        </p>
                                                        <div class="category-meta">
                                                            <span>
                                                                <i class="fas fa-file-alt"></i> <?php echo $subcategory['post_count']; ?> posts
                                                            </span>
                                                            <span>
                                                                <i class="fas fa-link"></i> Slug: <?php echo htmlspecialchars($subcategory['slug']); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    No categories found. Create your first category!
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="add-category-form">
                                <h4 class="mb-3">Add New Category</h4>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="category_name" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category_description" class="form-label">Description</label>
                                        <textarea class="form-control" id="category_description" name="category_description" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="parent_category" class="form-label">Parent Category (Optional)</label>
                                        <select class="form-select" id="parent_category" name="parent_category">
                                            <option value="">None (Top Level Category)</option>
                                            <?php foreach ($parent_categories as $parent): ?>
                                                <option value="<?php echo $parent['id']; ?>">
                                                    <?php echo htmlspecialchars($parent['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="add_category" class="btn btn-primary">
                                        <i class="fas fa-plus-circle"></i> Add Category
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editCategoryForm">
                        <input type="hidden" name="category_id" id="edit_category_id">
                        <div class="mb-3">
                            <label for="edit_category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="edit_category_name" name="category_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_category_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_category_description" name="category_description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_parent_category" class="form-label">Parent Category (Optional)</label>
                            <select class="form-select" id="edit_parent_category" name="parent_category">
                                <option value="">None (Top Level Category)</option>
                                <?php foreach ($parent_categories as $parent): ?>
                                    <option value="<?php echo $parent['id']; ?>">
                                        <?php echo htmlspecialchars($parent['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="update_category" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Category Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the category "<span id="delete_category_name"></span>"?</p>
                    <p class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i> 
                        This will move all posts in this category to Uncategorized and remove any parent-child relationships.
                    </p>
                    <form action="" method="POST" id="deleteCategoryForm">
                        <input type="hidden" name="category_id" id="delete_category_id">
                        <button type="submit" name="delete_category" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete Category
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
        // Edit Category
        document.querySelectorAll('.edit-category').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const description = this.getAttribute('data-description');
                const parent = this.getAttribute('data-parent');
                
                document.getElementById('edit_category_id').value = id;
                document.getElementById('edit_category_name').value = name;
                document.getElementById('edit_category_description').value = description;
                
                const parentSelect = document.getElementById('edit_parent_category');
                if (parent) {
                    for (let i = 0; i < parentSelect.options.length; i++) {
                        if (parentSelect.options[i].value === parent) {
                            parentSelect.selectedIndex = i;
                            break;
                        }
                    }
                } else {
                    parentSelect.selectedIndex = 0;
                }
                
                const editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
                editModal.show();
            });
        });
        
        // Delete Category
        document.querySelectorAll('.delete-category').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                
                document.getElementById('delete_category_id').value = id;
                document.getElementById('delete_category_name').textContent = name;
                
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteCategoryModal'));
                deleteModal.show();
            });
        });
    </script>
</body>

</html> 