function toggleForm(formId) {
    const form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

function deleteUser() {
    const form = document.getElementById('deleteUserFormElement');
    const formData = new FormData(form);

    if (formData) {
        $.ajax({
            url: 'delete_user.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                const resultDiv = $('#deleteResultUser');
                response = JSON.parse(response); 
                console.log(response); 
                if (response.success) {
                    resultDiv.html('<p style="color: green;">' + response.message + '</p>');
                    form.reset();
                } else {
                    resultDiv.html('<p style="color: red;">' + response.error + '</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:' + status + ' ' + error);
                $('#deleteResultUser').html('<p style="color: red;">An error occurred during the delete process. Please try again.</p>');
            }
        });
    } else {
        alert('Please enter a user ID.');
    }
}
