<?php
session_start();
// Only allow super_admin and admin to access this page
if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['super_admin', 'admin'])) {
    header('Location: ../login.php');
    exit();
}

require_once '../config/db_connect.php';

// Fetch all users with pagination
$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

$users_query = "SELECT * FROM users ORDER BY created_at DESC LIMIT $start, $per_page";
$users_result = $conn->query($users_query);

// Get total users count for pagination
$total_query = "SELECT COUNT(*) as count FROM users";
$total_result = $conn->query($total_query);
$total_users = $total_result->fetch_assoc()['count'];
$total_pages = ceil($total_users / $per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .role-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }
        .role-super_admin { background: #dc3545; color: white; }
        .role-admin { background: #0d6efd; color: white; }
        .role-management { background: #198754; color: white; }
        .role-user { background: #6c757d; color: white; }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'components/sidebar.php'; ?>
        
        <div class="main-content">
            <?php include 'components/header.php'; ?>
            
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1>Users Management</h1>
                        <?php if ($_SESSION['user_role'] == 'super_admin'): ?>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="fas fa-plus"></i> Add New User
                        </button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Search and Filter Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" id="searchUser" class="form-control" placeholder="Search users...">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="filterRole">
                                    <option value="">All Roles</option>
                                    <?php if ($_SESSION['user_role'] == 'super_admin'): ?>
                                    <option value="super_admin">Super Admin</option>
                                    <?php endif; ?>
                                    <option value="admin">Admin</option>
                                    <option value="management">Management</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users List -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($user = $users_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td>
                                            <span class="role-badge role-<?php echo $user['user_role']; ?>">
                                                <?php echo ucfirst($user['user_role']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-info view-user" data-id="<?php echo $user['id']; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary edit-user" data-id="<?php echo $user['id']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <?php if($_SESSION['user_role'] == 'super_admin'): ?>
                                                <button class="btn btn-sm btn-danger delete-user" data-id="<?php echo $user['id']; ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View User Modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img src="../images/avatar.png" alt="User" class="student-avatar">
                    </div>
                    <div class="user-info">
                        <h6>Full Name</h6>
                        <p id="userName"></p>
                    </div>
                    <div class="user-info">
                        <h6>Username</h6>
                        <p id="userUsername"></p>
                    </div>
                    <div class="user-info">
                        <h6>Email</h6>
                        <p id="userEmail"></p>
                    </div>
                    <div class="user-info">
                        <h6>Role</h6>
                        <p id="userRole"></p>
                    </div>
                    <div class="user-info">
                        <h6>Created Date</h6>
                        <p id="userCreated"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-user-edit me-2"></i>Edit User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="editError" style="display: none;"></div>
                    <div class="alert alert-success" id="editSuccess" style="display: none;"></div>
                    <form id="editUserForm">
                        <input type="hidden" id="editUserId" name="id">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" id="editFullName" name="full_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                    <input type="text" id="editUsername" name="username" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" id="editEmail" name="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">User Role</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                <select id="editUserRole" name="user_role" class="form-control" required>
                                    <?php if ($_SESSION['user_role'] == 'super_admin'): ?>
                                        <option value="admin">Admin</option>
                                        <option value="management">Management</option>
                                        <option value="user">User</option>
                                    <?php else: ?>
                                        <option value="management">Management</option>
                                        <option value="user">User</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="changePassword">
                                <label class="form-check-label" for="changePassword">Change Password</label>
                            </div>
                        </div>

                        <div id="passwordFields" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" id="newPassword" name="password" class="form-control">
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength mt-2" id="passwordStrength"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveUserChanges">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/admin.js"></script>
    <script>
    $(document).ready(function() {
        // View User Details
        $('.view-user').click(function() {
            const userId = $(this).data('id');
            $('#viewUserModal').modal('show');
            
            $.ajax({
                url: 'ajax/get_user.php',
                type: 'POST',
                data: { id: userId },
                success: function(response) {
                    const user = JSON.parse(response);
                    $('#userName').text(user.full_name);
                    $('#userUsername').text(user.username);
                    $('#userEmail').text(user.email);
                    $('#userRole').text(user.user_role);
                    $('#userCreated').text(new Date(user.created_at).toLocaleDateString());
                }
            });
        });

        // Edit User
        $('.edit-user').click(function() {
            const userId = $(this).data('id');
            
            // Clear previous messages
            $('#editError, #editSuccess').hide();
            
            // Reset password fields
            $('#passwordFields').hide();
            $('#changePassword').prop('checked', false);
            $('#newPassword').val('');
            
            // Fetch user details
            $.ajax({
                url: 'ajax/get_user.php',
                type: 'POST',
                data: { id: userId },
                success: function(response) {
                    try {
                        const user = JSON.parse(response);
                        if (user.error) {
                            alert(user.error);
                            return;
                        }
                        
                        // Populate the form fields
                        $('#editUserId').val(user.id);
                        $('#editFullName').val(user.full_name);
                        $('#editUsername').val(user.username);
                        $('#editEmail').val(user.email);
                        
                        // Handle role restrictions
                        if (user.user_role === 'super_admin' || 
                            (user.user_role === 'admin' && '<?php echo $_SESSION['user_role']; ?>' !== 'super_admin')) {
                            // Disable role select for super_admin and admin users
                            $('#editUserRole').prop('disabled', true);
                        } else {
                            $('#editUserRole').prop('disabled', false);
                        }
                        $('#editUserRole').val(user.user_role);
                        
                        // Show the modal
                        $('#editUserModal').modal('show');
                    } catch (e) {
                        alert('Error loading user data');
                        console.error(e);
                    }
                },
                error: function() {
                    alert('Error loading user data');
                }
            });
        });

        // Toggle password fields
        $('#changePassword').change(function() {
            $('#passwordFields').toggle(this.checked);
            if (!this.checked) {
                $('#newPassword').val('');
                $('#passwordStrength').html('');
            }
        });

        // Password visibility toggle
        $('.toggle-password').click(function() {
            const passwordInput = $(this).siblings('input');
            const icon = $(this).find('i');
            
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // Password strength checker
        $('#newPassword').on('input', function() {
            const password = $(this).val();
            let strength = 0;
            let message = '';

            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            if (password.length >= 8) strength++;

            switch(strength) {
                case 0:
                case 1:
                    message = '<span class="text-danger"><i class="fas fa-times-circle"></i> Weak password</span>';
                    break;
                case 2:
                case 3:
                    message = '<span class="text-warning"><i class="fas fa-exclamation-circle"></i> Medium password</span>';
                    break;
                case 4:
                case 5:
                    message = '<span class="text-success"><i class="fas fa-check-circle"></i> Strong password</span>';
                    break;
            }

            $('#passwordStrength').html(message);
        });

        // Save user changes
        $('#saveUserChanges').click(function() {
            const formData = new FormData($('#editUserForm')[0]);
            
            $.ajax({
                url: 'ajax/update_user.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.success) {
                        $('#editSuccess').html('<i class="fas fa-check-circle"></i> ' + result.message).show();
                        setTimeout(() => {
                            $('#editUserModal').modal('hide');
                            location.reload();
                        }, 1500);
                    } else {
                        $('#editError').html('<i class="fas fa-exclamation-circle"></i> ' + result.message).show();
                    }
                }
            });
        });

        // Search functionality
        $('#searchUser').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Role filter
        $('#filterRole').change(function() {
            const value = $(this).val().toLowerCase();
            if(value) {
                $('table tbody tr').hide();
                $('table tbody tr').filter(function() {
                    return $(this).find('.role-badge').text().toLowerCase() === value;
                }).show();
            } else {
                $('table tbody tr').show();
            }
        });

        // Delete user
        $('.delete-user').click(function() {
            if(confirm('Are you sure you want to delete this user?')) {
                const userId = $(this).data('id');
                $.ajax({
                    url: 'ajax/delete_user.php',
                    type: 'POST',
                    data: { id: userId },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if(result.success) {
                            location.reload();
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });
    </script>
</body>
</html> 