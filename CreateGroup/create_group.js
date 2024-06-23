$(document).ready(function() {
    $('#create-group-btn').on('click', function(event) {
        event.preventDefault();

        var formData = {
            name: $('#group-name').val(),
            description: $('#group-description').val()
        };

        $.ajax({
            type: 'POST',
            url: 'create_group_action.php',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function(response) {
                if (response.success) {
                    $('#message').text(response.message).css('color', 'green');
                    window.location.href='../LookForGroupPage/lookFor.php?user_id=<?php echo $user_id; ?>';
                } else {
                    $('#message').text(response.message).css('color', 'red');
                }
            },
            error: function(xhr, status, error) {
                $('#message').text('Error: ' + error).css('color', 'red');
            }
        });
    });
});
