$(document).ready(function() {
    $('.view-receipt').click(function() {
        const id = $(this).data('id');
        $.ajax({
            url: 'ajax/get_receipt.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                $('#receiptContent').html(response);
                $('#receiptModal').modal('show');
            }
        });
    });
});

function printReceipt() {
    const printContent = document.getElementById('receiptContent').innerHTML;
    const originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
}

function exportToExcel() {
    window.location.href = 'ajax/export_payments.php' + window.location.search;
} 