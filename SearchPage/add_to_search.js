$(document).ready(function() {
    $('#searchForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        
        var searchTerm = $('#search').val().trim(); // Get the value from the input
        
        // Build the action URL based on whether searchTerm is provided or not
        var actionUrl = '../SearchPage/searchPage.php';
        if (searchTerm !== '') {
            actionUrl += '?search=' + encodeURIComponent(searchTerm);
        }
        
        // Update the action attribute of the form
        $(this).attr('action', actionUrl);
        
        // Submit the form
        this.submit();
    });
});
