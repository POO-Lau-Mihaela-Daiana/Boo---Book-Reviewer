$(document).ready(function() {
    $('#searchForm').submit(function(event) {
        event.preventDefault(); 
        
        var searchTerm = $('#search').val().trim();
        var actionUrl = $(this).attr('action');

        if (searchTerm !== '') {
            if (actionUrl.includes('?')) {
                actionUrl += '&search=' + encodeURIComponent(searchTerm);
            } else {
                actionUrl += '?search=' + encodeURIComponent(searchTerm);
            }
        }

    
        $(this).attr('action', actionUrl);

        window.location.href = actionUrl;
    });
});
