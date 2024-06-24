$(document).ready(function() {
    var bookId = getBookIdFromUrl();
    fetchBookDetailsAndComments(bookId);
    // fetchBookRatings(bookId);
    var commentText = $('#commentText').val();

    
  
    var user_id = $('#user_id').val();

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
                    displayBookRatings(response.ratings);

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
            <li><strong>Genres:</strong> ${book.genres}</li>
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
                        <img src=${comment.user_url} alt="Account Picture" class="account-picture" />
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

   function displayBookRatings(ratings) {
 
    if (!ratings || typeof ratings !== 'object') {
        console.error('Invalid ratings object:', ratings);
        return;
    }

    const averageRating = typeof ratings.average_rating === 'number' ? parseFloat(ratings.average_rating.toFixed(1)) : 0.0;
    const totalReviews = typeof ratings.total_reviews === 'number' ? parseInt(ratings.total_reviews) : 0;
    const fiveStar = typeof ratings.five_star === 'number' ? parseInt(ratings.five_star) : 0;
    const fourStar = typeof ratings.four_star === 'number' ? parseInt(ratings.four_star) : 0;
    const threeStar = typeof ratings.three_star === 'number' ? parseInt(ratings.three_star) : 0;
    const twoStar = typeof ratings.two_star === 'number' ? parseInt(ratings.two_star) : 0;
    const oneStar = typeof ratings.one_star === 'number' ? parseInt(ratings.one_star) : 0;

  
    $('#average-rating').text(averageRating.toFixed(1));
    $('#total-reviews').text(totalReviews);
    $('#five-star-count').text(fiveStar);
    $('#four-star-count').text(fourStar);
    $('#three-star-count').text(threeStar);
    $('#two-star-count').text(twoStar);
    $('#one-star-count').text(oneStar);

   
    $('#five-star-bar').css('width', (totalReviews > 0 ? (fiveStar / totalReviews * 100) : 0) + '%');
    $('#four-star-bar').css('width', (totalReviews > 0 ? (fourStar / totalReviews * 100) : 0) + '%');
    $('#three-star-bar').css('width', (totalReviews > 0 ? (threeStar / totalReviews * 100) : 0) + '%');
    $('#two-star-bar').css('width', (totalReviews > 0 ? (twoStar / totalReviews * 100) : 0) + '%');
    $('#one-star-bar').css('width', (totalReviews > 0 ? (oneStar / totalReviews * 100) : 0) + '%');
}


    

    $('#commentForm').submit(function(event) {
        event.preventDefault(); 
    
        var commentText = $('#commentText').val();
    
        $.ajax({
            type: 'POST',
            url: 'add_comment.php',
            data: {
                book_id: bookId,
                user_id: user_id,
                comment: commentText
            },
            success: function(response) {
                fetchBookDetailsAndComments(bookId);
                $('#commentText').val(''); 
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    });
    

    $('#reviewForm').submit(function(event) {
        event.preventDefault(); 
    
        var ratingText = parseInt($('#ratingText').val(), 10);
      
        if (ratingText < 1 || ratingText > 5) {
            alert('Rating must be between 1 and 5.');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'add_review.php',
            data: {
                book_id: bookId,
                user_id: user_id,
                rating: ratingText
            },
            success: function(response) {
                response = JSON.parse(response); 
                fetchBookDetailsAndComments(bookId);
                $('#rating').val(''); 
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
});
    
     $('.want-to-read-btn').on('click', function() {
        var status = $(this).data('status');
        console.log("Button clicked:", status); 
        updateBookStatus(status);
    });

    function updateBookStatus(status) {
        var listNumber;
        switch (status) {
            case 'want_to_read':
                listNumber = 1;
                break;
            case 'currently_reading':
                listNumber = 2;
                break;
            case 'read':
                listNumber = 3;
                break;
            default:
                return;
        }

        $.ajax({
            type: 'POST',
            url: 'update_book_status.php',
            data: {
                book_id: bookId,
                list_number: listNumber
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.success) {
                    console.log('Book status updated');
                } else {
                    console.error('Error updating book status: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    }

});

