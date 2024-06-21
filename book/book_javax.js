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

    function displayBookRatings(ratings) {

        const averageRating = ratings.average_rating ? parseFloat(ratings.average_rating) : 0.0;
        const totalReviews = ratings.total_reviews ? parseInt(ratings.total_reviews) : 0;
        const fiveStar = ratings.five_star ? parseInt(ratings.five_star) : 0;
        const fourStar = ratings.four_star ? parseInt(ratings.four_star) : 0;
        const threeStar = ratings.three_star ? parseInt(ratings.three_star) : 0;
        const twoStar = ratings.two_star ? parseInt(ratings.two_star) : 0;
        const oneStar = ratings.one_star ? parseInt(ratings.one_star) : 0;
        
        console.log(ratings);
        $('#average-rating').text(ratings.average_rating.toFixed(1));
        $('#total-reviews').text(ratings.total_reviews);
        $('#five-star-count').text(ratings.five_star);
        $('#four-star-count').text(ratings.four_star);
        $('#three-star-count').text(ratings.three_star);
        $('#two-star-count').text(ratings.two_star);
        $('#one-star-count').text(ratings.one_star);

        $('#five-star-bar').css('width', (totalReviews > 0 ? (fiveStar /totalReviews * 100) : 0) + '%');
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
    
        var rating = $('#rating').val();
        var userId = $('#user_id').val();

        if (rating < 1 || rating > 5) {
            alert('Rating must be between 1 and 5.');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'add_review.php',
            data: {
                book_id: bookId,
                user_id: userId,
                rating: rating
            },
            success: function(response) {
                response = JSON.parse(response); 
                displayBookRatings(bookId);
                $('#rating').val(''); 
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
});
});

