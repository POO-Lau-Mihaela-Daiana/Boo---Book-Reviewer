$(document).ready(function() {
    var user_id =getUserFromUrl;

    function getUserFromUrl() {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('user_id');
    }
    
    fetchUserInfo(user_id);
   
   
    function fetchUserInfo(user_id) {
        $.ajax({
            url: 'account_info_for_others.php',
            method: 'GET',
            data: { user_id: user_id },
            dataType: 'json',
            success: function(response) {
                console.log(response); 
                
                if (response.success) {
                    displayUserAccountDetails(response.user);
                    console.log('User Info:', response.user);
                    // displayComments(response.comments);
                } else {
                    console.error('Fetch error: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    }

    function displayUserAccountDetails(user) {
        $('#username').text(user.username);
        $('#user_url').attr('src', user.user_url);
        $('#user_date_of_creation').text(user.user_date_of_creation);
        $('#user_description').text(user.user_description);
        $('#user_tips').text(user.user_tips);
    
    }




});
