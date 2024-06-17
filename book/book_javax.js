$(document).ready(function() {
    var bookId = getBookIdFromUrl();
    fetchBookDetailsAndComments(bookId);

    function getBookIdFromUrl() {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('book_id');
    }

    function fetchBookDetailsAndComments(bookId) {
        $.ajax({
            url: 'fetch_book.php',
            method: 'GET',
            data: { book_id: bookId },
            dataType: 'json',
            success: function(response) {
                console.log(response); 
                
                if (response.success) {
                    displayBookDetails(response.book);
                    displayComments(response.comments);
                } else {
                    console.error('Fetch error: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    }

    function displayBookDetails(book) {
        $('#book-title').text(book.book_title);
        $('#book-description').text(book.book_description);
        $('#book-details').html(`
            <li><strong>Pages:</strong> ${book.book_pages}</li>
            <li><strong>Publisher:</strong> ${book.book_publisher}</li>
            <li><strong>Publication Date:</strong> ${book.book_publication}</li>
            <li><strong>Genre:</strong> ${book.book_genre}</li>
        `);
        $('.book-cover img').attr('src', book.book_photo_url);
    }

    function displayComments(comments) {
        var reviewsContainer = $('.reviews');
        reviewsContainer.empty();

        comments.forEach(function(comment) {
            var commentHtml = `
                <div class="comment">
                    <div class="account">
                        <img src="../BookReviewer/pictures/pfp.jpg" alt="Account Picture" class="account-picture" />
                    </div>
                    <div class="comment-text">
                        <p>${comment.username} left a comment:</p>
                        <p>${comment.comment_text}</p>
                        <p><small>${comment.comment_posted_date} at ${comment.comment_posted_hour}</small></p>
                    </div>
                </div>
            `;
            reviewsContainer.append(commentHtml);
        });
    }
});
