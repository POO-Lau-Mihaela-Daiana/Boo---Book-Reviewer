$(document).ready(function() {
    $('#searchForm').submit(function(event) {
        event.preventDefault(); 
        
        var searchTerm = $('#search').val().trim(); 
        
 
        var actionUrl = '../SearchPage/searchPage.php';
        if (searchTerm !== '') {
            actionUrl += '?search=' + encodeURIComponent(searchTerm);
        }
        
        $(this).attr('action', actionUrl);
        
    
        this.submit();
    });
});
