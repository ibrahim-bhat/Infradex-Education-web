$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        
        const email = $('input[name="email"]').val();
        const password = $('input[name="password"]').val();
        
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#loginAlert').removeClass('alert-danger').addClass('alert-success').html(response.message).show();
                    window.location.href = response.redirect;
                } else {
                    $('#loginAlert').removeClass('alert-success').addClass('alert-danger').html(response.message).show();
                }
            },
            error: function() {
                $('#loginAlert').removeClass('alert-success').addClass('alert-danger').html('An error occurred. Please try again.').show();
            }
        });
    });
}); 