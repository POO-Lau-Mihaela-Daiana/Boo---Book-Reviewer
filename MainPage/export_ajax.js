$(document).ready(function() {
    $('#minimal_exp').click(function() {
        exportData('export_minimal.php');
    });
    $('#csv_exp').click(function() {
        window.location.href = 'export_csv.php';
    });
    $('#docbook_exp').click(function() {
        exportData('export_docbook.php');
    });

    function exportData(url) {
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                window.location.href = response;
            },
            error: function(xhr, status, error) {
                console.error('Export failed:', status, error);
            }
        });
    }
});