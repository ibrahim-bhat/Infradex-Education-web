$(document).ready(function() {
    $('#studentSearch').on('keyup', function() {
        const search = $(this).val();
        if (search.length >= 2) {
            $.ajax({
                url: 'ajax/search_students.php',
                type: 'POST',
                data: { search: search },
                success: function(response) {
                    $('#studentResults').html(response).show();
                }
            });
        } else {
            $('#studentResults').hide();
        }
    });

    $('#courseSearch').on('keyup', function() {
        const search = $(this).val();
        if (search.length >= 2) {
            $.ajax({
                url: 'ajax/search_courses.php',
                type: 'POST',
                data: { search: search },
                success: function(response) {
                    $('#courseResults').html(response).show();
                }
            });
        } else {
            $('#courseResults').hide();
        }
    });

    $(document).on('click', '.student-result', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const details = $(this).data('details');

        $('#selectedStudentId').val(id);
        $('#selectedStudent').html(`
            <strong>${name}</strong><br>
            <small>${details}</small>
        `).show();
        $('#studentResults').hide();
        $('#studentSearch').val('');
    });

    $(document).on('click', '.course-result', function() {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const price = $(this).data('price');

        $('#selectedCourseId').val(id);
        $('#amount').val(price);
        $('#selectedCourse').html(`
            <strong>${title}</strong><br>
            <small>Price: ₹${price}</small>
        `).show();
        $('#courseResults').hide();
        $('#courseSearch').val('');
    });

    $('#paymentMethod').change(function() {
        if ($(this).val() === 'online') {
            $('#transactionIdField').show();
            $('input[name="transaction_id"]').prop('required', true);
        } else {
            $('#transactionIdField').hide();
            $('input[name="transaction_id"]').prop('required', false);
        }
    });

    $('#assignForm').on('submit', function(e) {
        if (!$('#selectedStudentId').val() || !$('#selectedCourseId').val()) {
            e.preventDefault();
            alert('Please select both student and course');
            return false;
        }
    });

    $('.view-details').click(function() {
        const id = $(this).data('id');
        $.ajax({
            url: 'ajax/get_assignment_details.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                $('#detailsContent').html(response);
                $('#detailsModal').modal('show');
            }
        });
    });

    $('.print-receipt').click(function() {
        const id = $(this).data('id');
        window.open('print_receipt.php?id=' + id, '_blank');
    });
}); 