$(document).ready(function() {
    fetchGroups();

    function fetchGroups() {
        $.ajax({
            type: 'GET',
            url: 'fetch_groups.php',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Load current groups
                    var currentGroupsList = $('#current-groups');
                    currentGroupsList.empty();
                    response.current_groups.forEach(function(group) {
                        currentGroupsList.append(`
                            <li class="group__item">
                                <a href="../GroupPage/groupPage.php?group_id=${group.group_id}" class="group__link">${group.name}</a>
                            </li>
                        `);
                    });

                    // Load open groups
                    var openGroupsContainer = $('#open-groups');
                    openGroupsContainer.empty();
                    response.open_groups.forEach(function(group) {
                        openGroupsContainer.append(`
                            <div class="friend__container__profile">
                                <div class="profile__container">
                                    <div class="profile__name">
                                        <p class="name">${group.name}</p>
                                        <button class="profile__link join-btn" data-group-id="${group.group_id}">
                                            Join?
                                        </button>
                                    </div>
                                    ${group.description}
                                </div>
                            </div>
                        `);
                    });

                    // Add event listener to join buttons
                    $('.join-btn').on('click', function() {
                        var groupId = $(this).data('group-id');
                        joinGroup(groupId);
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

    function joinGroup(groupId) {
        $.ajax({
            type: 'POST',
            url: 'join_group.php',
            data: { group_id: groupId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    fetchGroups();  // Refresh the groups list
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    }
});
