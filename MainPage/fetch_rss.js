$('#rssButton').click(function() {
    $.ajax({
        url: 'rss.php',
        type: 'GET',
        success: function(data) {
            var blob = new Blob([data], { type: 'application/rss+xml' });
            var url = URL.createObjectURL(blob);
            window.open(url);
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});