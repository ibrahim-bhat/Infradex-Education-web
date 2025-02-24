$(document).ready(function() {
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

    $('.edit-user').click(function() {
        const userId = $(this).data('id');
        $('#editError, #editSuccess').hide();
        $('#passwordFields').hide();
        $('#changePassword').prop('checked', false);
        $('#newPassword').val('');

        $.ajax({
            url: 'ajax/get_user.php',
            type: 'POST',
            data: { id: userId },
            success: function(response) {
                const user = JSON.parse(response);
                if (user.error) {
                    alert(user.error);
                    return;
                }

                $('#editUserId').val(user.id);
                $('#editFullName').val(user.full_name);
                $('#editUsername').val(user.username);
                $('#editEmail').val(user.email);
                $('#editUserRole').val(user.user_role);
                $('#editUserModal').modal('show');
            }
        });
    });

    $('#changePassword').change(function() {
        $('#passwordFields').toggle(this.checked);
        if (!this.checked) {
            $('#newPassword').val('');
            $('#passwordStrength').html('');
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
        let strength = 0;
        let message = '';

        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        if (password.length >= 8) strength++;

        switch (strength) {
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
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.success) {
                        location.reload();
                    } else {
                        alert(result.message);
                    }
                }
            });
        }
    });
}); 