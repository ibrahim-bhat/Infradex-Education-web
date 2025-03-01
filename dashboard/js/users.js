$(document).ready(function() {
    // Initialize modals at the very beginning
    const viewModal = new bootstrap.Modal(document.getElementById('viewUserModal'));
    const editModal = new bootstrap.Modal(document.getElementById('editUserModal'));

    // Add debug logs to check if modal element exists
    console.log('Edit modal element:', document.getElementById('editUserModal'));
    console.log('Edit modal instance:', editModal);

    $('.view-user').click(function(e) {
        e.preventDefault();
        const userId = $(this).data('id');
        $.ajax({
            url: 'ajax/update_user.php',
            type: 'GET',
            data: { 
                id: userId,
                _: new Date().getTime() // Cache-busting
            },
            dataType: 'json',
            beforeSend: function() {
                console.log('Fetching user data for view, ID:', userId);
            },
            success: function(response) {
                console.log('View user response:', response);
                if (response.success) {
                    const user = response.user;
                    $('#userName').text(user.full_name);
                    $('#userEmail').text(user.email);
                    $('#userRole').text(user.user_role);
                    $('#userStatus').text(user.status);
                    // Use Bootstrap 5 modal show method
                    viewModal.show();
                } else {
                    alert('Error loading user details: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('View Ajax error:', error);
                console.error('Response text:', xhr.responseText);
                alert('Error loading user details. Please check the console for more information.');
            }
        });
    });

    $('.edit-user').click(function(e) {
        e.preventDefault();
        const userId = $(this).data('id');
        
        // Add debug log to check if click handler is triggered
        console.log('Edit user clicked, ID:', userId);
        
        // Reset form and messages
        $('#editUserForm')[0].reset();
        $('#editError, #editSuccess').hide();
        $('#passwordFields').hide();
        $('#changePassword').prop('checked', false);
        
        // Get user data
        $.ajax({
            url: 'ajax/update_user.php',
            type: 'GET',
            data: { 
                id: userId,
                _: new Date().getTime() // Cache-busting
            },
            dataType: 'json',
            beforeSend: function() {
                console.log('Fetching user data for edit, ID:', userId);
            },
            success: function(response) {
                console.log('Edit user response:', response);
                if (response.success) {
                    const user = response.user;
                    
                    // Populate form fields
                    $('#editUserId').val(user.id);
                    $('#editFullName').val(user.full_name);
                    $('#editEmail').val(user.email);
                    $('#editUserRole').val(user.user_role);
                    $('#editUserStatus').val(user.status);
                    
                    // Add debug log before showing modal
                    console.log('Attempting to show edit modal');
                    
                    try {
                        // Show the modal
                        editModal.show();
                    } catch (err) {
                        console.error('Error showing modal:', err);
                        // Fallback to jQuery modal if Bootstrap modal fails
                        $('#editUserModal').modal('show');
                    }
                } else {
                    alert('Error loading user details: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Edit Ajax error:', error);
                console.error('Response text:', xhr.responseText);
                alert('Error loading user details. Please check the console for more information.');
            }
        });
    });

    $('#changePassword').change(function() {
        $('#passwordFields').toggle(this.checked);
        if (!this.checked) {
            $('#newPassword').val('');
            $('#passwordStrength').text('').removeClass('weak medium strong');
        }
    });

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

    $('#newPassword').on('input', function() {
        const password = $(this).val();
        const strength = checkPasswordStrength(password);
        const strengthBar = $('#passwordStrength');
        
        strengthBar.removeClass('weak medium strong');
        if (password.length > 0) {
            strengthBar.addClass(strength.className);
            strengthBar.text(strength.message);
        } else {
            strengthBar.text('');
        }
    });

    $('#saveUserChanges').click(function(e) {
        e.preventDefault();
        const userId = $('#editUserId').val();
        const formData = {
            id: userId,
            full_name: $('#editFullName').val(),
            email: $('#editEmail').val(),
            user_role: $('#editUserRole').val(),
            status: $('#editUserStatus').val()
        };

        if ($('#changePassword').is(':checked') && $('#newPassword').val()) {
            formData.password = $('#newPassword').val();
        }

        $.ajax({
            url: 'ajax/update_user.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#editSuccess').text(response.message).show();
                    $('#editError').hide();
                    setTimeout(function() {
                        const editModal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
                        if (editModal) {
                            editModal.hide();
                        }
                        location.reload();
                    }, 1500);
                } else {
                    $('#editError').text(response.message).show();
                    $('#editSuccess').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('Save error:', error); // Debug log
                $('#editError').text('An error occurred while saving changes').show();
                $('#editSuccess').hide();
            }
        });
    });

    $('#searchUser').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    $('#filterRole').change(function() {
        const value = $(this).val().toLowerCase();
        if (value) {
            $('table tbody tr').hide();
            $('table tbody tr').filter(function() {
                return $(this).find('.role-badge').text().toLowerCase() === value;
            }).show();
        } else {
            $('table tbody tr').show();
        }
    });

    $('.delete-user').click(function() {
        if (confirm('Are you sure you want to delete this user?')) {
            const userId = $(this).data('id');
            $.ajax({
                url: 'ajax/delete_user.php',
                type: 'POST',
                data: { id: userId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message || 'Error deleting user');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Delete Ajax error:', error);
                    console.error('Response text:', xhr.responseText);
                    alert('Error deleting user. Please check the console for more information.');
                }
            });
        }
    });

    $('.toggle-status').click(function() {
        const userId = $(this).data('id');
        const currentStatus = $(this).data('status');
        const newStatus = currentStatus === 'active' ? 'blocked' : 'active';
        const actionText = currentStatus === 'active' ? 'block' : 'unblock';
        
        if (confirm(`Are you sure you want to ${actionText} this user?`)) {
            $.ajax({
                url: 'ajax/toggle_user_status.php',
                type: 'POST',
                data: {
                    id: userId,
                    status: newStatus
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message || 'Error updating user status');
                    }
                },
                error: function() {
                    alert('An error occurred while updating user status');
                }
            });
        }
    });
});

function checkPasswordStrength(password) {
    const length = password.length;
    const hasUpperCase = /[A-Z]/.test(password);
    const hasLowerCase = /[a-z]/.test(password);
    const hasNumbers = /\d/.test(password);
    const hasSpecialChars = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    
    const strength = hasUpperCase + hasLowerCase + hasNumbers + hasSpecialChars;
    
    if (length < 8) {
        return {
            className: 'weak',
            message: 'Password is too short'
        };
    }
    
    if (strength < 2) {
        return {
            className: 'weak',
            message: 'Weak password'
        };
    }
    
    if (strength < 4) {
        return {
            className: 'medium',
            message: 'Medium strength password'
        };
    }
    
    return {
        className: 'strong',
        message: 'Strong password'
    };
}