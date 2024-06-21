function loadBooks(category) {
    $.ajax({
        url: 'fetch_books.php',
        type: 'GET',
        data: { category: category },
        success: function(response) {
            try {
                $('#books_container').html('');
                let books = JSON.parse(response);
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
                                <a href="../book/index.html" class="book__title">${book.book_title}</a>
                                <div class="book__author">${book.book_author}</div>
                                <div class="book__description">${book.book_description}</div>
                            </div>
                        </div>`;
                    $('#books_container').append(bookHtml);
                });
            } catch (e) {
                console.error("Error parsing JSON: ", e);
                console.error("Response: ", response);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error: ", status, error);
        }
    });
}

// Load all books on page load
$(document).ready(function() {
    loadBooks('all');
});
