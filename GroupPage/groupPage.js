$(document).ready(function() {
    var group_id = getUrlParameter('group_id');
    fetchGroupActivity(group_id);

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    function fetchGroupActivity(group_id) {
        $.ajax({
            type: 'GET',
            url: 'fetch_group_activity.php',
            data: { group_id: group_id },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var activityContainer = $('#group-activity');
                    activityContainer.empty();
                    response.group_activity.forEach(function(activity) {
                        activityContainer.append(`
                            <div class="friend__container">
                                <div class="friend__container__profile">
                                    <img src=${activity.user_url}
                                        alt="Friend Profile Picture"
                                        class="friend__profile__image"
                                    />
                                    <div class="profile__container">
                                        <div class="profile__name">
                                            <a
                                                href="../AccountPage/account.php?user_id=${activity.user_id}"
                                                class="profile__link"
                                            >
                                                <p class="name">${activity.username}</p>
                                            </a>
                                            <p>left a comment on 
                                                <a href="../book/index.php?book_id=${activity.book_id}">${activity.book_title}</a>:
                                            </p>
                                        </div>
                                        <p>${activity.comment_text}</p>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    console.error('Fetch error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    }
});
