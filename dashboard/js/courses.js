$(document).ready(function() {
    $('.view-course').click(function() {
        const courseId = $(this).data('id');
        $.ajax({
            url: 'ajax/get_course.php',
            type: 'POST',
            data: { id: courseId },
            success: function(response) {
                $('#viewCourseModal .modal-body').html(response);
                $('#viewCourseModal').modal('show');
            }
        });
    });

    $('.edit-course').click(function() {
        const courseId = $(this).data('id');
        window.location.href = 'edit_course.php?id=' + courseId;
    });

    $('.delete-course').click(function() {
        if (confirm('Are you sure you want to delete this course?')) {
            const courseId = $(this).data('id');
            $.ajax({
                url: 'ajax/delete_course.php',
                type: 'POST',
                data: { id: courseId },
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

    $('#searchCourse').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('.course-card').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    $('#filterCategory, #filterLevel, #filterStatus').change(function() {
        const category = $('#filterCategory').val();
        const level = $('#filterLevel').val();
        const status = $('#filterStatus').val();

        $('.course-card').each(function() {
            const $card = $(this);
            const showCategory = !category || $card.find('.course-category').text().toLowerCase() === category;
            const showLevel = !level || $card.find('.course-meta').text().toLowerCase().includes(level);
            const showStatus = !status || $card.find('.course-status').text().toLowerCase() === status;

            $card.toggle(showCategory && showLevel && showStatus);
        });
    });
}); 