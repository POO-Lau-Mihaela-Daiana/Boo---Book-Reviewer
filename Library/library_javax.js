function loadBooks(category) {
    $.ajax({
        url: 'fetch_books.php',
        type: 'GET',
        data: { category: category },
        dataType: 'json', 
        success: function(data) {
            console.log("Response from server: ", data); 
            try {
                $('#books_container').html('');
                let books = Array.isArray(data) ? data : [data];
                if (books.error) {
                    console.error("Error from server: ", books.error);
                    return;
                }
                if (books.length === 0) {
                    $('#books_container').html('<p>No books found for this category.</p>');
                    return;
                }
                books.forEach(function(book) {
                    let bookHtml = `
                        <div class="book__container__info">
                            <img src="${book.book_photo_url}" alt="Book Cover" class="book__cover__image" />
                            <div class="book__details">
                                <a href="../book/index.php?book_id=${book.book_id}" class="book__title">${book.book_title}</a>
                                <div class="book__author">${book.book_author}</div>
                                <div class="book__description">${book.book_description.replace(/\r?\n/g, '<br>')}</div>
                            </div>
                        </div>`;
                    $('#books_container').append(bookHtml);
                });
            } catch (e) {
                console.error("Error handling response: ", e);
                console.error("Response: ", data);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error: ", status, error);
        }
    });
}


$(document).ready(function() {
    loadBooks('all');
});
