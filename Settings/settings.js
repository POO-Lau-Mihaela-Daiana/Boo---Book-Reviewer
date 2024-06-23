$(document).ready(function() {
    $('#save-btn').on('click', function(event) {
        event.preventDefault();

        var formData = {
            username: $('#change-name').val(),
            user_url: $('#change-url').val(),
            interests: $('#interests').val(),
            aboutMe: $('#aboutMe').val()
        };

        $.ajax({
            type: 'POST',
            url: 'update_user.php',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function(response) {
                if (response.success) {
                    $('#message').text(response.message).css('color', 'green');
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
