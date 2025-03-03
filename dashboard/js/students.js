$(document).ready(function() {
    $('.view-student').click(function() {
        const studentId = $(this).data('id');
        
        $.ajax({
            url: 'ajax/get_student.php',
            type: 'POST',
            data: { id: studentId },
            success: function(response) {
                const student = JSON.parse(response);
                
                $('#studentName').text(student.full_name);
                $('#studentPhone').text(student.phone_number);
                $('#studentEmail').text(student.email);
                $('#studentDOB').text(formatDate(student.dob));
                $('#studentGender').text(student.gender);
                $('#studentClass').text(student.class);
                
                $('#studentCity').text(student.city);
                $('#studentState').text(student.state);
                $('#studentPincode').text(student.pincode);
                $('#studentColony').text(student.colony);
                
                $('#parentName').text(student.parent_name);
                $('#parentPhone').text(student.parent_phone);
                
                $('#studentAddedBy').text(student.added_by_name + ' (' + student.added_by_role + ')');
                $('#studentAddedDate').text(formatDate(student.created_at));
                
                let coursesHtml = '';
                student.enrolled_courses.forEach(course => {
                    coursesHtml += `
                        <tr>
                            <td>${course.title}</td>
                            <td>${formatDate(course.enrollment_date)}</td>
                            <td><span class="badge bg-${course.status === 'active' ? 'success' : 'warning'}">${course.status}</span></td>
                        </tr>
                    `;
                });
                $('#enrolledCourses').html(coursesHtml || '<tr><td colspan="3" class="text-center">No courses enrolled</td></tr>');
                
                let paymentsHtml = '';
                student.payments.forEach(payment => {
                    paymentsHtml += `
                        <tr>
                            <td>${formatDate(payment.payment_date)}</td>
                            <td>₹${payment.amount}</td>
                            <td>${payment.payment_method}</td>
                            <td>${payment.transaction_id || 'N/A'}</td>
                        </tr>
                    `;
                });
                $('#paymentHistory').html(paymentsHtml || '<tr><td colspan="4" class="text-center">No payment history</td></tr>');
                
                $('#viewStudentModal').modal('show');
            }
        });
    });

    $('#searchStudent').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    $('#filterClass').change(function() {
        const value = $(this).val();
        if (value) {
            $('table tbody tr').hide();
            $('table tbody tr').filter(function() {
                return $(this).children('td:eq(1)').text() === value;
            }).show();
        } else {
            $('table tbody tr').show();
        }
    });
});

function formatDate(dateString) {
    if (!dateString) return 'N/A';
    const date = new Date(dateString);
    return date.toLocaleDateString('en-IN', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

function downloadStudentDetails() {
    const studentId = $('#viewStudentModal').find('.view-student').data('id');
    window.open(`ajax/download_student_pdf.php?id=${studentId}`, '_blank');
} 