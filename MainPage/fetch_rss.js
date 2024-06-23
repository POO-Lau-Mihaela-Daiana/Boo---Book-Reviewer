$('#rssButton').click(function() {
    $.ajax({
        url: 'rss.php',
        type: 'GET',
        dataType: 'xml',
        success: function(data) {
            var entries = data.getElementsByTagName('item');
            var content = '';

            for (var i = 0; i < entries.length; i++) {
                var title = entries[i].getElementsByTagName('title')[0].textContent;
                var author = entries[i].getElementsByTagName('author')[0].textContent;
                var description = entries[i].getElementsByTagName('description')[0].textContent;
                var category = entries[i].getElementsByTagName('category')[0].textContent;

                if (category === 'book') {
                    
                    content += `
                        <div class="entry">
                            <div class="entry-title">${title}</div>
                            <div class="entry-author">by ${author}</div>
                            <div class="entry-description">${description}</div>
                        </div>
                    `;
                } else if (category === 'comment') {
                   
                    content += `
                        <div class="entry">
                            <div class="entry-title">${title}</div>
                            <div class="entry-author">Comment by ${author}</div>
                            <div class="entry-description">${description}</div>
                        </div>
                    `;
                }
            }

            var newWindow = window.open();
            if (newWindow) {
                newWindow.document.write(`
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>RSS Feed</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                line-height: 1.6;
                                margin: 0;
                                padding: 20px;
                                background-color: #f4f4f4;
                            }
                            .entry {
                                background-color: #fff;
                                padding: 20px;
                                border: 1px solid #ccc;
                                margin-bottom: 20px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            }
                            .entry-title {
                                font-weight: bold;
                                margin-bottom: 10px;
                            }
                            .entry-author {
                                font-style: italic;
                                margin-bottom: 10px;
                            }
                            .entry-description {
                                margin-bottom: 10px;
                            }
                        </style>
                    </head>
                    <body>
                        <h1>RSS Feed</h1>
                        ${content}
                    </body>
                    </html>
                `);
                newWindow.document.close();
            } else {
                alert('Failed to open new window. Please check your browser settings.');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});