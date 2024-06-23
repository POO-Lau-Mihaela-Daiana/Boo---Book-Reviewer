$(document).ready(function() {
    fetchLatestComments();

    function fetchLatestComments() {
        $.ajax({
            url: 'comment_fetch.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response); 
                
                if (response.success) {
                    displayComments(response.comment);
                } else {
                    console.error('Fetch comments error: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    }

    function displayComments(comment) {
        var friend__container__profile = $('#friend__container__profile');
        friend__container__profile.empty();

        comment.forEach(function(comment) {
            var commentHtml = `
                <div class="friend__container__profile">
                    <img src=${comment.user_url} alt="Friend Profile Picture" class="friend__profile__image" />
                    <div class="profile__container">
                        <div class="profile__name">
                            <a href="../AccountPage/others_account.php?user_id=${comment.user_id}" class="profile__link"><p class="name">${comment.username}</p></a>
                           <p>left a comment on <a href="../book/index.php?book_id=${comment.book_id}"><strong>${comment.book_title}</strong></a>:</p>
                        </div>
                        <p>${comment.comment_text}</p>
                        <p><small>at ${comment.comment_posted_hour}</small></p>
                    </div>
                </div>
            `;
            friend__container__profile.append(commentHtml);
        });
    }
});
