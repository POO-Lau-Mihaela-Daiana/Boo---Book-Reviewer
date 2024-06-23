$(document).ready(function() {
    function fetchCurrentlyReadingBooks() {
        $.ajax({
            type: 'GET',
            url: 'fetch_currently_reading.php',
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    response.forEach(function(book) {
                        $('.books__container').append(`
                            <div class="book">
                                <a href="../book/index.php?book_id=${book.book_id}" class="book__title">${book.book_title}</a>
                                <img src="${book.book_photo_url}" alt="${book.book_title}" class="book__photo">
                            </div>
                        `);
                    });
                } else {
                    $('.books__container').append('<p>No currently reading books found.</p>');
                }
            },
            error: function(xhr, status, error) {
                $('.books__container').append('<p>Error fetching books.</p>');
            }
        });
    }

    fetchCurrentlyReadingBooks();
});
