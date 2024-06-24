// fetch_friends.js
$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: 'friends_info.php',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var friendsContainer = $('#friends__container');
                if (response.friends.length > 0) {
                    response.friends.forEach(function(friend) {
                        friendsContainer.append(
                            '<div class="friend">' +
                                '<a href="../AccountPage/others_account.php?user_id=' + friend.user_id + '" class="friend__name">' + friend.username + '</a>' +
                                '<img src="' + friend.user_url + '" alt="Friend Photo" class="friend__photo">' +
                            '</div>'
                        );
                    });
                } else {
                    friendsContainer.append('<p class="no-friends">No friends found.</p>');
                }
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Error: ' + error);
        }
    });
});
