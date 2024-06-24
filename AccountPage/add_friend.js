$(document).ready(function() {
    $('#add-friend-btn').on('click', function(event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'add_friend.php',
            data: {
                other_user_id: otherUserId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    $('#add-friend-btn').prop('disabled', true).text('Already Friends');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    });
});
